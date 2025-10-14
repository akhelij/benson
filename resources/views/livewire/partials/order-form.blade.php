{{-- resources/views/livewire/partials/order-form.blade.php --}}
<div class="px-6 py-4">
    {{-- Step 1: Basic Information --}}
    @if($step === 1)
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
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Ex: Boutique Mode">
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
                    <label class="block text-sm font-medium text-gray-700 mb-1">Ville</label>
                    <input wire:model="ville" type="text" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Ex: Paris">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Téléphone</label>
                    <input wire:model="telephone" type="text" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Ex: +33 6 12 34 56 78">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Date de Livraison <span class="text-red-500">*</span>
                    </label>
                    <input wire:model="livraison" type="date" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('livraison') border-red-500 @enderror">
                    @error('livraison') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Transporteur</label>
                    <input wire:model="transporteur" type="text" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Ex: DHL, UPS">
                </div>
            </div>
            
            {{-- Logo Upload Section --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                <x-logo-upload field="logo" label="Logo" />
                <x-logo-upload field="logo1" label="Logo Semelle" />
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
    @if($step === 2)
    <div>
        @include('livewire.partials.order-line-form')
        
        {{-- Order Lines Table --}}
        @if(count($orderLines) > 0)
        <div class="mb-6">
            <h4 class="text-lg font-medium text-gray-900 mb-4">Articles ajoutés</h4>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Article</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Spécifications</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Quantité</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Prix Unit.</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Total</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($orderLines as $index => $line)
                        <tr>
                            <td class="px-4 py-2 text-sm">
                                {{ $line['article'] }}
                            </td>
                            <td class="px-4 py-2 text-sm">
                                <div class="text-xs space-y-1">
                                    @if(!empty($line['forme']))
                                        <span>Forme: 
                                            {{ $line['forme'] }}
                                        </span><br>
                                    @endif
                                    @if(!empty($line['cuir']))
                                        <span>Cuir: 
                                            {{ $line['cuir'] }}
                                        </span><br>
                                    @endif
                                    @if(!empty($line['finition']))
                                        <span>Finition: {{ $line['finition'] }}</span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-4 py-2 text-sm">{{ $line['total_quantity'] ?? 0 }}</td>
                            <td class="px-4 py-2 text-sm">€{{ number_format($line['price'] ?? 0, 2) }}</td>
                            <td class="px-4 py-2 text-sm font-medium">€{{ number_format($line['total_amount'] ?? 0, 2) }}</td>
                            <td class="px-4 py-2 text-sm">
                                <div class="flex space-x-2">
                                    <button type="button" wire:click="editOrderLine({{ $index }})" 
                                        class="text-blue-600 hover:text-blue-900" title="Modifier">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </button>
                                    <button type="button" wire:click="removeOrderLine({{ $index }})" 
                                        class="text-red-600 hover:text-red-900" title="Supprimer">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="bg-gray-50">
                        <tr>
                            <td colspan="4" class="px-4 py-2 text-right font-semibold">Total:</td>
                            <td class="px-4 py-2 text-sm font-bold">
                                €{{ number_format(collect($orderLines)->sum('total_amount'), 2) }}
                            </td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        @endif
    </div>
    @endif
</div>