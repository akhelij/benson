<div class="p-6">
    {{-- Because she competes with no one, no one can compete with her. --}}
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-serif text-amber-900">Gestion des Matériaux</h1>
        <button wire:click="createItem" class="bg-amber-700 hover:bg-amber-800 text-white px-4 py-2 rounded-lg flex items-center transition-colors duration-200 shadow-md">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
            Nouvel Élément
        </button>
    </div>

    <!-- Tabs -->
    <div class="mb-6">
        <div class="border-b border-amber-200">
            <nav class="-mb-px flex space-x-8">
                <button wire:click="setActiveTab('formes')" 
                        class="py-2 px-1 border-b-2 font-medium text-sm transition-colors duration-150 {{ $activeTab === 'formes' ? 'border-amber-600 text-amber-700' : 'border-transparent text-stone-600 hover:text-amber-700 hover:border-amber-300' }}">
                    Formes
                </button>
                <button wire:click="setActiveTab('articles')" 
                        class="py-2 px-1 border-b-2 font-medium text-sm transition-colors duration-150 {{ $activeTab === 'articles' ? 'border-amber-600 text-amber-700' : 'border-transparent text-stone-600 hover:text-amber-700 hover:border-amber-300' }}">
                    Articles
                </button>
                <button wire:click="setActiveTab('cuirs')" 
                        class="py-2 px-1 border-b-2 font-medium text-sm transition-colors duration-150 {{ $activeTab === 'cuirs' ? 'border-amber-600 text-amber-700' : 'border-transparent text-stone-600 hover:text-amber-700 hover:border-amber-300' }}">
                    Cuirs
                </button>
                <button wire:click="setActiveTab('semelles')" 
                        class="py-2 px-1 border-b-2 font-medium text-sm transition-colors duration-150 {{ $activeTab === 'semelles' ? 'border-amber-600 text-amber-700' : 'border-transparent text-stone-600 hover:text-amber-700 hover:border-amber-300' }}">
                    Semelles
                </button>
                <button wire:click="setActiveTab('constructions')" 
                        class="py-2 px-1 border-b-2 font-medium text-sm transition-colors duration-150 {{ $activeTab === 'constructions' ? 'border-amber-600 text-amber-700' : 'border-transparent text-stone-600 hover:text-amber-700 hover:border-amber-300' }}">
                    Constructions
                </button>
                <button wire:click="setActiveTab('supplements')" 
                        class="py-2 px-1 border-b-2 font-medium text-sm transition-colors duration-150 {{ $activeTab === 'supplements' ? 'border-amber-600 text-amber-700' : 'border-transparent text-stone-600 hover:text-amber-700 hover:border-amber-300' }}">
                    Suppléments
                </button>
            </nav>
        </div>
    </div>

    <!-- Search -->
    <div class="mb-6">
        <div class="relative">
            <input wire:model.live="search" type="text" placeholder="Rechercher..." 
                   class="w-full pl-10 pr-4 py-2 border border-amber-200 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent bg-stone-50">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
        </div>
    </div>

    <!-- Flash Messages -->
    @if (session()->has('message'))
        <div class="mb-4 bg-amber-50 border border-amber-400 text-amber-800 px-4 py-3 rounded-lg shadow-sm">
            {{ session('message') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="mb-4 bg-red-50 border border-red-400 text-red-700 px-4 py-3 rounded-lg shadow-sm">
            {{ session('error') }}
        </div>
    @endif

    <!-- Tab Content -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        
        <!-- Formes Tab -->
        @if($activeTab === 'formes')
            <div class="bg-white shadow-lg rounded-lg overflow-hidden border border-amber-100">
                <div class="px-6 py-4 bg-gradient-to-r from-amber-50 to-stone-50 border-b border-amber-100 flex justify-between items-center">
                    <h3 class="text-lg font-semibold text-amber-900">Formes</h3>
                    <button wire:click="createItem('forme')" class="bg-amber-700 hover:bg-amber-800 text-white px-3 py-1 rounded text-sm transition-colors duration-150">
                        + Ajouter
                    </button>
                </div>
                <table class="min-w-full divide-y divide-amber-50">
                    <thead class="bg-stone-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-amber-900 uppercase tracking-wider">Forme</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-amber-900 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-amber-50">
                        @forelse($formes as $forme)
                            <tr class="hover:bg-amber-50 transition-colors duration-150">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-stone-900">
                                    {{ $forme->nom }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <button wire:click="createArticleForForme({{ $forme->id }})" 
                                            class="text-green-700 hover:text-green-900 mr-3 transition-colors duration-150" title="Ajouter Article">
                                        + Article
                                    </button>
                                    <button wire:click="editItem({{ $forme->id }})" 
                                            class="text-amber-700 hover:text-amber-900 mr-3 transition-colors duration-150">
                                        Modifier
                                    </button>
                                    <button wire:click="deleteItem({{ $forme->id }})" 
                                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette forme?')"
                                            class="text-red-700 hover:text-red-900 transition-colors duration-150">
                                        Supprimer
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="px-6 py-4 text-center text-stone-500 italic">
                                    Aucune forme trouvée
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="px-6 py-4 bg-stone-50">
                    {{ $formes->links() }}
                </div>
            </div>

            <!-- Articles for selected forme -->
            <div class="bg-white shadow-lg rounded-lg overflow-hidden border border-amber-100">
                <div class="px-6 py-4 bg-gradient-to-r from-amber-50 to-stone-50 border-b border-amber-100 flex justify-between items-center">
                    <h3 class="text-lg font-semibold text-amber-900">Articles</h3>
                    <button wire:click="createItem('article')" class="bg-amber-700 hover:bg-amber-800 text-white px-3 py-1 rounded text-sm transition-colors duration-150">
                        + Ajouter
                    </button>
                </div>
                <table class="min-w-full divide-y divide-amber-50">
                    <thead class="bg-stone-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-amber-900 uppercase tracking-wider">Article</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-amber-900 uppercase tracking-wider">Forme</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-amber-900 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-amber-50">
                        @forelse($articles as $article)
                            <tr class="hover:bg-amber-50 transition-colors duration-150">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-stone-900">
                                    {{ $article->nom }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-stone-700">
                                    {{ $article->parent ? $article->parent->nom : '-' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <button wire:click="editItem({{ $article->id }})" 
                                            class="text-blue-600 hover:text-blue-900 mr-3">
                                        Modifier
                                    </button>
                                    <button wire:click="deleteItem({{ $article->id }})" 
                                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet article?')"
                                            class="text-red-600 hover:text-red-900">
                                        Supprimer
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-6 py-4 text-center text-gray-500">
                                    Aucun article trouvé
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="px-6 py-4 bg-gray-50">
                    {{ $articles->links() }}
                </div>
            </div>
        @endif

        <!-- Other tabs content -->
        @if($activeTab !== 'formes')
            <div class="lg:col-span-2">
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <div class="px-6 py-4 bg-gray-50 border-b border-gray-200 flex justify-between items-center">
                        <h3 class="text-lg font-medium text-gray-900">{{ ucfirst($activeTab) }}</h3>
                        <button wire:click="createItem('{{ $searchCriteria }}')" class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded text-sm">
                            + Ajouter
                        </button>
                    </div>
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @php
                                $items = ${$activeTab};
                            @endphp
                            @forelse($items as $item)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $item->nom }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <button wire:click="editItem({{ $item->id }})" 
                                                class="text-blue-600 hover:text-blue-900 mr-3">
                                            Modifier
                                        </button>
                                        <button wire:click="deleteItem({{ $item->id }})" 
                                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet élément?')"
                                                class="text-red-600 hover:text-red-900">
                                            Supprimer
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="px-6 py-4 text-center text-gray-500">
                                        Aucun élément trouvé
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="px-6 py-4 bg-gray-50">
                        {{ $items->links() }}
                    </div>
                </div>
            </div>
        @endif
    </div>

    <!-- Modal -->
    @if($showModal)
        <div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
            <div class="relative top-20 mx-auto p-5 border w-11/12 max-w-md shadow-lg rounded-md bg-white">
                <div class="mt-3">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">
                        {{ $editingItem ? 'Modifier' : 'Ajouter' }} {{ ucfirst($type) }}
                    </h3>
                    
                    <form wire:submit.prevent="saveItem">
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Type</label>
                            <select wire:model="type" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="forme">Forme</option>
                                <option value="article">Article</option>
                                <option value="cuir">Cuir</option>
                                <option value="semelle">Semelle</option>
                                <option value="construction">Construction</option>
                                <option value="supplement">Supplément</option>
                            </select>
                            @error('type') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        @if($type === 'article')
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Forme Parent</label>
                                <select wire:model="parent_id" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="">Sélectionner une forme</option>
                                    @foreach($availableFormes as $forme)
                                        <option value="{{ $forme->id }}">{{ $forme->nom }}</option>
                                    @endforeach
                                </select>
                                @error('parent_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                        @endif

                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nom *</label>
                            <input wire:model="nom" type="text" required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            @error('nom') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <!-- Modal Actions -->
                        <div class="flex justify-end space-x-3">
                            <button type="button" wire:click="$set('showModal', false)"
                                    class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400">
                                Annuler
                            </button>
                            <button type="submit"
                                    class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                                Enregistrer
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
</div>
