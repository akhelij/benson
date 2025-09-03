{{-- resources/views/livewire/order-management.blade.php --}}
<div class="min-h-screen bg-gradient-to-br from-stone-50 via-amber-50/30 to-stone-100 p-6">
    {{-- Page Header --}}
    <div class="mb-8">
        <h1 class="text-4xl font-serif text-amber-900 tracking-wide">
            📋 Gestion des Commandes
        </h1>
        <div class="mt-2 h-1 w-32 bg-gradient-to-r from-amber-700 to-amber-500 rounded"></div>
        <p class="mt-3 text-stone-600 italic">Tableau de bord et gestion complète des commandes</p>
    </div>

    {{-- KPI Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-4 mb-8">
        <x-kpi-card 
            title="Total Commandes" 
            :value="$this->totalOrders" 
            icon="clipboard-list"
            color="amber" />
        
        <x-kpi-card 
            title="Chiffre d'Affaires" 
            :value="'€' . number_format($this->totalRevenue, 2, ',', ' ')" 
            icon="euro"
            color="emerald" />
        
        <x-kpi-card 
            title="En Attente" 
            :value="$this->pendingDeliveries" 
            icon="clock"
            color="orange" />
        
        <x-kpi-card 
            title="Cette Semaine" 
            :value="$this->weeklyOrders" 
            icon="calendar"
            color="purple" />
        
        <x-kpi-card 
            title="Urgentes" 
            :value="$this->urgentOrders" 
            icon="exclamation"
            color="red" />
        
        <x-kpi-card 
            title="Taux Livraison" 
            :value="$this->deliveryRate . '%'" 
            icon="check-circle"
            color="teal" />
    </div>

    {{-- Flash Messages --}}
    <x-flash-messages />

    {{-- Orders Table --}}
    <div class="bg-white rounded-lg shadow-lg border border-amber-100 overflow-hidden">
        {{-- Table Header --}}
        <div class="bg-gradient-to-r from-amber-600 to-amber-700 px-6 py-4">
            <h2 class="text-xl font-bold text-white">Commandes</h2>
        </div>
        
        {{-- Search Bar and Actions --}}
        <div class="px-6 py-3 bg-amber-50 border-b border-amber-100 flex justify-between items-center">
            <div class="flex items-center gap-4 flex-1">
                <x-search-input wire:model.live="search" placeholder="Rechercher une commande..." />
                <x-status-filter wire:model.live="statusFilter" />
            </div>
            <div class="flex items-center gap-2">
                @if(count($selectedOrders) > 0)
                    <x-bulk-actions 
                        :count="count($selectedOrders)"
                        wire:export="exportSelected"
                        wire:delete="bulkDelete" />
                @endif
                <button wire:click="openOrderModal" 
                        class="bg-amber-600 text-white px-4 py-2 rounded-lg hover:bg-amber-700 transition-colors duration-200 flex items-center text-sm">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Nouvelle Commande
                </button>
            </div>
        </div>

        {{-- Table Content --}}
        <x-orders-table :orders="$orders" />
        
        {{-- Pagination --}}
        <div class="px-6 py-3 bg-stone-50 border-t border-amber-100">
            {{ $orders->links() }}
        </div>
    </div>

    {{-- Order Form Modal --}}
    @if($showModal)
    <x-modal wire:model="showModal" :title="$editingOrder ? 'Modifier la Commande' : 'Nouvelle Commande'" max-width="4xl">
        {{-- Step Indicator --}}
        <x-step-indicator :current-step="$currentStep" :steps="['Informations de base', 'Articles & Quantités']" />
        
        {{-- Form Content --}}
        <form wire:submit.prevent="saveOrder" id="orderForm">
            @include('livewire.partials.order-form', ['step' => $currentStep])
        </form>
        
        {{-- Footer --}}
        <x-slot name="footer">
            @if($currentStep > 1)
                <button type="button" wire:click="previousStep" 
                    class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition-colors">
                    <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Précédent
                </button>
            @endif
            
            <button type="button" wire:click="closeModal"
                class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition-colors">
                Annuler
            </button>
            
            @if($currentStep === 1)
                <button type="button" wire:click="nextStep"
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                    Suivant
                    <svg class="w-5 h-5 inline-block ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>
            @else
                <button type="button" 
                    wire:click="saveOrder"
                    wire:loading.attr="disabled"
                    wire:loading.class="opacity-50 cursor-not-allowed"
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
                    <span wire:loading.remove wire:target="saveOrder">
                        {{ $editingOrder ? 'Mettre à jour' : 'Créer la commande' }}
                    </span>
                    <span wire:loading wire:target="saveOrder" class="flex items-center">
                        <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Sauvegarde...
                    </span>
                </button>
            @endif
        </x-slot>
    </x-modal>
    @endif

    {{-- View Order Modal --}}
    @if($showViewModal && $viewingOrder)
    <x-modal wire:model="showViewModal" title="Détails de la Commande #{{ $viewingOrder->code }}" max-width="4xl">
        <x-order-details :order="$viewingOrder" />
        
        <x-slot name="footer">
            <button wire:click="closeViewModal" type="button" 
                class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition-colors">
                Fermer
            </button>
            <a href="{{ route('print.order', $viewingOrder->id) }}" target="_blank"
                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors inline-flex items-center">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                        d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                </svg>
                Imprimer
            </a>
        </x-slot>
    </x-modal>
    @endif

    {{-- Delivery Tracking Modal --}}
    @if($showDeliveryModal && $deliveryOrder)
    <x-modal wire:model="showDeliveryModal" title="Suivi de Livraison - Commande #{{ $deliveryOrder->code }}" max-width="lg">
        <x-delivery-tracking 
            :order="$deliveryOrder"
            wire:model.status="deliveryStatus"
            wire:model.notes="deliveryNotes"
            wire:model.date="actualDeliveryDate" />
        
        <x-slot name="footer">
            <button wire:click="closeDeliveryModal"
                class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition-colors">
                Annuler
            </button>
            <button wire:click="updateDeliveryStatus"
                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                Mettre à jour
            </button>
        </x-slot>
    </x-modal>
    @endif

    {{-- Order Line Edit Modal --}}
    @if($showLineEditModal)
    <x-modal wire:model="showLineEditModal" title="Modifier la ligne de commande" max-width="4xl">
        @include('livewire.partials.order-line-form')
    </x-modal>
    @endif
</div>