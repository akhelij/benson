{{-- resources/views/livewire/partials/order-line-form.blade.php --}}
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
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            {{-- Article --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Article <span class="text-red-500">*</span>
                </label>
                <select wire:model="selectedArticle" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('selectedArticle') border-red-500 @enderror">
                    <option value="">Sélectionner un article</option>
                    @foreach($articles as $article)
                        <option value="{{ $article->nom }}">{{ $article->nom }}</option>
                    @endforeach
                </select>
                @error('selectedArticle') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>
            
            {{-- Forme --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Forme</label>
                <select wire:model="selectedForme" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                    <option value="">Sélectionner une forme</option>
                    @foreach($formes as $forme)
                        <option value="{{ $forme->id }}">{{ $forme->nom }}</option>
                    @endforeach
                </select>
            </div>
            
            {{-- Semelle --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Semelle</label>
                <select wire:model="selectedSemelle" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                    <option value="">Sélectionner une semelle</option>
                    @foreach($semelles as $semelle)
                        <option value="{{ $semelle->id }}">{{ $semelle->nom }}</option>
                    @endforeach
                </select>
            </div>
            
            {{-- Cuir --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Cuir</label>
                <select wire:model="selectedCuir" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                    <option value="">Sélectionner un cuir</option>
                    @foreach($cuirs as $cuir)
                        <option value="{{ $cuir->id }}">{{ $cuir->nom }}</option>
                    @endforeach
                </select>
            </div>
            
            {{-- Supplement --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Supplements</label>
                <select wire:model="selectedSupplement" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                    <option value="">Sélectionner un supplement</option>
                    @foreach($supplements as $supplement)
                        <option value="{{ $supplement->id }}">{{ $supplement->nom }}</option>
                    @endforeach
                </select>
            </div>
            
            {{-- Doublure --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Doublure</label>
                <select wire:model="selectedDoublure" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                    <option value="">Sélectionner une doublure</option>
                    @foreach($doublures as $doublure)
                        <option value="{{ $doublure->id }}">{{ $doublure->nom }}</option>
                    @endforeach
                </select>
            </div>
            
            {{-- Construction --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Construction</label>
                <select wire:model="selectedConstruction" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                    <option value="">Sélectionner une construction</option>
                    @foreach($constructions as $construction)
                        <option value="{{ $construction->id }}">{{ $construction->nom }}</option>
                    @endforeach
                </select>
            </div>
            
            {{-- Prix --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Prix unitaire (€) <span class="text-red-500">*</span>
                </label>
                <input wire:model="productPrice" type="number" step="0.01" min="0"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 @error('productPrice') border-red-500 @enderror"
                    placeholder="0.00">
                @error('productPrice') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>
        </div>
    </div>

    {{-- Additional Options --}}
    <div class="mb-6">
        <h4 class="text-lg font-medium text-gray-900 mb-4">Options Supplémentaires</h4>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            {{-- Talon --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Talon</label>
                <select wire:model.live="currentTalon" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                    <option value="">Sélectionner un talon</option>
                    @foreach($talonOptions as $talon)
                        <option value="{{ $talon }}">{{ $talon }}</option>
                    @endforeach
                </select>
                @if($currentTalon === 'autre')
                    <input wire:model="customTalon" type="text" 
                        class="w-full px-3 py-2 mt-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                        placeholder="Spécifier le talon">
                @endif
            </div>
            
            {{-- Finition --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Finition</label>
                <select wire:model.live="currentFinition" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                    <option value="">Sélectionner une finition</option>
                    @foreach($finitionOptions as $finition)
                        <option value="{{ $finition }}">{{ $finition }}</option>
                    @endforeach
                </select>
                @if($currentFinition === 'autre')
                    <input wire:model="customFinition" type="text" 
                        class="w-full px-3 py-2 mt-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                        placeholder="Spécifier la finition">
                @endif
            </div>
            
            {{-- Lacet --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Lacet</label>
                <select wire:model.live="currentLacet" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                    <option value="">Sélectionner un lacet</option>
                    @foreach($lacetOptions as $lacet)
                        <option value="{{ $lacet }}">{{ $lacet }}</option>
                    @endforeach
                </select>
                @if($currentLacet === 'autre')
                    <input wire:model="customLacet" type="text" 
                        class="w-full px-3 py-2 mt-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                        placeholder="Spécifier le lacet">
                @endif
            </div>
            
            {{-- Longueur Lacet --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Longueur Lacet (cm)</label>
                <select wire:model.live="currentLacetLength" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                    <option value="">Sélectionner une longueur</option>
                    @foreach($lacetLengthOptions as $length)
                        <option value="{{ $length }}">{{ $length }}{{ $length !== 'autre' && $length !== 'Sans' ? ' cm' : '' }}</option>
                    @endforeach
                </select>
                @if($currentLacetLength === 'autre')
                    <input wire:model="customLacetLength" type="text" 
                        class="w-full px-3 py-2 mt-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                        placeholder="Spécifier la longueur (cm)">
                @endif
            </div>
            
            {{-- Trépointe --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Trépointe</label>
                <select wire:model.live="currentTrepointe" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                    <option value="">Sélectionner une trépointe</option>
                    @foreach($trepointeOptions as $trepointe)
                        <option value="{{ $trepointe }}">{{ $trepointe }}</option>
                    @endforeach
                </select>
                @if($currentTrepointe === 'autre')
                    <input wire:model="customTrepointe" type="text" 
                        class="w-full px-3 py-2 mt-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                        placeholder="Spécifier la trépointe">
                @endif
            </div>
        </div>
        
        {{-- Checkboxes --}}
        <div class="mt-4">
            <label class="block text-sm font-medium text-gray-700 mb-3">Options Spéciales</label>
            <div class="flex flex-wrap gap-4">
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
    </div>

    {{-- Size Grid with ALL columns (p5-p17) --}}
    <div class="mb-6">
        <h4 class="text-lg font-medium text-gray-900 mb-4">Quantités par Taille</h4>
        
        {{-- Show different size ranges based on gender --}}
        @if($currentGenre === 'femme')
            {{-- Women's sizes: 35-43 (using p5-p13) --}}
            <div class="bg-pink-50 p-2 rounded mb-2">
                <p class="text-sm text-gray-600">Tailles Femme (EU 35-43)</p>
            </div>
        @else
            {{-- Men's sizes: 38-47 (using p7-p17) --}}
            <div class="bg-blue-50 p-2 rounded mb-2">
                <p class="text-sm text-gray-600">Tailles Homme (EU 38-47)</p>
            </div>
        @endif
        
        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-2 py-2 text-xs font-medium text-gray-700 border-r">EU</th>
                        <th class="px-2 py-2 text-xs font-medium text-gray-700 border-r">US</th>
                        <th class="px-2 py-2 text-xs font-medium text-gray-700 border-r">FR</th>
                        <th class="px-3 py-2 text-xs font-medium text-gray-700">Quantité</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @php
                        $sizeMapping = $this->getSizeMapping();
                    @endphp
                    @foreach($sizeMapping as $euSize => $sizes)
                        <tr class="hover:bg-gray-50">
                            <td class="px-2 py-1 text-sm font-medium border-r">{{ $sizes['eu'] }}</td>
                            <td class="px-2 py-1 text-sm text-gray-600 border-r">{{ $sizes['us'] }}</td>
                            <td class="px-2 py-1 text-sm text-gray-600 border-r">{{ $sizes['fr'] }}</td>
                            <td class="px-1 py-1">
                                <input wire:model.lazy="currentLine.{{ $sizes['db'] }}" 
                                       type="number" 
                                       min="0"
                                       max="999"
                                       class="w-full px-2 py-1 text-sm border border-gray-300 rounded focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
                                       placeholder="0">
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot class="bg-gray-50">
                    <tr>
                        <td colspan="3" class="px-2 py-2 text-sm font-semibold text-right border-r">
                            Total Quantité:
                        </td>
                        <td class="px-2 py-2 text-sm font-bold text-center">
                            @php
                                $total = 0;
                                foreach($sizeMapping as $euSize => $sizes) {
                                    $total += $currentLine[$sizes['db']] ?? 0;
                                }
                            @endphp
                            {{ $total }} paires
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
        
        {{-- Hidden fields for unused size columns to maintain data integrity --}}
        @if($currentGenre === 'femme')
            {{-- For women, set men's exclusive sizes to 0 --}}
            <input type="hidden" wire:model="currentLine.p14" value="0">
            <input type="hidden" wire:model="currentLine.p14x" value="0">
            <input type="hidden" wire:model="currentLine.p15" value="0">
            <input type="hidden" wire:model="currentLine.p16" value="0">
            <input type="hidden" wire:model="currentLine.p17" value="0">
        @else
            {{-- For men, set women's exclusive sizes to 0 --}}
            <input type="hidden" wire:model="currentLine.p5" value="0">
            <input type="hidden" wire:model="currentLine.p5x" value="0">
            <input type="hidden" wire:model="currentLine.p6" value="0">
            <input type="hidden" wire:model="currentLine.p6x" value="0">
        @endif
    </div>
    
    {{-- Summary and Action Buttons --}}
    <div class="bg-gray-50 p-4 rounded-lg mb-6">
        <div class="flex justify-between items-center">
            <div>
                <p class="text-sm text-gray-600">Résumé de la ligne:</p>
                <p class="text-lg font-semibold">
                    @php
                        $totalQty = 0;
                        foreach (\App\Models\OrderLine::SIZE_COLUMNS as $column) {
                            $totalQty += $currentLine[$column] ?? 0;
                        }
                        $totalAmount = $totalQty * ($productPrice ?? 0);
                    @endphp
                    {{ $totalQty }} paires × €{{ number_format($productPrice ?? 0, 2) }} = 
                    <span class="text-green-600">€{{ number_format($totalAmount, 2) }}</span>
                </p>
            </div>
            
            <div class="flex gap-2">
                @if($editingLineIndex !== null)
                    <button type="button" wire:click="closeLineEditModal" 
                        class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors">
                        Annuler
                    </button>
                @endif
                
                <button type="button" 
                        wire:click="saveOrderLine" 
                        wire:loading.attr="disabled"
                        wire:loading.class="opacity-50 cursor-not-allowed"
                        class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
                    <span wire:loading.remove wire:target="saveOrderLine">
                        <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            @if($editingLineIndex !== null)
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            @else
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            @endif
                        </svg>
                        {{ $editingLineIndex !== null ? 'Mettre à jour l\'article' : 'Ajouter l\'article' }}
                    </span>
                    <span wire:loading wire:target="saveOrderLine" class="flex items-center">
                        <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Traitement...
                    </span>
                </button>
            </div>
        </div>
    </div>
    
    {{-- Error Messages Summary --}}
    @if($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-4">
            <p class="font-semibold mb-2">Veuillez corriger les erreurs suivantes:</p>
            <ul class="list-disc list-inside text-sm">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>