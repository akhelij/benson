{{-- resources/views/components/orders-table.blade.php --}}
@props(['orders'])

<div class="overflow-x-auto">
    <table class="w-full">
        <thead class="bg-stone-100 border-b border-amber-100">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-semibold text-amber-900 uppercase tracking-wider">
                    <input type="checkbox" wire:model.live="selectAll" 
                           class="rounded border-amber-300 text-amber-600 focus:ring-amber-500">
                </th>
                <th wire:click="sortBy('code')" 
                    class="px-6 py-3 text-left text-xs font-semibold text-amber-900 uppercase tracking-wider cursor-pointer hover:bg-amber-50">
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
                <th wire:click="sortBy('firm')" 
                    class="px-6 py-3 text-left text-xs font-semibold text-amber-900 uppercase tracking-wider cursor-pointer hover:bg-amber-50">
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
                <th wire:click="sortBy('total_quantity')" 
                    class="px-6 py-3 text-left text-xs font-semibold text-amber-900 uppercase tracking-wider cursor-pointer hover:bg-amber-50">
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
                <th wire:click="sortBy('total_amount')" 
                    class="px-6 py-3 text-left text-xs font-semibold text-amber-900 uppercase tracking-wider cursor-pointer hover:bg-amber-50">
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
                <th wire:click="sortBy('livraison')" 
                    class="px-6 py-3 text-left text-xs font-semibold text-amber-900 uppercase tracking-wider cursor-pointer hover:bg-amber-50">
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
                        <input type="checkbox" wire:model.live="selectedOrders" value="{{ $order->id }}" 
                               class="rounded border-amber-300 text-amber-600 focus:ring-amber-500">
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-stone-900">
                        {{ $order->code }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-stone-900">{{ $order->firm }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-stone-600">{{ $order->ville }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-stone-900">{{ $order->total_quantity ?: 0 }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-stone-900">
                        €{{ number_format($order->total_amount ?: 0, 2, ',', ' ') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="text-sm text-stone-900">
                            {{ $order->livraison ? $order->livraison->format('d/m/Y') : '-' }}
                        </span>
                        @if($order->is_overdue)
                            <span class="ml-1 text-xs text-red-600">(En retard)</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 py-1 text-xs font-medium rounded-full {{ $order->status_color }}">
                            {{ $order->status_label }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-center">
                        <div class="flex items-center justify-center gap-2">
                            <button wire:click="viewOrder({{ $order->id }})" 
                                    class="text-blue-600 hover:text-blue-800" title="Voir">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </button>
                            <button wire:click="openDeliveryModal({{ $order->id }})" 
                                    class="text-emerald-600 hover:text-emerald-800" title="Suivi livraison">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                                </svg>
                            </button>
                            <button wire:click="openOrderModal({{ $order->id }})" 
                                    class="text-amber-600 hover:text-amber-800" title="Modifier">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </button>
                            <a href="{{ route('print.order', $order->id) }}" target="_blank" 
                               class="text-purple-600 hover:text-purple-800" title="Imprimer commande">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                                </svg>
                            </a>
                            <button wire:click="deleteOrder({{ $order->id }})" 
                                    wire:confirm="Êtes-vous sûr de vouloir supprimer cette commande ?"
                                    class="text-red-600 hover:text-red-800" title="Supprimer">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
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
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <p class="text-stone-500">Aucune commande trouvée</p>
                            <button wire:click="openOrderModal" 
                                    class="mt-4 text-amber-600 hover:text-amber-800 font-medium">
                                Créer votre première commande
                            </button>
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>