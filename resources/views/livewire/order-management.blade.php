<div class="min-h-screen bg-gradient-to-br from-stone-50 via-amber-50/30 to-stone-100 p-6">
    <!-- Page Header with Vintage Styling -->
    <div class="mb-8">
        <h1 class="text-4xl font-serif text-amber-900 tracking-wide" style="font-family: 'Playfair Display', serif;">
            📋 Gestion des Commandes
        </h1>
        <div class="mt-2 h-1 w-32 bg-gradient-to-r from-amber-700 to-amber-500 rounded"></div>
        <p class="mt-3 text-stone-600 italic">Tableau de bord et gestion complète des commandes de chaussures</p>
    </div>

    {{-- KPI Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-4 mb-8">
        {{-- Total Orders --}}
        <div class="bg-white rounded-lg shadow-lg border border-amber-100 p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-stone-600">Total Commandes</p>
                    <p class="text-2xl font-bold text-amber-900 mt-1">{{ $this->totalOrders }}</p>
                </div>
                <div class="bg-amber-100 p-3 rounded-full">
                    <svg class="w-6 h-6 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
            </div>
        </div>

        {{-- Total Revenue --}}
        <div class="bg-white rounded-lg shadow-lg border border-amber-100 p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-stone-600">Chiffre d'Affaires</p>
                    <p class="text-2xl font-bold text-emerald-700 mt-1">€{{ number_format($this->totalRevenue, 2, ',', ' ') }}</p>
                </div>
                <div class="bg-emerald-100 p-3 rounded-full">
                    <svg class="w-6 h-6 text-emerald-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        {{-- Pending Deliveries --}}
        <div class="bg-white rounded-lg shadow-lg border border-amber-100 p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-stone-600">En Attente</p>
                    <p class="text-2xl font-bold text-orange-700 mt-1">{{ $this->pendingDeliveries }}</p>
                </div>
                <div class="bg-orange-100 p-3 rounded-full">
                    <svg class="w-6 h-6 text-orange-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        {{-- Weekly Orders --}}
        <div class="bg-white rounded-lg shadow-lg border border-amber-100 p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-stone-600">Cette Semaine</p>
                    <p class="text-2xl font-bold text-purple-700 mt-1">{{ $this->weeklyOrders }}</p>
                </div>
                <div class="bg-purple-100 p-3 rounded-full">
                    <svg class="w-6 h-6 text-purple-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
            </div>
        </div>

        {{-- Urgent Orders --}}
        <div class="bg-white rounded-lg shadow-lg border border-amber-100 p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-stone-600">Urgentes</p>
                    <p class="text-2xl font-bold text-red-700 mt-1">{{ $this->urgentOrders }}</p>
                </div>
                <div class="bg-red-100 p-3 rounded-full">
                    <svg class="w-6 h-6 text-red-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                </div>
            </div>
        </div>

        {{-- Delivery Rate --}}
        <div class="bg-white rounded-lg shadow-lg border border-amber-100 p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-stone-600">Taux Livraison</p>
                    <p class="text-2xl font-bold text-teal-700 mt-1">{{ $this->deliveryRate }}%</p>
                </div>
                <div class="bg-teal-100 p-3 rounded-full">
                    <svg class="w-6 h-6 text-teal-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Flash Messages -->
    @if (session()->has('message'))
        <div class="mb-4 bg-emerald-50 border border-emerald-400 text-emerald-800 px-4 py-3 rounded-lg shadow-sm">
            {{ session('message') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="mb-4 bg-red-50 border border-red-400 text-red-700 px-4 py-3 rounded-lg shadow-sm">
            {{ session('error') }}
        </div>
    @endif

    <!-- Orders Table -->
    <div class="bg-white rounded-lg shadow-lg border border-amber-100 overflow-hidden">
        <div class="bg-gradient-to-r from-amber-600 to-amber-700 px-6 py-4">
            <h2 class="text-xl font-bold text-white" style="font-family: 'Playfair Display', serif;">Commandes</h2>
        </div>
        
        <!-- Search Bar and Add Button -->
        <div class="px-6 py-3 bg-amber-50 border-b border-amber-100 flex justify-between items-center">
            <div class="flex items-center gap-4 flex-1">
                <div class="relative flex-1 max-w-md">
                    <input wire:model.live="search" 
                           type="text" 
                           placeholder="Rechercher une commande..."
                           class="w-full pl-10 pr-4 py-2 border border-amber-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent text-sm">
                    <svg class="absolute left-3 top-2.5 h-5 w-5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <select wire:model.live="statusFilter" 
                        class="px-3 py-2 border border-amber-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent text-sm">
                    <option value="">Tous les statuts</option>
                    <option value="draft">Brouillon</option>
                    <option value="confirmed">Confirmée</option>
                    <option value="in_production">En Production</option>
                    <option value="delivered">Livrée</option>
                    <option value="cancelled">Annulée</option>
                </select>
            </div>
            <div class="flex items-center gap-2">
                @if(count($selectedOrders) > 0)
                    <div class="flex items-center gap-2">
                        <span class="text-sm text-stone-600">{{ count($selectedOrders) }} sélectionné(s)</span>
                        <button wire:click="exportSelected" 
                                class="px-3 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition-colors flex items-center gap-2 text-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                            </svg>
                            Exporter
                        </button>
                        <button wire:click="bulkDelete" 
                                wire:confirm="Êtes-vous sûr de vouloir supprimer {{ count($selectedOrders) }} commande(s)?"
                                class="px-3 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors flex items-center gap-2 text-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                            Supprimer
                        </button>
                    </div>
                @endif
                <button wire:click="createOrder" 
                        class="bg-amber-600 text-white px-4 py-2 rounded-lg hover:bg-amber-700 transition-colors duration-200 flex items-center text-sm">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Nouvelle Commande
                </button>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-stone-100 border-b border-amber-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-amber-900 uppercase tracking-wider">
                            <input type="checkbox" wire:model.live="selectAll" class="rounded border-amber-300 text-amber-600 focus:ring-amber-500">
                        </th>
                        <th wire:click="sortBy('code')" class="px-6 py-3 text-left text-xs font-semibold text-amber-900 uppercase tracking-wider cursor-pointer hover:bg-amber-50">
                            <div class="flex items-center gap-1">
                                Code
                                @if($this->sortField === 'code')
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        @if($this->sortDirection === 'asc')
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path>
                                        @else
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                        @endif
                                    </svg>
                                @endif
                            </div>
                        </th>
                        <th wire:click="sortBy('firm')" class="px-6 py-3 text-left text-xs font-semibold text-amber-900 uppercase tracking-wider cursor-pointer hover:bg-amber-50">
                            <div class="flex items-center gap-1">
                                Client
                                @if($this->sortField === 'firm')
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        @if($this->sortDirection === 'asc')
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path>
                                        @else
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                        @endif
                                    </svg>
                                @endif
                            </div>
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-amber-900 uppercase tracking-wider">Ville</th>
                        <th wire:click="sortBy('total_quantity')" class="px-6 py-3 text-left text-xs font-semibold text-amber-900 uppercase tracking-wider cursor-pointer hover:bg-amber-50">
                            <div class="flex items-center gap-1">
                                Quantité
                                @if($this->sortField === 'total_quantity')
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        @if($this->sortDirection === 'asc')
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path>
                                        @else
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                        @endif
                                    </svg>
                                @endif
                            </div>
                        </th>
                        <th wire:click="sortBy('total_amount')" class="px-6 py-3 text-left text-xs font-semibold text-amber-900 uppercase tracking-wider cursor-pointer hover:bg-amber-50">
                            <div class="flex items-center gap-1">
                                Montant
                                @if($this->sortField === 'total_amount')
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        @if($this->sortDirection === 'asc')
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path>
                                        @else
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                        @endif
                                    </svg>
                                @endif
                            </div>
                        </th>
                        <th wire:click="sortBy('livraison')" class="px-6 py-3 text-left text-xs font-semibold text-amber-900 uppercase tracking-wider cursor-pointer hover:bg-amber-50">
                            <div class="flex items-center gap-1">
                                Livraison
                                @if($this->sortField === 'livraison')
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        @if($this->sortDirection === 'asc')
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path>
                                        @else
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                        @endif
                                    </svg>
                                @endif
                            </div>
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-amber-900 uppercase tracking-wider">Statut</th>
                        <th class="px-6 py-3 text-center text-xs font-semibold text-amber-900 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-amber-50">
                    @forelse ($orders as $order)
                        <tr class="hover:bg-amber-50/30 transition-colors duration-150">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <input type="checkbox" wire:model.live="selectedOrders" value="{{ $order->id }}" class="rounded border-amber-300 text-amber-600 focus:ring-amber-500">
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-stone-900">
                                {{ $order->code }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-stone-900">{{ $order->firm }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-stone-600">{{ $order->ville }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-stone-900">{{ $order->total_quantity ?: 0 }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-stone-900">€{{ number_format($order->total_amount ?: 0, 2, ',', ' ') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm text-stone-900">
                                    {{ $order->livraison ? $order->livraison->format('d/m/Y') : '-' }}
                                </span>
                                @if($order->livraison && $order->livraison->isPast() && $order->status !== 'delivered')
                                    <span class="ml-1 text-xs text-red-600">(En retard)</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @php
                                    $statusColors = [
                                        'draft' => 'bg-stone-100 text-stone-800',
                                        'confirmed' => 'bg-blue-100 text-blue-800',
                                        'in_production' => 'bg-amber-100 text-amber-800',
                                        'delivered' => 'bg-emerald-100 text-emerald-800',
                                        'cancelled' => 'bg-red-100 text-red-800',
                                    ];
                                    $statusLabels = [
                                        'draft' => 'Brouillon',
                                        'confirmed' => 'Confirmée',
                                        'in_production' => 'En Production',
                                        'delivered' => 'Livrée',
                                        'cancelled' => 'Annulée',
                                    ];
                                @endphp
                                <span class="px-2 py-1 text-xs font-medium rounded-full {{ $statusColors[$order->status] ?? 'bg-stone-100 text-stone-800' }}">
                                    {{ $statusLabels[$order->status] ?? $order->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <button wire:click="viewOrder({{ $order->id }})" class="text-blue-600 hover:text-blue-800" title="Voir">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </button>
                                    <button wire:click="openDeliveryModal({{ $order->id }})" class="text-emerald-600 hover:text-emerald-800" title="Suivi livraison">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                                        </svg>
                                    </button>
                                    <button wire:click="editOrder({{ $order->id }})" class="text-amber-600 hover:text-amber-800" title="Modifier">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </button>
                                    <a href="{{ route('print.order', $order->id) }}" target="_blank" class="text-purple-600 hover:text-purple-800" title="Imprimer commande">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                                        </svg>
                                    </a>
                                    <button wire:click="deleteOrder({{ $order->id }})" 
                                            wire:confirm="Êtes-vous sûr de vouloir supprimer cette commande ?"
                                            class="text-red-600 hover:text-red-800" title="Supprimer">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="px-6 py-8 text-center text-stone-500 italic">
                                <div class="flex flex-col items-center">
                                    <svg class="w-12 h-12 text-stone-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    <p class="text-stone-500">Aucune commande trouvée</p>
                                    <button wire:click="createOrder" class="mt-4 text-amber-600 hover:text-amber-800 font-medium">
                                        Créer votre première commande
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
                </table>
            </div>

        <div class="px-6 py-3 bg-stone-50 border-t border-amber-100">
            {{ $orders->links() }}
        </div>
    </div>

        {{-- Order Creation Modal --}}
@if($showModal)
    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity z-50" wire:click="closeModal"></div>
    <div class="fixed inset-0 z-50 overflow-y-auto">
        <div class="flex min-h-full items-center justify-center p-4">
            <div class="relative bg-white rounded-lg shadow-xl w-full max-w-4xl" wire:click.stop>
                {{-- Modal Header --}}
                <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4 rounded-t-lg">
                    <div class="flex items-center justify-between">
                        <h3 class="text-xl font-semibold text-white">
                            {{ $editingOrder ? 'Modifier la Commande' : 'Nouvelle Commande' }}
                        </h3>
                        <button wire:click="closeModal" class="text-white hover:text-gray-200">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                {{-- Step Indicator --}}
                <div class="px-6 py-4 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="flex items-center">
                                <span class="flex items-center justify-center w-8 h-8 {{ $currentStep === 1 ? 'bg-blue-600' : 'bg-green-600' }} text-white rounded-full text-sm font-semibold">
                                    @if($currentStep > 1)
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    @else
                                        1
                                    @endif
                                </span>
                                <span class="ml-2 text-sm {{ $currentStep === 1 ? 'font-medium text-gray-900' : 'text-gray-600' }}">Informations de base</span>
                            </div>
                            <svg class="w-5 h-5 mx-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                            <div class="flex items-center">
                                <span class="flex items-center justify-center w-8 h-8 {{ $currentStep === 2 ? 'bg-blue-600' : 'bg-gray-300' }} text-white rounded-full text-sm font-semibold">2</span>
                                <span class="ml-2 text-sm {{ $currentStep === 2 ? 'font-medium text-gray-900' : 'text-gray-400' }}">Articles & Quantités</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Modal Body --}}
                <form wire:submit.prevent="saveOrder">
                    <div class="px-6 py-4">
                        {{-- Step 1: Basic Information --}}
                        @if($currentStep === 1)
                        <div>
                            {{-- Client Information Section --}}
                            <div class="mb-6">
                                <h4 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    Informations Client
                                </h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">
                                        Code Commande <span class="text-red-500">*</span>
                                    </label>
                                    <input wire:model="code" type="text" 
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('code') border-red-500 @enderror"
                                        placeholder="Ex: CMD-2025-001">
                                    @error('code') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">
                                        Nom du Client / Firme
                                    </label>
                                    <input wire:model="firm" type="text" 
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('firm') border-red-500 @enderror"
                                        placeholder="Ex: Boutique Mode">
                                    @error('firm') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>

                        {{-- Contact Information Section --}}
                        <div class="mb-6">
                            <h4 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                Contact & Livraison
                            </h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">
                                        Ville
                                    </label>
                                    <input wire:model="ville" type="text" 
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('ville') border-red-500 @enderror"
                                        placeholder="Ex: Paris">
                                    @error('ville') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">
                                        Téléphone
                                    </label>
                                    <input wire:model="telephone" type="text" 
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('telephone') border-red-500 @enderror"
                                        placeholder="Ex: +33 6 12 34 56 78">
                                    @error('telephone') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">
                                        Date de Livraison <span class="text-red-500">*</span>
                                    </label>
                                    <input wire:model="livraison" type="date" 
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('livraison') border-red-500 @enderror">
                                    @error('livraison') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                </div>
                                
                                {{-- Logo 1 --}}
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Logo</label>
                                    
                                    {{-- Current Logo Preview --}}
                                    @if($logo && is_string($logo))
                                        <div class="mb-3 p-3 border border-gray-200 rounded-lg bg-gray-50">
                                            <div class="flex items-center justify-between">
                                                <div class="flex items-center space-x-3">
                                                    <img src="{{ asset('storage/' . $logo) }}" alt="Logo" class="w-16 h-16 object-contain border rounded">
                                                    <div>
                                                        <p class="text-sm font-medium text-gray-700">Logo actuel</p>
                                                        <p class="text-xs text-gray-500">{{ basename($logo) }}</p>
                                                    </div>
                                                </div>
                                                <button type="button" wire:click="removeLogo" 
                                                    class="px-3 py-1 text-sm bg-red-100 text-red-700 rounded hover:bg-red-200 transition-colors">
                                                    Supprimer
                                                </button>
                                            </div>
                                        </div>
                                    @endif
                                    
                                    {{-- New Logo Upload --}}
                                    @if($logo && !is_string($logo))
                                        <div class="mb-3 p-3 border border-green-200 rounded-lg bg-green-50">
                                            <div class="flex items-center justify-between">
                                                <div class="flex items-center space-x-3">
                                                    <div class="w-16 h-16 bg-green-100 border border-green-300 rounded flex items-center justify-center">
                                                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                        </svg>
                                                    </div>
                                                    <div>
                                                        <p class="text-sm font-medium text-green-700">Nouveau logo sélectionné</p>
                                                        <p class="text-xs text-green-600">Sera sauvegardé lors de l'enregistrement</p>
                                                    </div>
                                                </div>
                                                <button type="button" wire:click="removeLogo" 
                                                    class="px-3 py-1 text-sm bg-red-100 text-red-700 rounded hover:bg-red-200 transition-colors">
                                                    Annuler
                                                </button>
                                            </div>
                                        </div>
                                    @endif
                                    
                                    <input wire:model="logo" type="file" accept="image/*"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                </div>
                                
                                {{-- Logo 2 --}}
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Logo Semelle</label>
                                    
                                    {{-- Current Logo1 Preview --}}
                                    @if($logo1 && is_string($logo1))
                                        <div class="mb-3 p-3 border border-gray-200 rounded-lg bg-gray-50">
                                            <div class="flex items-center justify-between">
                                                <div class="flex items-center space-x-3">
                                                    <img src="{{ asset('storage/' . $logo1) }}" alt="Logo 2" class="w-16 h-16 object-contain border rounded">
                                                    <div>
                                                        <p class="text-sm font-medium text-gray-700">Logo semelle actuel</p>
                                                        <p class="text-xs text-gray-500">{{ basename($logo1) }}</p>
                                                    </div>
                                                </div>
                                                <button type="button" wire:click="removeLogo1" 
                                                    class="px-3 py-1 text-sm bg-red-100 text-red-700 rounded hover:bg-red-200 transition-colors">
                                                    Supprimer
                                                </button>
                                            </div>
                                        </div>
                                    @endif
                                    
                                    {{-- New Logo1 Upload --}}
                                    @if($logo1 && !is_string($logo1))
                                        <div class="mb-3 p-3 border border-green-200 rounded-lg bg-green-50">
                                            <div class="flex items-center justify-between">
                                                <div class="flex items-center space-x-3">
                                                    <div class="w-16 h-16 bg-green-100 border border-green-300 rounded flex items-center justify-center">
                                                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                        </svg>
                                                    </div>
                                                    <div>
                                                        <p class="text-sm font-medium text-green-700">Nouveau logo secondaire sélectionné</p>
                                                        <p class="text-xs text-green-600">Sera sauvegardé lors de l'enregistrement</p>
                                                    </div>
                                                </div>
                                                <button type="button" wire:click="removeLogo1" 
                                                    class="px-3 py-1 text-sm bg-red-100 text-red-700 rounded hover:bg-red-200 transition-colors">
                                                    Annuler
                                                </button>
                                            </div>
                                        </div>
                                    @endif
                                    
                                    <input wire:model="logo1" type="file" accept="image/*"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                </div>
                            </div>
                        </div>

                            {{-- Notes Section --}}
                            <div class="mb-6">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Notes</label>
                                <textarea wire:model="notes" rows="3"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="Informations supplémentaires..."></textarea>
                            </div>
                        </div>
                        @endif
                        
                        {{-- Step 2: Products & Quantities --}}
                        @if($currentStep === 2)
                        <div>
                            {{-- Gender Selection --}}
                            <div class="mb-6">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Genre</label>
                                <div class="flex space-x-4">
                                    <label class="flex items-center">
                                        <input type="radio" wire:model.live="currentGenre" value="homme" 
                                               class="mr-2 text-blue-600 focus:ring-blue-500">
                                        <span>Homme</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="radio" wire:model.live="currentGenre" value="femme" 
                                               class="mr-2 text-blue-600 focus:ring-blue-500">
                                        <span>Femme</span>
                                    </label>
                                </div>
                            </div>
                            {{-- Product Selection Section --}}
                            <div class="mb-6">
                                <h4 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                    </svg>
                                    Sélection du Produit
                                </h4>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Article</label>
                                        <select wire:model="selectedArticle" 
                                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                            <option value="">Sélectionner un article</option>
                                            @foreach($articles as $article)
                                                <option value="{{ $article->nom }}">{{ $article->nom }}</option>
                                            @endforeach
                                        </select>
                                    </div>        
                                    @error('selectedArticle') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Forme</label>
                                        <select wire:model="selectedForme" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                                            <option value="">Sélectionner une forme</option>
                                            @foreach($formes as $forme)
                                                <option value="{{ $forme->id }}">{{ $forme->nom }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Semelle</label>
                                        <select wire:model="selectedSemelle" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                                            <option value="">Sélectionner une semelle</option>
                                            @foreach($semelles as $semelle)
                                                <option value="{{ $semelle->id }}">{{ $semelle->nom }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Cuir</label>
                                        <select wire:model="selectedCuir" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                                            <option value="">Sélectionner un cuir</option>
                                            @foreach($cuirs as $cuir)
                                                <option value="{{ $cuir->id }}">{{ $cuir->nom }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Supplement </label>
                                        <select wire:model="selectedSupplement" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                                            <option value="">Sélectionner un supplement</option>
                                            @foreach($supplements as $supplement)
                                                <option value="{{ $supplement->id }}">{{ $supplement->nom }}</option>
                                            @endforeach
                                        </select>
                                        @error('selectedSupplement') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                    </div>
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Doublure</label>
                                        <select wire:model="selectedDoublure" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                                            <option value="">Sélectionner une doublure</option>
                                            @foreach($doublures as $doublure)
                                                <option value="{{ $doublure->id }}">{{ $doublure->nom }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Construction</label>
                                        <select wire:model="selectedConstruction" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                                            <option value="">Sélectionner une construction</option>
                                            @foreach($constructions as $construction)
                                                <option value="{{ $construction->id }}">{{ $construction->nom }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Talon</label>
                                        <select wire:model.live="currentTalon" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                                            <option value="">Sélectionner un talon</option>
                                            @foreach($talonOptions as $talon)
                                                <option value="{{ $talon }}">{{ $talon }}</option>
                                            @endforeach
                                        </select>
                                        @if($currentTalon === 'autre')
                                            <input wire:model.live="customTalon" type="text" 
                                                class="w-full px-3 py-2 mt-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                                                placeholder="Spécifier le talon"
                                                wire:key="custom-talon-{{ $currentTalon }}">
                                        @endif
                                    </div>
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Lacet</label>
                                        <select wire:model.live="currentLacet" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                            <option value="">Sélectionner un lacet</option>
                                            @foreach($lacetOptions as $lacet)
                                                <option value="{{ $lacet }}">{{ $lacet }}</option>
                                            @endforeach
                                        </select>
                                        @if($currentLacet === 'autre')
                                            <input wire:model.live="customLacet" type="text" 
                                                class="w-full px-3 py-2 mt-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                                                placeholder="Spécifier le lacet"
                                                wire:key="custom-lacet-{{ $currentLacet }}">
                                        @endif
                                    </div>
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Longueur Lacet (cm)</label>
                                        <select wire:model.live="currentLacetLength" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                            <option value="">Sélectionner une longueur</option>
                                            @foreach($lacetLengthOptions as $length)
                                                <option value="{{ $length }}">{{ $length }}{{ $length !== 'autre' && $length !== 'Sans' ? ' cm' : '' }}</option>
                                            @endforeach
                                        </select>
                                        @if($currentLacetLength === 'autre')
                                            <input wire:model.live="customLacetLength" type="text" 
                                                class="w-full px-3 py-2 mt-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                                                placeholder="Spécifier la longueur (cm)"
                                                wire:key="custom-lacet-length-{{ $currentLacetLength }}">
                                        @endif
                                    </div>
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Finition</label>
                                        <select wire:model.live="currentFinition" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                                            <option value="">Sélectionner une finition</option>
                                            @foreach($finitionOptions as $finition)
                                                <option value="{{ $finition }}">{{ $finition }}</option>
                                            @endforeach
                                        </select>
                                        @if($currentFinition === 'autre')
                                            <input wire:model.live="customFinition" type="text" 
                                                class="w-full px-3 py-2 mt-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                                                placeholder="Spécifier la finition"
                                                wire:key="custom-finition-{{ $currentFinition }}">
                                        @endif
                                    </div>
                                    
                                    {{-- Checkboxes section matching legacy form --}}
                                    <div class="col-span-3">
                                        <label class="block text-sm font-medium text-gray-700 mb-3">Options Spéciales</label>
                                        <div class="flex gap-6">
                                            <div class="flex items-center">
                                                <input type="checkbox" wire:model="currentPerforation" id="perforation" 
                                                       class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                                <label for="perforation" class="ml-2 text-sm text-gray-700">Perforation</label>
                                            </div>
                                            <div class="flex items-center">
                                                <input type="checkbox" wire:model="currentFleur" id="fleur" 
                                                       class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                                <label for="fleur" class="ml-2 text-sm text-gray-700">Fleur</label>
                                            </div>
                                            <div class="flex items-center">
                                                <input type="checkbox" wire:model="currentDentlage" id="dentlage" 
                                                       class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                                <label for="dentlage" class="ml-2 text-sm text-gray-700">Dentlage</label>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Trépointe</label>
                                        <select wire:model.live="currentTrepointe" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                                            <option value="">Sélectionner une trépointe</option>
                                            @foreach($trepointeOptions as $trepointe)
                                                <option value="{{ $trepointe }}">{{ $trepointe }}</option>
                                            @endforeach
                                        </select>
                                        @if($currentTrepointe === 'autre')
                                            <input wire:model.live="customTrepointe" type="text" 
                                                class="w-full px-3 py-2 mt-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                                                placeholder="Spécifier la trépointe"
                                                wire:key="custom-trepointe-{{ $currentTrepointe }}">
                                        @endif
                                    </div>
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Prix unitaire </label>
                                        <input wire:model="productPrice" type="number" step="0.01" min="0"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 @error('productPrice') border-red-500 @enderror"
                                            placeholder="0.00">
                                        @error('productPrice') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                            
                            {{-- Comprehensive Size Grid --}}
                            <div class="mb-6">
                                <h4 class="text-lg font-medium text-gray-900 mb-4">Quantités par Taille</h4>
                                <div class="overflow-x-auto">
                                    <table class="min-w-full border border-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th class="px-2 py-2 text-xs font-medium text-gray-700 border-r">EU</th>
                                                <th class="px-2 py-2 text-xs font-medium text-gray-700 border-r">US</th>
                                                <th class="px-2 py-2 text-xs font-medium text-gray-700 border-r">FR</th>
                                                <th class="px-3 py-2 text-xs font-medium text-gray-700">Qté</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            @php
                                                $sizeMapping = $this->getSizeMapping();
                                            @endphp
                                            @foreach($sizeMapping as $euSize => $sizes)
                                                <tr>
                                                    <td class="px-2 py-1 text-sm font-medium border-r">{{ $sizes['eu'] }}</td>
                                                    <td class="px-2 py-1 text-sm text-gray-600 border-r">{{ $sizes['us'] }}</td>
                                                    <td class="px-2 py-1 text-sm text-gray-600 border-r">{{ $sizes['fr'] }}</td>
                                                    <td class="px-1 py-1">
                                                        @php
                                                            $dbColumn = $this->mapSizeToDb($euSize);
                                                        @endphp
                                                        <input wire:model="currentLine.{{ $dbColumn }}" 
                                                               type="number" min="0"
                                                               class="w-full px-2 py-1 text-sm border border-gray-300 rounded focus:ring-1 focus:ring-blue-500"
                                                               placeholder="0">
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            
                            {{-- Add Product Button --}}
                            <div class="mb-6">
                                <button type="button" wire:click="addOrderLine" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                                    <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                    Ajouter l'article
                                </button>
                            </div>
                            
                            {{-- Order Lines Table --}}
                            @if(count($orderLines) > 0)
                            <div class="mb-6">
                                <h4 class="text-lg font-medium text-gray-900 mb-4">Articles ajoutés</h4>
                                <div class="overflow-x-auto">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Article</th>
                                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Quantité</th>
                                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Prix Unit.</th>
                                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Total</th>
                                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            @foreach($orderLines as $index => $line)
                                            <tr>
                                                <td class="px-4 py-2 text-sm">{{ $line['article'] }}</td>
                                                <td class="px-4 py-2 text-sm">{{ $line['total_quantity'] }}</td>
                                                <td class="px-4 py-2 text-sm">€{{ number_format($line['price'], 2) }}</td>
                                                <td class="px-4 py-2 text-sm font-medium">€{{ number_format($line['total_amount'], 2) }}</td>
                                                <td class="px-4 py-2 text-sm">
                                                    <div class="flex space-x-2">
                                                        <button type="button" wire:click="editOrderLine({{ $index }})" class="text-blue-600 hover:text-blue-900" title="Modifier">
                                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                            </svg>
                                                        </button>
                                                        <button type="button" wire:click="removeOrderLine({{ $index }})" class="text-red-600 hover:text-red-900" title="Supprimer">
                                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            @endif
                        </div>
                        @endif
                    </div>

                    {{-- Modal Footer --}}
                    <div class="px-6 py-4 bg-gray-50 rounded-b-lg flex justify-between">
                        <div>
                            @if($currentStep > 1)
                                <button type="button" wire:click="previousStep" 
                                    wire:loading.attr="disabled"
                                    wire:loading.class="opacity-50 cursor-not-allowed"
                                    class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
                                    <span wire:loading.remove wire:target="previousStep">
                                        <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                        </svg>
                                        Précédent
                                    </span>
                                    <span wire:loading wire:target="previousStep" class="flex items-center">
                                        <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-gray-600" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                        </svg>
                                        Traitement...
                                    </span>
                                </button>
                            @endif
                        </div>
                        <div class="flex space-x-3">
                            <button type="button" wire:click="closeModal"
                                class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition-colors">
                                Annuler
                            </button>
                            @if($currentStep === 1)
                                <button type="button" wire:click="nextStep"
                                    wire:loading.attr="disabled"
                                    wire:loading.class="opacity-50 cursor-not-allowed"
                                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
                                    <span wire:loading.remove wire:target="nextStep">
                                        Suivant
                                        <svg class="w-5 h-5 inline-block ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </span>
                                    <span wire:loading wire:target="nextStep" class="flex items-center">
                                        <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                        </svg>
                                        Traitement...
                                    </span>
                                </button>
                            @else
                                <button type="submit"
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
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endif

{{-- View Order Modal --}}
@if($showViewModal && $viewingOrder)
    <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            {{-- Background overlay --}}
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" wire:click="closeViewModal" aria-hidden="true"></div>

            {{-- Modal panel --}}
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full">
                {{-- Header --}}
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-medium text-gray-900">Détails de la Commande #{{ $viewingOrder->code }}</h3>
                        <button wire:click="closeViewModal" class="text-gray-400 hover:text-gray-500">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>

                    {{-- Order Information --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <h4 class="text-sm font-semibold text-gray-700 mb-3">Informations Client</h4>
                            <dl class="space-y-2">
                                <div class="flex justify-between">
                                    <dt class="text-sm text-gray-500">Entreprise:</dt>
                                    <dd class="text-sm font-medium text-gray-900">{{ $viewingOrder->firm }}</dd>
                                </div>
                                <div class="flex justify-between">
                                    <dt class="text-sm text-gray-500">Ville:</dt>
                                    <dd class="text-sm font-medium text-gray-900">{{ $viewingOrder->ville }}</dd>
                                </div>
                                <div class="flex justify-between">
                                    <dt class="text-sm text-gray-500">Téléphone:</dt>
                                    <dd class="text-sm font-medium text-gray-900">{{ $viewingOrder->telephone }}</dd>
                                </div>
                            </dl>
                        </div>
                        
                        <div>
                            <h4 class="text-sm font-semibold text-gray-700 mb-3">Détails Commande</h4>
                            <dl class="space-y-2">
                                <div class="flex justify-between">
                                    <dt class="text-sm text-gray-500">Date Livraison:</dt>
                                    <dd class="text-sm font-medium text-gray-900">{{ \Carbon\Carbon::parse($viewingOrder->livraison)->format('d/m/Y') }}</dd>
                                </div>
                                <div class="flex justify-between">
                                    <dt class="text-sm text-gray-500">Statut:</dt>
                                    <dd>
                                        @if($viewingOrder->status == 'draft')
                                            <span class="px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-800">Brouillon</span>
                                        @elseif($viewingOrder->status == 'confirmed')
                                            <span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800">Confirmée</span>
                                        @elseif($viewingOrder->status == 'in_production')
                                            <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-800">En Production</span>
                                        @elseif($viewingOrder->status == 'delivered')
                                            <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">Livrée</span>
                                        @elseif($viewingOrder->status == 'cancelled')
                                            <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-800">Annulée</span>
                                        @endif
                                    </dd>
                                </div>
                                <div class="flex justify-between">
                                    <dt class="text-sm text-gray-500">Total:</dt>
                                    <dd class="text-sm font-bold text-gray-900">{{ number_format($viewingOrder->total_amount, 2) }} €</dd>
                                </div>
                            </dl>
                        </div>
                    </div>

                    @if($viewingOrder->notes)
                        <div class="mb-6">
                            <h4 class="text-sm font-semibold text-gray-700 mb-2">Notes</h4>
                            <p class="text-sm text-gray-600 bg-gray-50 p-3 rounded">{{ $viewingOrder->notes }}</p>
                        </div>
                    @endif

                    {{-- Order Lines --}}
                    <div>
                        <h4 class="text-sm font-semibold text-gray-700 mb-4">Articles Commandés</h4>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Article</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Spécifications</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pointures</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Prix Unitaire</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($viewingOrder->orderLines as $line)
                                        @php
                                            $totalQty = $line->p5 + $line->p6 + $line->p7 + $line->p8 + $line->p9 + $line->p10 + $line->p11 + $line->p12 + $line->p13;
                                            $lineTotal = $line->prix * $totalQty;
                                        @endphp
                                        <tr>
                                            <td class="px-4 py-3 text-sm text-gray-900">{{ $line->article }}</td>
                                            <td class="px-4 py-3 text-sm text-gray-600">
                                                <div class="space-y-1">
                                                    @if($line->forme)<span class="text-xs">Forme: {{ $line->forme }}</span><br>@endif
                                                    @if($line->semelle)<span class="text-xs">Semelle: {{ $line->semelle }}</span><br>@endif
                                                    @if($line->cuir)<span class="text-xs">Cuir: {{ $line->cuir }}</span><br>@endif
                                                    @if($line->supplement)<span class="text-xs">Supplément: {{ $line->supplement }}</span><br>@endif
                                                    @if($line->doublure)<span class="text-xs">Doublure: {{ $line->doublure }}</span><br>@endif
                                                    @if($line->construction)<span class="text-xs">Construction: {{ $line->construction }}</span>@endif
                                                </div>
                                            </td>
                                            <td class="px-4 py-3">
                                                <div class="grid grid-cols-5 gap-1 text-xs">
                                                    @if($line->p5 > 0)<span class="bg-gray-100 px-1 rounded">35:{{ $line->p5 }}</span>@endif
                                                    @if($line->p6 > 0)<span class="bg-gray-100 px-1 rounded">36:{{ $line->p6 }}</span>@endif
                                                    @if($line->p7 > 0)<span class="bg-gray-100 px-1 rounded">37:{{ $line->p7 }}</span>@endif
                                                    @if($line->p8 > 0)<span class="bg-gray-100 px-1 rounded">38:{{ $line->p8 }}</span>@endif
                                                    @if($line->p9 > 0)<span class="bg-gray-100 px-1 rounded">39:{{ $line->p9 }}</span>@endif
                                                    @if($line->p10 > 0)<span class="bg-gray-100 px-1 rounded">40:{{ $line->p10 }}</span>@endif
                                                    @if($line->p11 > 0)<span class="bg-gray-100 px-1 rounded">41:{{ $line->p11 }}</span>@endif
                                                    @if($line->p12 > 0)<span class="bg-gray-100 px-1 rounded">42:{{ $line->p12 }}</span>@endif
                                                    @if($line->p13 > 0)<span class="bg-gray-100 px-1 rounded">43:{{ $line->p13 }}</span>@endif
                                                </div>
                                                <div class="mt-1 text-xs text-gray-500">Total: {{ $totalQty }} paires</div>
                                            </td>
                                            <td class="px-4 py-3 text-sm text-right text-gray-900">{{ number_format($line->prix, 2) }} €</td>
                                            <td class="px-4 py-3 text-sm text-right font-medium text-gray-900">{{ number_format($lineTotal, 2) }} €</td>
                                            <td class="px-4 py-3 text-center">
                                                <a href="{{ route('print.order-line', ['orderId' => $viewingOrder->id, 'lineId' => $line->id]) }}" target="_blank" 
                                                   class="text-purple-600 hover:text-purple-900" title="Imprimer ligne détaillée">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                                                    </svg>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot class="bg-gray-50">
                                    <tr>
                                        <td colspan="5" class="px-4 py-3 text-sm text-right font-semibold text-gray-700">Total Commande:</td>
                                        <td class="px-4 py-3 text-sm text-right font-bold text-gray-900">{{ number_format($viewingOrder->total_amount, 2) }} €</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>

                {{-- Footer --}}
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button wire:click="$set('showViewModal', false)" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Fermer
                    </button>
                    <button wire:click="printOrder({{ $viewingOrder->id }})" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:mr-3 sm:w-auto sm:text-sm">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                        </svg>
                        Imprimer
                    </button>
                </div>
            </div>
        </div>
    </div>
@endif

{{-- Delivery Tracking Modal --}}
@if($showDeliveryModal && $deliveryOrder)
    <div class="fixed z-50 inset-0 overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" wire:click="closeDeliveryModal"></div>

            <div class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
                <div>
                    <div class="text-center">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                            Suivi de Livraison - Commande #{{ $deliveryOrder->code }}
                        </h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500">
                                Client: {{ $deliveryOrder->firm }} - {{ $deliveryOrder->ville }}
                            </p>
                        </div>
                    </div>

                    <div class="mt-5 space-y-4">
                        {{-- Current Status Display --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Statut Actuel
                            </label>
                            <div class="flex items-center gap-2">
                                @php
                                    $currentStatusColors = [
                                        'draft' => 'bg-gray-100 text-gray-800',
                                        'confirmed' => 'bg-blue-100 text-blue-800',
                                        'in_production' => 'bg-yellow-100 text-yellow-800',
                                        'delivered' => 'bg-green-100 text-green-800',
                                        'cancelled' => 'bg-red-100 text-red-800',
                                    ];
                                    $currentStatusLabels = [
                                        'draft' => 'Brouillon',
                                        'confirmed' => 'Confirmée',
                                        'in_production' => 'En Production',
                                        'delivered' => 'Livrée',
                                        'cancelled' => 'Annulée',
                                    ];
                                @endphp
                                <span class="px-3 py-1 text-sm font-medium rounded-full {{ $currentStatusColors[$deliveryOrder->status] ?? 'bg-gray-100 text-gray-800' }}">
                                    {{ $currentStatusLabels[$deliveryOrder->status] ?? $deliveryOrder->status }}
                                </span>
                                <span class="text-sm text-gray-500">
                                    Date prévue: {{ \Carbon\Carbon::parse($deliveryOrder->livraison)->format('d/m/Y') }}
                                </span>
                            </div>
                        </div>

                        {{-- Update Status --}}
                        <div>
                            <label for="deliveryStatus" class="block text-sm font-medium text-gray-700">
                                Nouveau Statut
                            </label>
                            <select wire:model="deliveryStatus" id="deliveryStatus" 
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                <option value="draft">Brouillon</option>
                                <option value="confirmed">Confirmée</option>
                                <option value="in_production">En Production</option>
                                <option value="delivered">Livrée</option>
                                <option value="cancelled">Annulée</option>
                            </select>
                            @error('deliveryStatus') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        {{-- Delivery Notes --}}
                        <div>
                            <label for="deliveryNotes" class="block text-sm font-medium text-gray-700">
                                Notes de Livraison
                            </label>
                            <textarea wire:model="deliveryNotes" id="deliveryNotes" rows="3"
                                      placeholder="Ajoutez des notes sur la livraison..."
                                      class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"></textarea>
                            @error('deliveryNotes') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        {{-- Delivery Progress Timeline --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Progression de la Livraison
                            </label>
                            <div class="relative">
                                @php
                                    $steps = ['draft', 'confirmed', 'in_production', 'delivered'];
                                    $currentIndex = array_search($deliveryOrder->status, $steps);
                                    if ($deliveryOrder->status === 'cancelled') {
                                        $currentIndex = -1;
                                    }
                                @endphp
                                <div class="flex items-center justify-between">
                                    @foreach($steps as $index => $step)
                                        <div class="flex flex-col items-center">
                                            <div class="flex items-center justify-center w-8 h-8 rounded-full 
                                                {{ $currentIndex >= $index ? 'bg-blue-600 text-white' : 'bg-gray-300 text-gray-500' }}">
                                                @if($currentIndex > $index)
                                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                                    </svg>
                                                @else
                                                    {{ $index + 1 }}
                                                @endif
                                            </div>
                                            <span class="text-xs mt-1 {{ $currentIndex >= $index ? 'text-blue-600' : 'text-gray-500' }}">
                                                {{ $currentStatusLabels[$step] }}
                                            </span>
                                        </div>
                                        @if(!$loop->last)
                                            <div class="flex-1 h-0.5 {{ $currentIndex > $index ? 'bg-blue-600' : 'bg-gray-300' }} -mt-4"></div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-5 sm:mt-6 sm:grid sm:grid-cols-2 sm:gap-3 sm:grid-flow-row-dense">
                    <button wire:click="updateDeliveryStatus"
                            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:col-start-2 sm:text-sm">
                        Mettre à jour
                    </button>
                    <button wire:click="closeDeliveryModal"
                            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:col-start-1 sm:text-sm">
                        Annuler
                    </button>
                </div>
            </div>
        </div>
    </div>
@endif

{{-- Printable Order View (Hidden, only for printing) --}}
@if($viewingOrder)
    <div id="printable-order" class="hidden print:block">
        <div class="p-8 bg-white">
            {{-- Header --}}
            <div class="text-center mb-8">
                <h1 class="text-2xl font-bold mb-2">BON DE COMMANDE</h1>
                <p class="text-gray-600">Commande #{{ $viewingOrder->code }}</p>
                <p class="text-sm text-gray-500">Date: {{ \Carbon\Carbon::now()->format('d/m/Y') }}</p>
            </div>

            {{-- Customer Information --}}
            <div class="grid grid-cols-2 gap-8 mb-8">
                <div>
                    <h2 class="font-semibold mb-2">Informations Client</h2>
                    <p><strong>Entreprise:</strong> {{ $viewingOrder->firm }}</p>
                    <p><strong>Ville:</strong> {{ $viewingOrder->ville }}</p>
                    <p><strong>Téléphone:</strong> {{ $viewingOrder->telephone }}</p>
                </div>
                <div>
                    <h2 class="font-semibold mb-2">Détails Livraison</h2>
                    <p><strong>Date Livraison:</strong> {{ \Carbon\Carbon::parse($viewingOrder->livraison)->format('d/m/Y') }}</p>
                    <p><strong>Statut:</strong> {{ ucfirst($viewingOrder->status) }}</p>
                </div>
            </div>

            {{-- Order Lines Table --}}
            <table class="w-full border-collapse mb-8">
                <thead>
                    <tr class="border-b-2 border-gray-300">
                        <th class="text-left py-2">Article</th>
                        <th class="text-left py-2">Spécifications</th>
                        <th class="text-center py-2">Tailles/Quantités</th>
                        <th class="text-right py-2">Prix Unit.</th>
                        <th class="text-right py-2">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($viewingOrder->orderLines as $line)
                        @php
                            $totalQty = $line->p5 + $line->p6 + $line->p7 + $line->p8 + $line->p9 + $line->p10 + $line->p11 + $line->p12 + $line->p13;
                            $lineTotal = $line->prix * $totalQty;
                        @endphp
                        <tr class="border-b border-gray-200">
                            <td class="py-2">{{ $line->article }}</td>
                            <td class="py-2 text-sm">
                                @if($line->forme)Forme: {{ $line->forme }}<br>@endif
                                @if($line->semelle)Semelle: {{ $line->semelle }}<br>@endif
                                @if($line->cuir)Cuir: {{ $line->cuir }}<br>@endif
                                @if($line->doublure)Doublure: {{ $line->doublure }}<br>@endif
                                @if($line->construction)Construction: {{ $line->construction }}@endif
                            </td>
                            <td class="py-2 text-center text-sm">
                                @if($line->p5 > 0)T35: {{ $line->p5 }} @endif
                                @if($line->p6 > 0)T36: {{ $line->p6 }} @endif
                                @if($line->p7 > 0)T37: {{ $line->p7 }} @endif
                                @if($line->p8 > 0)T38: {{ $line->p8 }} @endif
                                @if($line->p9 > 0)T39: {{ $line->p9 }} @endif
                                @if($line->p10 > 0)T40: {{ $line->p10 }} @endif
                                @if($line->p11 > 0)T41: {{ $line->p11 }} @endif
                                @if($line->p12 > 0)T42: {{ $line->p12 }} @endif
                                @if($line->p13 > 0)T43: {{ $line->p13 }} @endif
                                <br>Total: {{ $totalQty }} paires
                            </td>
                            <td class="py-2 text-right">{{ number_format($line->prix, 2) }} €</td>
                            <td class="py-2 text-right font-semibold">{{ number_format($lineTotal, 2) }} €</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="border-t-2 border-gray-300">
                        <td colspan="4" class="py-3 text-right font-bold">TOTAL:</td>
                        <td class="py-3 text-right font-bold text-lg">{{ number_format($viewingOrder->total_amount, 2) }} €</td>
                    </tr>
                </tfoot>
            </table>

            @if($viewingOrder->notes)
                <div class="mt-8">
                    <h2 class="font-semibold mb-2">Notes:</h2>
                    <p class="text-gray-700">{{ $viewingOrder->notes }}</p>
                </div>
            @endif

            {{-- Signature Section --}}
            <div class="mt-16 grid grid-cols-2 gap-8">
                <div>
                    <div class="border-t border-gray-400 pt-2">
                        <p class="text-sm">Signature Client</p>
                    </div>
                </div>
                <div>
                    <div class="border-t border-gray-400 pt-2">
                        <p class="text-sm">Signature Vendeur</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

{{-- JavaScript for printing --}}
<script>
    document.addEventListener('livewire:initialized', () => {
        Livewire.on('print-order', () => {
            setTimeout(() => {
                window.print();
            }, 100);
        });
    });
</script>

{{-- Print Styles --}}
<style>
    @media print {
        body * {
            visibility: hidden;
        }
        #printable-order, #printable-order * {
            visibility: visible;
        }
        #printable-order {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
        }
        @page {
            margin: 1cm;
        }
    }
</style>

{{-- Order Line Edit Modal --}}
@if($showLineEditModal)
<div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50" wire:click="closeLineEditModal">
    <div class="relative top-20 mx-auto p-5 border w-11/12 max-w-4xl shadow-lg rounded-md bg-white" wire:click.stop>
        <div class="mt-3">
            {{-- Modal Header --}}
            <div class="flex items-center justify-between pb-4 border-b">
                <h3 class="text-lg font-medium text-gray-900">Modifier la ligne de commande</h3>
                <button type="button" wire:click="closeLineEditModal" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            {{-- Modal Body --}}
            <div class="py-6 max-h-[600px] overflow-y-auto">
                {{-- Gender Selection --}}
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Genre</label>
                    <div class="flex space-x-4">
                        <label class="flex items-center">
                            <input type="radio" wire:model.live="currentGenre" value="homme" 
                                   class="mr-2 text-blue-600 focus:ring-blue-500">
                            <span>Homme</span>
                        </label>
                        <label class="flex items-center">
                            <input type="radio" wire:model.live="currentGenre" value="femme" 
                                   class="mr-2 text-blue-600 focus:ring-blue-500">
                            <span>Femme</span>
                        </label>
                    </div>
                </div>

                {{-- Product Selection --}}
                <div class="grid grid-cols-2 gap-4 mb-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Article <span class="text-red-500">*</span></label>
                        <select wire:model="selectedArticle" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                            <option value="">Sélectionner un article</option>
                            @foreach($articles as $article)
                                <option value="{{ $article->nom }}">{{ $article->nom }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Forme</label>
                        <select wire:model="selectedForme" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                            <option value="">Sélectionner une forme</option>
                            @foreach($formes as $forme)
                                <option value="{{ $forme->nom }}">{{ $forme->nom }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Semelle</label>
                        <select wire:model="selectedSemelle" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                            <option value="">Sélectionner une semelle</option>
                            @foreach($semelles as $semelle)
                                <option value="{{ $semelle->nom }}">{{ $semelle->nom }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Cuir</label>
                        <select wire:model="selectedCuir" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                            <option value="">Sélectionner un cuir</option>
                            @foreach($cuirs as $cuir)
                                <option value="{{ $cuir->nom }}">{{ $cuir->nom }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Supplement <span class="text-red-500">*</span></label>
                        <select wire:model="selectedSupplement" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                            <option value="">Sélectionner un supplement</option>
                            @foreach($supplements as $supplement)
                                <option value="{{ $supplement->id }}">{{ $supplement->nom }}</option>
                            @endforeach
                        </select>
                        @error('selectedSupplement') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Doublure</label>
                        <select wire:model="selectedDoublure" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                            <option value="">Sélectionner une doublure</option>
                            @foreach($doublures as $doublure)
                                <option value="{{ $doublure->nom }}">{{ $doublure->nom }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Construction</label>
                        <select wire:model="selectedConstruction" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                            <option value="">Sélectionner une construction</option>
                            @foreach($constructions as $construction)
                                <option value="{{ $construction->nom }}">{{ $construction->nom }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- Additional Fields --}}
                <div class="grid grid-cols-3 gap-4 mb-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Talon</label>
                        <select wire:model.live="currentTalon" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                            <option value="">Sélectionner un talon</option>
                            @foreach($talonOptions as $talon)
                                <option value="{{ $talon }}">{{ $talon }}</option>
                            @endforeach
                        </select>
                        @if($currentTalon === 'autre')
                            <input wire:model.live="customTalon" type="text" 
                                class="w-full px-3 py-2 mt-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                                placeholder="Spécifier le talon"
                                wire:key="edit-custom-talon-{{ $currentTalon }}">
                        @endif
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Lacet</label>
                        <select wire:model.live="currentLacet" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                            <option value="">Sélectionner un lacet</option>
                            @foreach($lacetOptions as $lacet)
                                <option value="{{ $lacet }}">{{ $lacet }}</option>
                            @endforeach
                        </select>
                        @if($currentLacet === 'autre')
                            <input wire:model.live="customLacet" type="text" 
                                class="w-full px-3 py-2 mt-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                                placeholder="Spécifier le lacet"
                                wire:key="edit-custom-lacet-{{ $currentLacet }}">
                        @endif
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Finition</label>
                        <select wire:model.live="currentFinition" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                            <option value="">Sélectionner une finition</option>
                            @foreach($finitionOptions as $finition)
                                <option value="{{ $finition }}">{{ $finition }}</option>
                            @endforeach
                        </select>
                        @if($currentFinition === 'autre')
                            <input wire:model.live="customFinition" type="text" 
                                class="w-full px-3 py-2 mt-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                                placeholder="Spécifier la finition"
                                wire:key="edit-custom-finition-{{ $currentFinition }}">
                        @endif
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Longueur Lacet (cm)</label>
                        <select wire:model.live="currentLacetLength" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                            <option value="">Sélectionner une longueur</option>
                            @foreach($lacetLengthOptions as $length)
                                <option value="{{ $length }}">{{ $length }}{{ $length !== 'autre' && $length !== 'Sans' ? ' cm' : '' }}</option>
                            @endforeach
                        </select>
                        @if($currentLacetLength === 'autre')
                            <input wire:model.live="customLacetLength" type="text" 
                                class="w-full px-3 py-2 mt-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                                placeholder="Spécifier la longueur (cm)"
                                wire:key="edit-custom-lacet-length-{{ $currentLacetLength }}">
                        @endif
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Trépointe</label>
                        <select wire:model.live="currentTrepointe" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                            <option value="">Sélectionner une trépointe</option>
                            @foreach($trepointeOptions as $trepointe)
                                <option value="{{ $trepointe }}">{{ $trepointe }}</option>
                            @endforeach
                        </select>
                        @if($currentTrepointe === 'autre')
                            <input wire:model.live="customTrepointe" type="text" 
                                class="w-full px-3 py-2 mt-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                                placeholder="Spécifier la trépointe"
                                wire:key="edit-custom-trepointe-{{ $currentTrepointe }}">
                        @endif
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-3">Options Spéciales</label>
                        <div class="flex gap-6">
                            <div class="flex items-center">
                                <input type="checkbox" wire:model="currentPerforation" id="edit_perforation" 
                                       class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                <label for="edit_perforation" class="ml-2 text-sm text-gray-700">Perforation</label>
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox" wire:model="currentFleur" id="edit_fleur" 
                                       class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                <label for="edit_fleur" class="ml-2 text-sm text-gray-700">Fleur</label>
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox" wire:model="currentDentlage" id="edit_dentlage" 
                                       class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                <label for="edit_dentlage" class="ml-2 text-sm text-gray-700">Dentlage</label>
                            </div>
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Prix unitaire </label>
                        <input wire:model="productPrice" type="number" step="0.01" min="0"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                            placeholder="0.00">
                    </div>
                </div>

                {{-- Size Grid --}}
                <div class="mb-6">
                    <h4 class="text-lg font-medium text-gray-900 mb-4">Quantités par Taille</h4>
                    <div class="overflow-x-auto">
                        <table class="min-w-full border border-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-2 py-2 text-xs font-medium text-gray-700 border-r">EU</th>
                                    <th class="px-2 py-2 text-xs font-medium text-gray-700 border-r">US</th>
                                    <th class="px-2 py-2 text-xs font-medium text-gray-700 border-r">FR</th>
                                    <th class="px-3 py-2 text-xs font-medium text-gray-700">Qté</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @php
                                    $sizeMapping = $this->getSizeMapping();
                                @endphp
                                @foreach($sizeMapping as $euSize => $sizes)
                                    <tr>
                                        <td class="px-2 py-1 text-sm font-medium border-r">{{ $sizes['eu'] }}</td>
                                        <td class="px-2 py-1 text-sm text-gray-600 border-r">{{ $sizes['us'] }}</td>
                                        <td class="px-2 py-1 text-sm text-gray-600 border-r">{{ $sizes['fr'] }}</td>
                                        <td class="px-1 py-1">
                                            @php
                                                $dbColumn = $this->mapSizeToDb($euSize);
                                            @endphp
                                            <input wire:model="currentLine.{{ $dbColumn }}" 
                                                   type="number" min="0"
                                                   class="w-full px-2 py-1 text-sm border border-gray-300 rounded focus:ring-1 focus:ring-blue-500"
                                                   placeholder="0">
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- Modal Footer --}}
            <div class="flex justify-end space-x-3 pt-4 border-t">
                <button type="button" wire:click="closeLineEditModal" 
                    class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition-colors">
                    Annuler
                </button>
                <button type="button" wire:click="updateOrderLine" 
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                    Mettre à jour
                </button>
            </div>
        </div>
    </div>
</div>
@endif
</div>
