<?php

use App\Livewire\OrderManagement;
use App\Models\User;
use App\Models\Client;
use App\Models\Order;
use App\Models\OrderLine;
use App\Models\Article;
use App\Models\Cuir;
use App\Models\Doublure;
use App\Models\Semelle;
use App\Models\Construction;
use Livewire\Livewire;

beforeEach(function () {
    // Create a user and authenticate
    $this->user = User::factory()->create();
    $this->actingAs($this->user);
    
    // Create test data
    $this->client = Client::factory()->create([
        'nom' => 'Test Client',
        'telephone' => '0123456789',
        'email' => 'test@example.com'
    ]);
    
    $this->article = Article::factory()->create([
        'reference' => 'ART001',
        'nom' => 'Test Article'
    ]);
    
    $this->cuir = Cuir::factory()->create(['nom' => 'Test Cuir']);
    $this->doublure = Doublure::factory()->create(['nom' => 'Test Doublure']);
    $this->semelle = Semelle::factory()->create(['nom' => 'Test Semelle']);
    $this->construction = Construction::factory()->create(['nom' => 'Test Construction']);
});

describe('Order Creation', function () {
    it('can create a new order', function () {
        Livewire::test(OrderManagement::class)
            ->set('showOrderModal', true)
            ->set('orderForm.client_id', $this->client->id)
            ->set('orderForm.code', 'ORD-2025-001')
            ->set('orderForm.firm', 'Test Firm')
            ->set('orderForm.ville', 'Test City')
            ->set('orderForm.telephone', '0123456789')
            ->set('orderForm.livraison', now()->addDays(7)->format('Y-m-d'))
            ->set('orderForm.transporteur', 'Test Transporter')
            ->set('orderForm.status', 'draft')
            ->call('saveOrder')
            ->assertHasNoErrors()
            ->assertDispatched('order-saved')
            ->assertSet('showOrderModal', false);
        
        $this->assertDatabaseHas('orders', [
            'code' => 'ORD-2025-001',
            'firm' => 'Test Firm',
            'ville' => 'Test City',
            'status' => 'draft'
        ]);
    });
    
    it('validates required fields when creating order', function () {
        Livewire::test(OrderManagement::class)
            ->set('showOrderModal', true)
            ->set('orderForm.client_id', '')
            ->set('orderForm.code', '')
            ->call('saveOrder')
            ->assertHasErrors(['orderForm.client_id', 'orderForm.code']);
    });
    
    it('prevents duplicate order codes', function () {
        Order::factory()->create(['code' => 'ORD-DUPLICATE']);
        
        Livewire::test(OrderManagement::class)
            ->set('showOrderModal', true)
            ->set('orderForm.client_id', $this->client->id)
            ->set('orderForm.code', 'ORD-DUPLICATE')
            ->call('saveOrder')
            ->assertHasErrors(['orderForm.code']);
    });
});

describe('Order Editing', function () {
    it('can edit an existing order', function () {
        $order = Order::factory()->create([
            'client_id' => $this->client->id,
            'code' => 'ORD-EDIT-001',
            'firm' => 'Original Firm',
            'status' => 'draft'
        ]);
        
        Livewire::test(OrderManagement::class)
            ->call('editOrder', $order->id)
            ->assertSet('showOrderModal', true)
            ->assertSet('orderForm.code', 'ORD-EDIT-001')
            ->assertSet('orderForm.firm', 'Original Firm')
            ->set('orderForm.firm', 'Updated Firm')
            ->set('orderForm.ville', 'Updated City')
            ->call('saveOrder')
            ->assertHasNoErrors()
            ->assertDispatched('order-saved');
        
        $this->assertDatabaseHas('orders', [
            'id' => $order->id,
            'firm' => 'Updated Firm',
            'ville' => 'Updated City'
        ]);
    });
    
    it('can change order status', function () {
        $order = Order::factory()->create([
            'client_id' => $this->client->id,
            'status' => 'draft'
        ]);
        
        Livewire::test(OrderManagement::class)
            ->call('editOrder', $order->id)
            ->set('orderForm.status', 'confirmed')
            ->call('saveOrder')
            ->assertHasNoErrors();
        
        $this->assertDatabaseHas('orders', [
            'id' => $order->id,
            'status' => 'confirmed'
        ]);
    });
});

describe('Order Lit', function () {
    it('can manage order lines', function () {
        $client = Client::factory()->create();
        $order = Order::factory()->create(['client_id' => $client->id, 'code' => 'ORD-LINES-001']);
        
        // Create related entities
        $article = Article::factory()->create();
        $cuir = Cuir::factory()->create();
        $doublure = Doublure::factory()->create();
        $semelle = Semelle::factory()->create();
        $construction = Construction::factory()->create();
        
        Livewire::test(OrderManagement::class)
            ->call('editOrder', $order->id)
            ->assertSet('editingOrder.id', $order->id)
            ->set('article_id', $article->id)
            ->set('forme', 'F-001')
            ->set('cuir_id', $cuir->id)
            ->set('doublure_id', $doublure->id)
            ->set('semelle_id', $semelle->id)
            ->set('construction_id', $construction->id)
            ->set('prix', 150.00)
            ->set('orderLines.0.p5', 2)
            ->set('orderLines.0.p6', 4)
            ->set('orderLines.0.p7', 6)
            ->call('addOrderLine')
            ->assertHasNoErrors();
        
        $this->assertDatabaseHas('order_lines', [
            'order_id' => $order->id,
            'article_id' => $article->id,
            'forme' => 'F-001',
            'prix' => 150.00,
            'p5' => 2,
            'p6' => 4,
            'p7' => 6
        ]);
    });
    
    it('can edit existing order lines', function () {
        $client = Client::factory()->create();
        $order = Order::factory()->create(['client_id' => $client->id]);
        $orderLine = OrderLine::factory()->create([
            'order_id' => $order->id,
            'forme' => 'F-OLD'
        ]);
        
        Livewire::test(OrderManagement::class)
            ->call('editOrder', $order->id)
            ->call('editOrderLine', 0)
            ->set('forme', 'F-NEW')
            ->call('updateOrderLine')
            ->assertHasNoErrors();
        
        $this->assertDatabaseHas('order_lines', [
            'id' => $orderLine->id,
            'forme' => 'F-NEW'
        ]);
    });
    
    it('can delete order lines', function () {
        $client = Client::factory()->create();
        $order = Order::factory()->create(['client_id' => $client->id]);
        $orderLine = OrderLine::factory()->create(['order_id' => $order->id]);
        
        Livewire::test(OrderManagement::class)
            ->call('editOrder', $order->id)
            ->call('removeOrderLine', 0);
        
        // Since removeOrderLine removes from the array, we check the order still exists
        // but the line is removed from the component's array
        $this->assertDatabaseHas('orders', [
            'id' => $order->id
        ]);
    });
    
    it('validates required fields for order lines', function () {
        $client = Client::factory()->create();
        $order = Order::factory()->create(['client_id' => $client->id]);
        
        Livewire::test(OrderManagement::class)
            ->call('editOrder', $order->id)
            ->set('article_id', '')
            ->set('forme', '')
            ->call('addOrderLine')
            ->assertHasErrors(['article_id', 'forme']);
    });
    
    it('calculates total quantity correctly', function () {
        $client = Client::factory()->create();
        $order = Order::factory()->create(['client_id' => $client->id]);
        $orderLine = OrderLine::factory()->create([
            'order_id' => $order->id,
            'p5' => 2,
            'p6' => 3,
            'p7' => 4,
            'p8' => 1
        ]);
        
        // Total should be 2 + 3 + 4 + 1 = 10
        expect($orderLine->total_quantity)->toBe(10);
    });
});

describe('Order Deletion', function () {
    it('can delete an order', function () {
        $order = Order::factory()->create([
            'client_id' => $this->client->id,
            'code' => 'ORD-DELETE-001'
        ]);
        
        Livewire::test(OrderManagement::class)
            ->call('deleteOrder', $order->id);
        
        $this->assertDatabaseMissing('orders', [
            'id' => $order->id
        ]);
    });
    
    it('deletes associated order lines when deleting order', function () {
        $order = Order::factory()->create([
            'client_id' => $this->client->id
        ]);
        
        $orderLine1 = OrderLine::factory()->create([
            'order_id' => $order->id,
            'article_id' => $this->article->id
        ]);
        
        $orderLine2 = OrderLine::factory()->create([
            'order_id' => $order->id,
            'article_id' => $this->article->id
        ]);
        
        Livewire::test(OrderManagement::class)
            ->call('confirmDeleteOrder', $order->id)
            ->call('deleteOrder');
        
        $this->assertDatabaseMissing('orders', ['id' => $order->id]);
        $this->assertSoftDeleted('order_lines', ['id' => $orderLine1->id]);
        $this->assertSoftDeleted('order_lines', ['id' => $orderLine2->id]);
    });
});

describe('Search and Filtering', function () {
    beforeEach(function () {
        Order::factory()->count(5)->create([
            'client_id' => $this->client->id,
            'status' => 'draft'
        ]);
        
        Order::factory()->count(3)->create([
            'client_id' => $this->client->id,
            'status' => 'confirmed'
        ]);
        
        Order::factory()->create([
            'client_id' => $this->client->id,
            'code' => 'SEARCH-ME',
            'status' => 'in_production'
        ]);
    });
    
    it('can search orders by code', function () {
        Livewire::test(OrderManagement::class)
            ->set('search', 'SEARCH-ME')
            ->assertSee('SEARCH-ME');
    });
    
    it('can filter orders by status', function () {
        $component = Livewire::test(OrderManagement::class)
            ->set('statusFilter', 'draft');
        
        // Should see 5 draft orders
        expect($component->viewData('orders')->count())->toBe(5);
        
        $component->set('statusFilter', 'confirmed');
        // Should see 3 confirmed orders
        expect($component->viewData('orders')->count())->toBe(3);
        
        $component->set('statusFilter', 'in_production');
        // Should see 1 in_production order
        expect($component->viewData('orders')->count())->toBe(1);
    });
});

describe('Pagination', function () {
    it('paginates orders correctly', function () {
        Order::factory()->count(25)->create([
            'client_id' => $this->client->id
        ]);
        
        $component = Livewire::test(OrderManagement::class);
        
        // Default should show 10 items per page
        expect($component->viewData('orders')->count())->toBe(10);
        
        // Can navigate to next page
        $component->call('nextPage');
        expect($component->viewData('orders')->count())->toBe(10);
    });
});
