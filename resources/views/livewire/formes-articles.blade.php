<div class="min-h-screen bg-gradient-to-br from-stone-50 via-amber-50/30 to-stone-100 p-6">
    <!-- Page Header with Vintage Styling -->
    <div class="mb-8">
        <h1 class="text-4xl font-serif text-amber-900 tracking-wide" style="font-family: 'Playfair Display', serif;">
            📦 Gestion des Formes et Articles
        </h1>
        <div class="mt-2 h-1 w-32 bg-gradient-to-r from-amber-700 to-amber-500 rounded"></div>
        <p class="mt-3 text-stone-600 italic">Organisez vos formes et articles pour vos créations d'exception</p>
    </div>

    <!-- Filter Info Bar -->
    @if($selectedFormeId)
    <div class="mb-6 bg-amber-100 border border-amber-300 rounded-lg px-4 py-3 flex items-center justify-between">
        <div class="flex items-center">
            <svg class="w-5 h-5 text-amber-700 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
            </svg>
            <span class="text-amber-800 font-medium">Articles filtrés par forme : <strong>{{ $selectedFormeName }}</strong></span>
        </div>
        <button wire:click="filterByForme(null)" class="text-amber-700 hover:text-amber-900 font-medium text-sm">
            ✕ Effacer le filtre
        </button>
    </div>
    @endif

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

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Formes Table -->
        <div class="bg-white rounded-lg shadow-lg border border-amber-100 overflow-hidden">
            <div class="bg-gradient-to-r from-amber-600 to-amber-700 px-6 py-4">
                <h2 class="text-xl font-bold text-white" style="font-family: 'Playfair Display', serif;">Formes</h2>
            </div>
            
            <!-- Search Bar and Add Button -->
            <div class="px-6 py-3 bg-amber-50 border-b border-amber-100 flex justify-between items-center">
                <input type="text" 
                       wire:model.live="searchForme" 
                       placeholder="Rechercher une forme..." 
                       class="flex-1 mr-4 px-3 py-2 border border-amber-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent text-sm">
                @if (!$addingForme)
                    <button wire:click="startAddForme" 
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
                        @if($addingForme)
                        <tr class="bg-amber-50/50">
                            <td class="px-4 py-3">
                                <input type="file" 
                                       wire:model="formeImage" 
                                       accept="image/*"
                                       class="w-full text-xs file:mr-2 file:py-1 file:px-2 file:rounded file:border-0 file:text-xs file:bg-amber-600 file:text-white hover:file:bg-amber-700">
                                @error('formeImage') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </td>
                            <td class="px-4 py-3">
                                <input type="text" 
                                       wire:model="newForme.nom" 
                                       placeholder="Nom de la forme..."
                                       class="w-full px-2 py-1 border border-amber-300 rounded text-xs focus:outline-none focus:ring-1 focus:ring-amber-500">
                                @error('newForme.nom') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </td>
                            <td class="px-4 py-3 text-center">
                                <button wire:click="saveForme" class="text-emerald-600 hover:text-emerald-800 mr-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                </button>
                                <button wire:click="cancelAddForme" class="text-red-600 hover:text-red-800">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                            </td>
                        </tr>
                        @endif

                        <!-- Data Rows -->
                        @forelse($formes as $forme)
                        <tr class="hover:bg-amber-50/30 transition-colors duration-150">
                            @if($editingFormeId === $forme->id)
                                <td class="px-4 py-3">
                                    <input type="file" 
                                           wire:model="editFormeImage" 
                                           accept="image/*"
                                           class="w-full text-xs file:mr-2 file:py-1 file:px-2 file:rounded file:border-0 file:text-xs file:bg-amber-600 file:text-white hover:file:bg-amber-700">
                                    @error('editFormeImage') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                </td>
                                <td class="px-4 py-3">
                                    <input type="text" 
                                           wire:model="editForme.nom" 
                                           class="w-full px-2 py-1 border border-amber-300 rounded text-xs focus:outline-none focus:ring-1 focus:ring-amber-500">
                                    @error('editForme.nom') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <button wire:click="updateForme" class="text-emerald-600 hover:text-emerald-800 mr-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                    </button>
                                    <button wire:click="cancelEditForme" class="text-red-600 hover:text-red-800">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                    </button>
                                </td>
                            @else
                                <td class="px-4 py-3">
                                    @if($forme->getFirstMediaUrl('images'))
                                        <div class="relative" style="width: 40px; height: 40px;" x-data="{ showDelete: false }" @mouseenter="showDelete = true" @mouseleave="showDelete = false">
                                            <img src="{{ $forme->getFirstMediaUrl('images') }}" 
                                                 alt="{{ $forme->nom }}" 
                                                 wire:click="previewImage('{{ $forme->getFirstMediaUrl('images') }}')"
                                                 class="w-10 h-10 object-cover rounded-lg shadow-sm cursor-pointer hover:opacity-75 transition-opacity">
                                            <button wire:click.stop="deleteFormeImage({{ $forme->id }})" 
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
                                            <span class="text-amber-800 font-bold text-xs">{{ strtoupper(substr($forme->nom, 0, 2)) }}</span>
                                        </div>
                                    @endif
                                </td>
                                <td class="px-4 py-3">
                                    <span class="text-stone-900 font-medium text-sm">{{ $forme->nom }}</span>
                                </td>
                                <td class="px-6 py-3 text-center">
                                    <button wire:click="filterByForme({{ $forme->id }})" 
                                            class="text-blue-600 hover:text-blue-800 mr-2" 
                                            title="Filtrer les articles">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                                        </svg>
                                    </button>
                                    <button wire:click="editFormeRow({{ $forme->id }})" class="text-amber-600 hover:text-amber-800 mr-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </button>
                                    <button wire:click="confirmDeleteForme({{ $forme->id }})" class="text-red-600 hover:text-red-800">
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
                                Aucune forme trouvée
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="px-6 py-3 bg-stone-50 border-t border-amber-100">
                {{ $formes->links() }}
            </div>
        </div>

        <!-- Articles Table -->
        <div class="bg-white rounded-lg shadow-lg border border-amber-100 overflow-hidden">
            <div class="bg-gradient-to-r from-amber-600 to-amber-700 px-6 py-4">
                <h2 class="text-xl font-bold text-white" style="font-family: 'Playfair Display', serif;">
                    Articles
                    @if($selectedFormeName)
                        <span class="text-sm font-normal ml-2">({{ $selectedFormeName }})</span>
                    @endif
                </h2>
            </div>
            
            <!-- Search Bar and Add Button -->
            <div class="px-6 py-3 bg-amber-50 border-b border-amber-100 flex justify-between items-center">
                <input type="text" 
                       wire:model.live="searchArticle" 
                       placeholder="Rechercher un article..." 
                       class="flex-1 mr-4 px-3 py-2 border border-amber-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent text-sm">
                @if (!$addingArticle)
                    <button wire:click="startAddArticle" 
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
                            <th class="px-6 py-3 text-left text-xs font-semibold text-amber-900 uppercase tracking-wider">Forme</th>
                            <th class="px-6 py-3 text-center text-xs font-semibold text-amber-900 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-amber-50">
                        <!-- Add New Row -->
                        @if($addingArticle)
                        <tr class="bg-amber-50/50">
                            <td class="px-4 py-3">
                                <input type="file" 
                                       wire:model="articleImage" 
                                       accept="image/*"
                                       class="w-full text-xs file:mr-2 file:py-1 file:px-2 file:rounded file:border-0 file:text-xs file:bg-amber-600 file:text-white hover:file:bg-amber-700">
                                @error('articleImage') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </td>
                            <td class="px-4 py-3">
                                <input type="text" 
                                       wire:model="newArticle.nom" 
                                       placeholder="Nom de l'article..."
                                       class="w-full px-2 py-1 border border-amber-300 rounded text-xs focus:outline-none focus:ring-1 focus:ring-amber-500">
                                @error('newArticle.nom') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </td>
                            <td class="px-4 py-3">
                                <select wire:model="newArticle.parent_id" 
                                        class="w-full px-2 py-1 border border-amber-300 rounded text-xs focus:outline-none focus:ring-1 focus:ring-amber-500">
                                    <option value="">Sélectionner une forme</option>
                                    @foreach($availableFormes as $forme)
                                        <option value="{{ $forme->id }}">{{ $forme->nom }}</option>
                                    @endforeach
                                </select>
                                @error('newArticle.parent_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </td>
                            <td class="px-4 py-3 text-center">
                                <button wire:click="saveArticle" class="text-emerald-600 hover:text-emerald-800 mr-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                </button>
                                <button wire:click="cancelAddArticle" class="text-red-600 hover:text-red-800">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                            </td>
                        </tr>
                        @endif

                        <!-- Data Rows -->
                        @forelse($articles as $article)
                        <tr class="hover:bg-amber-50/30 transition-colors duration-150">
                            @if($editingArticleId === $article->id)
                                <td class="px-4 py-3">
                                    <input type="file" 
                                           wire:model="editArticleImage" 
                                           accept="image/*"
                                           class="w-full text-xs file:mr-2 file:py-1 file:px-2 file:rounded file:border-0 file:text-xs file:bg-amber-600 file:text-white hover:file:bg-amber-700">
                                    @error('editArticleImage') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                </td>
                                <td class="px-4 py-3">
                                    <input type="text" 
                                           wire:model="editArticle.nom" 
                                           class="w-full px-2 py-1 border border-amber-300 rounded text-xs focus:outline-none focus:ring-1 focus:ring-amber-500">
                                    @error('editArticle.nom') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                </td>
                                <td class="px-4 py-3">
                                    <select wire:model="editArticle.parent_id" 
                                            class="w-full px-2 py-1 border border-amber-300 rounded text-xs focus:outline-none focus:ring-1 focus:ring-amber-500">
                                        <option value="">Sélectionner une forme</option>
                                        @foreach($availableFormes as $forme)
                                            <option value="{{ $forme->id }}">{{ $forme->nom }}</option>
                                        @endforeach
                                    </select>
                                    @error('editArticle.parent_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <button wire:click="updateArticle" class="text-emerald-600 hover:text-emerald-800 mr-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                    </button>
                                    <button wire:click="cancelEditArticle" class="text-red-600 hover:text-red-800">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                    </button>
                                </td>
                            @else
                                <td class="px-4 py-3">
                                    @if($article->getFirstMediaUrl('images'))
                                        <div class="relative" style="width: 40px; height: 40px;" x-data="{ showDelete: false }" @mouseenter="showDelete = true" @mouseleave="showDelete = false">
                                            <img src="{{ $article->getFirstMediaUrl('images') }}" 
                                                 alt="{{ $article->nom }}" 
                                                 wire:click="previewImage('{{ $article->getFirstMediaUrl('images') }}')"
                                                 class="w-10 h-10 object-cover rounded-lg shadow-sm cursor-pointer hover:opacity-75 transition-opacity">
                                            <button wire:click.stop="deleteArticleImage({{ $article->id }})" 
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
                                        <div class="w-10 h-10 bg-gradient-to-br from-stone-100 to-stone-200 rounded-lg flex items-center justify-center shadow-sm">
                                            <span class="text-stone-700 font-bold text-xs">{{ strtoupper(substr($article->nom, 0, 2)) }}</span>
                                        </div>
                                    @endif
                                </td>
                                <td class="px-4 py-3">
                                    <span class="text-stone-900 font-medium text-sm">{{ $article->nom }}</span>
                                </td>
                                <td class="px-4 py-3">
                                    @if($article->parent)
                                        <span class="text-xs bg-amber-100 text-amber-800 px-2 py-1 rounded-full">{{ $article->parent->nom }}</span>
                                    @else
                                        <span class="text-xs text-stone-400 italic">Aucune</span>
                                    @endif
                                </td>
                                <td class="px-6 py-3 text-center">
                                    <button wire:click="editArticleRow({{ $article->id }})" class="text-amber-600 hover:text-amber-800 mr-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </button>
                                    <button wire:click="confirmDeleteArticle({{ $article->id }})" class="text-red-600 hover:text-red-800">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </td>
                            @endif
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-8 text-center text-stone-500 italic">
                                @if($selectedFormeId)
                                    Aucun article trouvé pour cette forme
                                @else
                                    Aucun article trouvé
                                @endif
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="px-6 py-3 bg-stone-50 border-t border-amber-100">
                {{ $articles->links() }}
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
