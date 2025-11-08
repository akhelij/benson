<div class="min-h-screen bg-gradient-to-br from-stone-50 via-amber-50/30 to-stone-100 p-6">
    <!-- Page Header with Vintage Styling -->
    <div class="mb-8">
        <h1 class="text-4xl font-serif text-amber-900 tracking-wide" style="font-family: 'Playfair Display', serif;">
            🧵 Cuirs dessus et données supplémentaires
        </h1>
        <div class="mt-2 h-1 w-32 bg-gradient-to-r from-amber-700 to-amber-500 rounded"></div>
        <p class="mt-3 text-stone-600 italic">Gestion des matériaux et finitions pour vos créations d'exception</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Cuirs Table -->
            <div class="bg-white rounded-lg shadow-lg border border-amber-100 overflow-hidden">
                <div class="bg-gradient-to-r from-amber-600 to-amber-700 px-6 py-4">
                    <h2 class="text-xl font-bold text-white" style="font-family: 'Playfair Display', serif;">Cuirs</h2>
                </div>
                
                <!-- Search Bar and Add Button -->
                <div class="px-6 py-3 bg-amber-50 border-b border-amber-100 flex justify-between items-center">
                    <input type="text" 
                           wire:model.live="searchCuir" 
                           placeholder="Rechercher un cuir..." 
                           class="flex-1 mr-4 px-3 py-2 border border-amber-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent text-sm">
                    @if (!$addingCuir)
                        <button wire:click="startAddCuir" 
                                class="bg-amber-600 text-white px-4 py-2 rounded-lg hover:bg-amber-700 transition-colors duration-200 flex items-center text-sm">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            Ajouter
                        </button>
                    @endif
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-stone-100 border-b border-amber-100">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-amber-900 uppercase tracking-wider">Image</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-amber-900 uppercase tracking-wider">Nom</th>
                                <th class="px-6 py-3 text-center text-xs font-semibold text-amber-900 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-amber-50">
                            <!-- Add New Row -->
                            @if($addingCuir)
                            <tr class="bg-amber-50/50">
                                <td class="px-4 py-3">
                                    <input type="file" 
                                           wire:model="cuirImage" 
                                           accept="image/*"
                                           class="w-full text-xs file:mr-2 file:py-1 file:px-2 file:rounded file:border-0 file:text-xs file:bg-amber-600 file:text-white hover:file:bg-amber-700">
                                    @error('cuirImage') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                </td>
                                <td class="px-4 py-3">
                                    <input type="text" 
                                           wire:model="newCuir.nom" 
                                           placeholder="Nom du cuir..."
                                           class="w-full px-2 py-1 border border-amber-300 rounded text-xs focus:outline-none focus:ring-1 focus:ring-amber-500">
                                    @error('newCuir.nom') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                </td>
                                <td class="px-4 py-3 text-center">
                                <button wire:click="saveCuir" class="text-emerald-600 hover:text-emerald-800 mr-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                </button>
                                <button wire:click="cancelAddCuir" class="text-red-600 hover:text-red-800">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                            </td>
                        </tr>
                        @endif

                        <!-- Data Rows -->
                        @forelse($cuirs as $cuir)
                        <tr class="hover:bg-amber-50/30 transition-colors duration-150">
                            @if($editingCuirId === $cuir->id)
                                <td class="px-4 py-3">
                                    <input type="file" 
                                           wire:model="editCuirImage" 
                                           accept="image/*"
                                           class="w-full text-xs file:mr-2 file:py-1 file:px-2 file:rounded file:border-0 file:text-xs file:bg-amber-600 file:text-white hover:file:bg-amber-700">
                                    @error('editCuirImage') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                    @if($cuir->getFirstMediaUrl('images'))
                                        <img src="{{ $cuir->getFirstMediaUrl('images') }}" alt="{{ $cuir->nom }}" class="w-10 h-10 object-cover rounded-lg shadow-sm mt-1">
                                    @endif
                                </td>
                                <td class="px-4 py-3">
                                    <input type="text" 
                                           wire:model="editCuir.nom" 
                                           class="w-full px-2 py-1 border border-amber-300 rounded text-xs focus:outline-none focus:ring-1 focus:ring-amber-500">
                                    @error('editCuir.nom') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <button wire:click="updateCuir" class="text-emerald-600 hover:text-emerald-800 mr-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                    </button>
                                    <button wire:click="cancelEditCuir" class="text-stone-600 hover:text-stone-800">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                    </button>
                                </td>
                            @else
                                <td class="px-4 py-3">
                                    @if($cuir->getFirstMediaUrl('images'))
                                        <div class="relative" style="width: 40px; height: 40px;" x-data="{ showDelete: false }" @mouseenter="showDelete = true" @mouseleave="showDelete = false">
                                            <img src="{{ $cuir->getFirstMediaUrl('images') }}" 
                                                 alt="{{ $cuir->nom }}" 
                                                 wire:click="previewImage('{{ $cuir->getFirstMediaUrl('images') }}')"
                                                 class="w-10 h-10 object-cover rounded-lg shadow-sm cursor-pointer hover:opacity-75 transition-opacity">
                                            <button wire:click.stop="deleteCuirImage({{ $cuir->id }})" 
                                                    x-show="showDelete"
                                                    x-transition
                                                    style="display: none; top: -6px; right: -6px;"
                                                    class="absolute bg-white text-red-600 rounded-full w-4 h-4 flex items-center justify-center hover:bg-red-50 shadow-lg z-10 border border-red-500"
                                                    title="Supprimer l'image">
                                                <svg class="w-2.5 h-2.5" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                                </svg>
                                            </button>
                                        </div>
                                    @else
                                        <div class="w-10 h-10 bg-gradient-to-br from-amber-100 to-amber-200 rounded-lg flex items-center justify-center shadow-sm">
                                            <span class="text-amber-800 font-bold text-xs">{{ strtoupper(substr($cuir->nom, 0, 2)) }}</span>
                                        </div>
                                    @endif
                                </td>
                                <td class="px-4 py-3">
                                    <span class="text-stone-900 font-medium text-sm">{{ $cuir->nom }}</span>
                                </td>
                                <td class="px-6 py-3 text-center">
                                    <button wire:click="editCuirRow({{ $cuir->id }})" class="text-amber-600 hover:text-amber-800 mr-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </button>
                                    <button wire:click="confirmDeleteCuir({{ $cuir->id }})" class="text-red-600 hover:text-red-800">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </td>
                            @endif
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="px-6 py-8 text-center text-stone-500 italic">
                                Aucun cuir trouvé
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Add Button & Pagination -->
            <div class="px-6 py-3 bg-stone-50 border-t border-amber-100">
                {{ $cuirs->links() }}
            </div>
        </div>

        <!-- Suppléments Table -->
        <div class="bg-white rounded-xl shadow-xl border border-amber-200 overflow-hidden">
            <div class="bg-gradient-to-r from-amber-700 to-amber-600 px-6 py-4">
                <h2 class="text-xl font-serif text-white">Données supplémentaires</h2>
            </div>
            
            <!-- Search Bar and Add Button -->
            <div class="px-6 py-3 bg-amber-50 border-b border-amber-100 flex justify-between items-center">
                <input type="text" 
                       wire:model.live="searchSupplement" 
                       placeholder="Rechercher..." 
                       class="flex-1 mr-4 px-3 py-2 border border-amber-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent text-sm">
                @if (!$addingSupplement)
                    <button wire:click="startAddSupplement" 
                            class="bg-amber-600 text-white px-4 py-2 rounded-lg hover:bg-amber-700 transition-colors duration-200 flex items-center text-sm">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Ajouter
                    </button>
                @endif
            </div>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-stone-100 border-b border-amber-100">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-amber-900 uppercase tracking-wider">Supplément</th>
                            <th class="px-6 py-3 text-center text-xs font-semibold text-amber-900 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-amber-50">
                        @if($addingSupplement)
                        <tr class="bg-amber-50/50">
                            <td class="px-6 py-3">
                                <input type="text" 
                                       wire:model="newSupplement.nom" 
                                       placeholder="Nom du supplément..."
                                       class="w-full px-3 py-2 border border-amber-300 rounded-md focus:outline-none focus:ring-2 focus:ring-amber-500 text-sm">
                                @error('newSupplement.nom') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </td>
                            <td class="px-6 py-3 text-center">
                                <button wire:click="saveSupplement" class="text-emerald-600 hover:text-emerald-800 mr-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                </button>
                                <button wire:click="cancelAddSupplement" class="text-red-600 hover:text-red-800">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                            </td>
                        </tr>
                        @endif

                        @forelse($supplements as $supplement)
                        <tr class="hover:bg-amber-50/30 transition-colors duration-150">
                            @if($editingSupplementId === $supplement->id)
                                <td class="px-6 py-3">
                                    <input type="text" 
                                           wire:model="editSupplement.nom" 
                                           class="w-full px-3 py-2 border border-amber-300 rounded-md focus:outline-none focus:ring-2 focus:ring-amber-500 text-sm">
                                    @error('editSupplement.nom') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                </td>
                                <td class="px-6 py-3 text-center">
                                    <button wire:click="updateSupplement" class="text-emerald-600 hover:text-emerald-800 mr-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                    </button>
                                    <button wire:click="cancelEditSupplement" class="text-stone-600 hover:text-stone-800">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                    </button>
                                </td>
                            @else
                                <td class="px-6 py-3">
                                    <span class="text-stone-900 font-medium">{{ $supplement->nom }}</span>
                                </td>
                                <td class="px-6 py-3 text-center">
                                    <button wire:click="editSupplementRow({{ $supplement->id }})" class="text-amber-600 hover:text-amber-800 mr-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </button>
                                    <button wire:click="confirmDeleteSupplement({{ $supplement->id }})" class="text-red-600 hover:text-red-800">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </td>
                            @endif
                        </tr>
                        @empty
                        <tr>
                            <td colspan="2" class="px-6 py-8 text-center text-stone-500 italic">
                                Aucun supplément trouvé
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="px-6 py-3 bg-stone-50 border-t border-amber-100">
                {{ $supplements->links() }}
            </div>
        </div>

        <!-- Doublures Table -->
        <div class="bg-white rounded-xl shadow-xl border border-amber-200 overflow-hidden">
            <div class="bg-gradient-to-r from-amber-700 to-amber-600 px-6 py-4">
                <h2 class="text-xl font-serif text-white">Doublures</h2>
            </div>
            
            <!-- Search Bar and Add Button -->
            <div class="px-6 py-3 bg-amber-50 border-b border-amber-100 flex justify-between items-center">
                <input type="text" 
                       wire:model.live="searchDoublure" 
                       placeholder="Rechercher une doublure..." 
                       class="flex-1 mr-4 px-3 py-2 border border-amber-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent text-sm">
                @if (!$addingDoublure)
                    <button wire:click="startAddDoublure" 
                            class="bg-amber-600 text-white px-4 py-2 rounded-lg hover:bg-amber-700 transition-colors duration-200 flex items-center text-sm">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Ajouter
                    </button>
                @endif
            </div>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-stone-100 border-b border-amber-100">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-amber-900 uppercase tracking-wider">Image</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-amber-900 uppercase tracking-wider">Nom</th>
                            <th class="px-4 py-3 text-center text-xs font-semibold text-amber-900 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-amber-50">
                        @if($addingDoublure)
                        <tr class="bg-amber-50/50">
                            <td class="px-4 py-3">
                                <input type="file" 
                                       wire:model="doublureImage" 
                                       accept="image/*"
                                       class="w-full text-xs file:mr-2 file:py-1 file:px-2 file:rounded file:border-0 file:text-xs file:bg-amber-600 file:text-white hover:file:bg-amber-700">
                                @error('doublureImage') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </td>
                            <td class="px-4 py-3">
                                <input type="text" 
                                       wire:model="newDoublure.nom" 
                                       placeholder="Nom de la doublure..."
                                       class="w-full px-2 py-1 border border-amber-300 rounded text-xs focus:outline-none focus:ring-1 focus:ring-amber-500">
                                @error('newDoublure.nom') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </td>
                            <td class="px-6 py-3 text-center">
                                <button wire:click="saveDoublure" class="text-emerald-600 hover:text-emerald-800 mr-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                </button>
                                <button wire:click="cancelAddDoublure" class="text-red-600 hover:text-red-800">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                            </td>
                        </tr>
                        @endif

                        @forelse($doublures as $doublure)
                        <tr class="hover:bg-amber-50/30 transition-colors duration-150">
                            @if($editingDoublureId === $doublure->id)
                                <td class="px-4 py-3">
                                    <input type="file" 
                                           wire:model="editDoublureImage" 
                                           accept="image/*"
                                           class="w-full text-xs file:mr-2 file:py-1 file:px-2 file:rounded file:border-0 file:text-xs file:bg-amber-600 file:text-white hover:file:bg-amber-700">
                                    @error('editDoublureImage') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                    @if($doublure->getFirstMediaUrl('images'))
                                        <img src="{{ $doublure->getFirstMediaUrl('images') }}" alt="{{ $doublure->nom }}" class="w-10 h-10 object-cover rounded-lg shadow-sm mt-1">
                                    @endif
                                </td>
                                <td class="px-4 py-3">
                                    <input type="text" 
                                           wire:model="editDoublure.nom" 
                                           class="w-full px-2 py-1 border border-amber-300 rounded text-xs focus:outline-none focus:ring-1 focus:ring-amber-500">
                                    @error('editDoublure.nom') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <button wire:click="updateDoublure" class="text-emerald-600 hover:text-emerald-800 mr-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                    </button>
                                    <button wire:click="cancelEditDoublure" class="text-stone-600 hover:text-stone-800">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                    </button>
                                </td>
                            @else
                                <td class="px-4 py-3">
                                    @if($doublure->getFirstMediaUrl('images'))
                                        <div class="relative" style="width: 40px; height: 40px;" x-data="{ showDelete: false }" @mouseenter="showDelete = true" @mouseleave="showDelete = false">
                                            <img src="{{ $doublure->getFirstMediaUrl('images') }}" 
                                                 alt="{{ $doublure->nom }}" 
                                                 wire:click="previewImage('{{ $doublure->getFirstMediaUrl('images') }}')"
                                                 class="w-10 h-10 object-cover rounded-lg shadow-sm cursor-pointer hover:opacity-75 transition-opacity">
                                            <button wire:click.stop="deleteDoublureImage({{ $doublure->id }})" 
                                                    x-show="showDelete"
                                                    x-transition
                                                    style="display: none; top: -6px; right: -6px;"
                                                    class="absolute bg-white text-red-600 rounded-full w-4 h-4 flex items-center justify-center hover:bg-red-50 shadow-lg z-10 border border-red-500"
                                                    title="Supprimer l'image">
                                                <svg class="w-2.5 h-2.5" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                                </svg>
                                            </button>
                                        </div>
                                    @else
                                        <div class="w-10 h-10 bg-gradient-to-br from-amber-100 to-amber-200 rounded-lg flex items-center justify-center shadow-sm">
                                            <span class="text-amber-800 font-bold text-xs">{{ strtoupper(substr($doublure->nom, 0, 2)) }}</span>
                                        </div>
                                    @endif
                                </td>
                                <td class="px-4 py-3">
                                    <span class="text-stone-900 font-medium text-sm">{{ $doublure->nom }}</span>
                                </td>
                                <td class="px-6 py-3 text-center">
                                    <button wire:click="editDoublureRow({{ $doublure->id }})" class="text-amber-600 hover:text-amber-800 mr-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </button>
                                    <button wire:click="confirmDeleteDoublure({{ $doublure->id }})" class="text-red-600 hover:text-red-800">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </td>
                            @endif
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="px-6 py-8 text-center text-stone-500 italic">
                                Aucune doublure trouvée
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="px-6 py-3 bg-stone-50 border-t border-amber-100">
                {{ $doublures->links() }}
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    @if($showDeleteConfirmation)
    <div class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-xl p-6 max-w-md w-full mx-4">
            <h3 class="text-xl font-bold text-stone-800 mb-4" style="font-family: 'Playfair Display', serif;">
                Confirmation de suppression
            </h3>
            <p class="text-stone-600 mb-6">
                Êtes-vous sûr de vouloir supprimer cet élément ? Cette action est irréversible.
            </p>
            <div class="flex justify-end space-x-3">
                <button wire:click="cancelDelete" class="px-4 py-2 bg-stone-200 text-stone-800 rounded-lg hover:bg-stone-300 transition-colors duration-200">
                    Annuler
                </button>
                <button wire:click="executeDelete" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors duration-200">
                    Supprimer
                </button>
            </div>
        </div>
    </div>
    @endif

    <!-- Image Preview Modal -->
    @if($showImagePreview)
    <div class="fixed inset-0 bg-gray-900 bg-opacity-75 flex items-center justify-center z-50" wire:click="closeImagePreview">
        <div class="relative max-w-4xl max-h-screen p-4" wire:click.stop>
            <button wire:click="closeImagePreview" 
                    class="absolute -top-2 -right-2 bg-white text-gray-800 rounded-full w-10 h-10 flex items-center justify-center shadow-lg hover:bg-gray-100 transition-colors z-10">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
            <img src="{{ $previewImageUrl }}" alt="Preview" class="max-w-full max-h-[90vh] rounded-lg shadow-2xl">
        </div>
    </div>
    @endif
</div>
