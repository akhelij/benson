<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Dashboard;
use App\Livewire\OrderManagement;
use App\Livewire\ClientManagement;
use App\Livewire\ArticleManagement;
use App\Livewire\FormesArticles;
use App\Livewire\Planning;
use App\Livewire\UserManagement;
use App\Livewire\CuirsSupplements;
use App\Livewire\SemellesConstructions;
use App\Http\Controllers\PrintController;

Route::view('/', 'welcome');

Route::get('/dashboard', Dashboard::class)
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

// Shoe Order Management Routes - Protected by authentication
Route::middleware(['auth'])->group(function () {
    Route::get('/users', UserManagement::class)->name('users');
    Route::get('/orders', OrderManagement::class)->name('orders');
    Route::get('/clients', ClientManagement::class)->name('clients');
    Route::get('/articles', ArticleManagement::class)->name('articles');
    Route::get('/items', FormesArticles::class)->name('items');
    Route::get('/cuirs-supplements', CuirsSupplements::class)->name('cuirs-supplements');
    Route::get('/semelles-constructions', SemellesConstructions::class)->name('semelles-constructions');
    Route::get('/planning', Planning::class)->name('planning');
    
    // Print Routes
    Route::get('/print/order/{id}', [PrintController::class, 'printOrder'])->name('print.order');
    Route::get('/print/order/{orderId}/line/{lineId}', [PrintController::class, 'printOrderLine'])->name('print.order-line');
});

require __DIR__.'/auth.php';
