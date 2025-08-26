<div class="min-h-screen bg-gradient-to-br from-stone-50 via-amber-50/30 to-stone-100 p-6">
    <!-- Page Header with Vintage Styling -->
    <div class="mb-8">
        <h1 class="text-4xl font-serif text-amber-900 tracking-wide" style="font-family: 'Playfair Display', serif;">
            👟 Semelles & Constructions
        </h1>
        <div class="mt-2 h-1 w-32 bg-gradient-to-r from-amber-700 to-amber-500 rounded"></div>
        <p class="mt-3 text-stone-600 italic">Gestion des semelles et méthodes de construction pour vos créations d'exception</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Semelles Table -->
            <div class="bg-white rounded-lg shadow-lg border border-amber-100 overflow-hidden">
                <div class="bg-gradient-to-r from-amber-600 to-amber-700 px-6 py-4">
                    <h2 class="text-xl font-bold text-white" style="font-family: 'Playfair Display', serif;">Semelles</h2>
                </div>
                
                <!-- Search Bar and Add Button -->
                <div class="px-6 py-3 bg-amber-50 border-b border-amber-100 flex justify-between items-center">
                    <input type="text" 
                           wire:model.live="searchSemelles" 
                           placeholder="Rechercher une semelle..." 
                           class="flex-1 mr-4 px-3 py-2 border border-amber-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent text-sm">
                    @if (!$addingSemelle)
                        <button wire:click="startAddingSemelle" 
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
                            @if($addingSemelle)
                            <tr class="bg-amber-50/50">
                                <td class="px-4 py-3">
                                    <input type="file" 
                                           wire:model="semelleImage" 
                                           accept="image/*"
                                           class="w-full text-xs file:mr-2 file:py-1 file:px-2 file:rounded file:border-0 file:text-xs file:bg-amber-600 file:text-white hover:file:bg-amber-700">
                                    @error('semelleImage') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                </td>
                                <td class="px-4 py-3">
                                    <input type="text" 
                                           wire:model="semelleNom" 
                                           placeholder="Nom de la semelle..."
                                           class="w-full px-2 py-1 border border-amber-300 rounded text-xs focus:outline-none focus:ring-1 focus:ring-amber-500">
                                    @error('semelleNom') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                </td>
                                <td class="px-6 py-3 text-center">
                                    <button wire:click="saveSemelle" class="text-emerald-600 hover:text-emerald-800 mr-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                    </button>
                                    <button wire:click="cancelAddingSemelle" class="text-red-600 hover:text-red-800">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                            @endif

                            @forelse($semelles as $semelle)
                            <tr class="hover:bg-amber-50/30 transition-colors duration-150">
                                @if($editingSemelleId === $semelle->id)
                                    <td class="px-4 py-3">
                                        <input type="file" 
                                               wire:model="editSemelleImage" 
                                               accept="image/*"
                                               class="w-full text-xs file:mr-2 file:py-1 file:px-2 file:rounded file:border-0 file:text-xs file:bg-amber-600 file:text-white hover:file:bg-amber-700">
                                        @error('editSemelleImage') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                        @if($semelle->getFirstMediaUrl('images'))
                                            <img src="{{ $semelle->getFirstMediaUrl('images') }}" alt="{{ $semelle->nom }}" class="w-10 h-10 object-cover rounded-lg shadow-sm mt-1">
                                        @endif
                                    </td>
                                    <td class="px-4 py-3">
                                        <input type="text" 
                                               wire:model="editSemelle.nom" 
                                               class="w-full px-2 py-1 border border-amber-300 rounded text-xs focus:outline-none focus:ring-1 focus:ring-amber-500">
                                        @error('editSemelle.nom') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                    </td>
                                    <td class="px-6 py-3 text-center">
                                        <button wire:click="updateSemelle" class="text-emerald-600 hover:text-emerald-800 mr-2">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                            </svg>
                                        </button>
                                        <button wire:click="cancelEditingSemelle" class="text-stone-600 hover:text-stone-800">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                            </svg>
                                        </button>
                                    </td>
                                @else
                                    <td class="px-4 py-3">
                                        @if($semelle->getFirstMediaUrl('images'))
                                            <img src="{{ $semelle->getFirstMediaUrl('images') }}" alt="{{ $semelle->nom }}" class="w-10 h-10 object-cover rounded-lg shadow-sm">
                                        @else
                                            <div class="w-10 h-10 bg-gradient-to-br from-amber-100 to-amber-200 rounded-lg flex items-center justify-center shadow-sm">
                                                <span class="text-amber-800 font-bold text-xs">{{ strtoupper(substr($semelle->nom, 0, 2)) }}</span>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3">
                                        <span class="text-stone-900 font-medium text-sm">{{ $semelle->nom }}</span>
                                    </td>
                                    <td class="px-6 py-3 text-center">
                                        <button wire:click="editSemelleRow({{ $semelle->id }})" class="text-amber-600 hover:text-amber-800 mr-2">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                        </button>
                                        <button wire:click="confirmDeleteSemelle({{ $semelle->id }})" class="text-red-600 hover:text-red-800">
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
                                    Aucune semelle trouvée
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <div class="px-6 py-3 bg-stone-50 border-t border-amber-100">
                    {{ $semelles->links() }}
                </div>
            </div>

            <!-- Constructions Table -->
            <div class="bg-white rounded-xl shadow-xl border border-amber-200 overflow-hidden">
                <div class="bg-gradient-to-r from-amber-700 to-amber-600 px-6 py-4">
                    <h2 class="text-xl font-serif text-white">Constructions</h2>
                </div>
                
                <!-- Search Bar and Add Button -->
                <div class="px-6 py-3 bg-amber-50 border-b border-amber-100 flex justify-between items-center">
                    <input type="text" 
                           wire:model.live="searchConstructions" 
                           placeholder="Rechercher une construction..." 
                           class="flex-1 mr-4 px-3 py-2 border border-amber-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent text-sm">
                    @if (!$addingConstruction)
                        <button wire:click="startAddingConstruction" 
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
                                <th class="px-6 py-3 text-left text-xs font-semibold text-amber-900 uppercase tracking-wider">Construction</th>
                                <th class="px-6 py-3 text-center text-xs font-semibold text-amber-900 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-amber-50">
                            @if($addingConstruction)
                            <tr class="bg-amber-50/50">
                                <td class="px-6 py-3">
                                    <input type="text" 
                                           wire:model="constructionNom" 
                                           placeholder="Nom de la construction..."
                                           class="w-full px-3 py-2 border border-amber-300 rounded-md focus:outline-none focus:ring-2 focus:ring-amber-500 text-sm">
                                    @error('constructionNom') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                </td>
                                <td class="px-6 py-3 text-center">
                                    <button wire:click="saveConstruction" class="text-emerald-600 hover:text-emerald-800 mr-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                    </button>
                                    <button wire:click="cancelAddConstruction" class="text-red-600 hover:text-red-800">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                            @endif

                            @forelse($constructions as $construction)
                            <tr class="hover:bg-amber-50/30 transition-colors duration-150">
                                @if($editingConstructionId === $construction->id)
                                    <td class="px-6 py-3">
                                        <input type="text" 
                                               wire:model="editConstruction.nom" 
                                               class="w-full px-3 py-2 border border-amber-300 rounded-md focus:outline-none focus:ring-2 focus:ring-amber-500 text-sm">
                                        @error('editConstruction.nom') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                    </td>
                                    <td class="px-6 py-3 text-center">
                                        <button wire:click="updateConstruction" class="text-emerald-600 hover:text-emerald-800 mr-2">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                            </svg>
                                        </button>
                                        <button wire:click="cancelEditConstruction" class="text-stone-600 hover:text-stone-800">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                            </svg>
                                        </button>
                                    </td>
                                @else
                                    <td class="px-6 py-3">
                                        <span class="text-stone-900 font-medium">{{ $construction->nom }}</span>
                                    </td>
                                    <td class="px-6 py-3 text-center">
                                        <button wire:click="editConstructionRow({{ $construction->id }})" class="text-amber-600 hover:text-amber-800 mr-2">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                        </button>
                                        <button wire:click="confirmDeleteConstruction({{ $construction->id }})" class="text-red-600 hover:text-red-800">
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
                                    Aucune construction trouvée
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <div class="px-6 py-3 bg-stone-50 border-t border-amber-100">
                    {{ $constructions->links() }}
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
                                            <img src="{{ $doublure->getFirstMediaUrl('images') }}" alt="{{ $doublure->nom }}" class="w-10 h-10 object-cover rounded-lg shadow-sm">
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
</div>
