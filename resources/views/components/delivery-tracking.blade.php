{{-- resources/views/components/delivery-tracking.blade.php --}}
@props(['order'])

<div>
    {{-- Order Info --}}
    <div class="text-center mb-6">
        <p class="text-sm text-gray-500">
            Client: {{ $order->firm }} - {{ $order->ville }}
        </p>
    </div>

    <div class="space-y-4">
        {{-- Current Status Display --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">
                Statut Actuel
            </label>
            <div class="flex items-center gap-2">
                <span class="px-3 py-1 text-sm font-medium rounded-full {{ $order->status_color }}">
                    {{ $order->status_label }}
                </span>
                <span class="text-sm text-gray-500">
                    Date prévue: {{ $order->livraison ? $order->livraison->format('d/m/Y') : '-' }}
                </span>
            </div>
        </div>

        {{-- Update Status --}}
        <div>
            <label for="deliveryStatus" class="block text-sm font-medium text-gray-700">
                Nouveau Statut
            </label>
            <select {{ $attributes->wire('model.status') }} id="deliveryStatus" 
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                <option value="draft">Brouillon</option>
                <option value="confirmed">Confirmée</option>
                <option value="in_production">En Production</option>
                <option value="delivered">Livrée</option>
                <option value="cancelled">Annulée</option>
            </select>
            @error('deliveryStatus') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        {{-- Delivery Progress Timeline --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">
                Progression de la Livraison
            </label>
            <div class="relative">
                @php
                    $steps = ['draft', 'confirmed', 'in_production', 'delivered'];
                    $stepLabels = [
                        'draft' => 'Brouillon',
                        'confirmed' => 'Confirmée',
                        'in_production' => 'En Production',
                        'delivered' => 'Livrée',
                    ];
                    $currentIndex = array_search($order->status, $steps);
                    if ($order->status === 'cancelled') {
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
                                {{ $stepLabels[$step] }}
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