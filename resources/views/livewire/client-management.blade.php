<div class="min-h-screen bg-gradient-to-br from-stone-50 via-amber-50/30 to-stone-100 p-6">
    <!-- Page Header with Vintage Styling -->
    <div class="mb-8">
        <h1 class="text-4xl font-serif text-amber-900 tracking-wide" style="font-family: 'Playfair Display', serif;">
            👥 Gestion des Clients
        </h1>
        <div class="mt-2 h-1 w-32 bg-gradient-to-r from-amber-700 to-amber-500 rounded"></div>
        <p class="mt-3 text-stone-600 italic">Registre distingué de votre clientèle d'exception</p>
    </div>

    <!-- Main Card -->
    <div class="bg-white rounded-lg shadow-lg border border-amber-100 overflow-hidden">
        <!-- Header Section -->
        <div class="bg-gradient-to-r from-amber-600 to-amber-700 px-6 py-4">
            <div class="flex justify-between items-center">
                <h2 class="text-xl font-bold text-white" style="font-family: 'Playfair Display', serif;">Clients</h2>
                <button wire:click="createClient" class="bg-amber-600 text-white px-4 py-2 rounded-lg hover:bg-amber-700 transition-colors duration-200 flex items-center text-sm">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Ajouter
                </button>
            </div>
        </div>

        <!-- Search Bar -->
        <div class="px-6 py-3 bg-amber-50 border-b border-amber-100 flex justify-between items-center">
            <input wire:model.live="search" type="text" placeholder="Rechercher un client..." 
                   class="flex-1 mr-4 px-3 py-2 border border-amber-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent text-sm">
            <select wire:model.live="searchCriteria" class="px-3 py-2 border border-amber-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent text-sm bg-white">
                <option value="nom">Nom</option>
                <option value="telephone">Téléphone</option>
                <option value="email">Email</option>
                <option value="ville">Ville</option>
                <option value="pays">Pays</option>
            </select>
        </div>

        <!-- Flash Messages -->
        @if (session()->has('message'))
            <div class="mx-6 mt-4 bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-lg shadow-sm">
                {{ session('message') }}
            </div>
        @endif

        <!-- Clients Table -->
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-stone-100 border-b border-amber-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-amber-900 uppercase tracking-wider">Nom</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-amber-900 uppercase tracking-wider">Téléphone</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-amber-900 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-amber-900 uppercase tracking-wider">Adresse</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-amber-900 uppercase tracking-wider">Ville</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-amber-900 uppercase tracking-wider">Pays</th>
                        <th class="px-6 py-3 text-center text-xs font-semibold text-amber-900 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-amber-50">
                    @forelse($clients as $client)
                        <tr class="hover:bg-amber-50/30 transition-colors duration-150">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-stone-900">
                                {{ $client->nom }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-stone-700">
                                {{ $client->telephone }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-stone-700">
                                {{ $client->email }}
                            </td>
                            <td class="px-6 py-4 text-sm text-stone-700 max-w-xs truncate">
                                {{ $client->adresse }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-stone-700">
                                {{ $client->ville }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-stone-700">
                                {{ $client->pays }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                <button wire:click="editClient({{ $client->id }})" 
                                        class="text-amber-600 hover:text-amber-800 mr-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </button>
                                <button wire:click="deleteClient({{ $client->id }})" 
                                        onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce client?')"
                                        class="text-red-600 hover:text-red-800">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-8 text-center text-stone-500 italic">
                                Aucun client trouvé
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="px-6 py-3 bg-stone-50 border-t border-amber-100">
            {{ $clients->links() }}
        </div>
    </div>

    <!-- Modal -->
    @if($showModal)
        <div class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white rounded-lg shadow-xl p-6 max-w-2xl w-full mx-4">
                <h3 class="text-xl font-bold text-stone-800 mb-4" style="font-family: 'Playfair Display', serif;">
                    {{ $editingClient ? 'Modifier le Client' : 'Nouveau Client' }}
                </h3>
                
                <form wire:submit.prevent="saveClient">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                        <div>
                            <label class="block text-sm font-medium text-amber-900 mb-2">Nom *</label>
                            <input wire:model="nom" type="text" required
                                   class="w-full px-3 py-2 border border-amber-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500">
                            @error('nom') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-amber-900 mb-2">Téléphone *</label>
                            <input wire:model="telephone" type="text" required
                                   class="w-full px-3 py-2 border border-amber-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500">
                            @error('telephone') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-amber-900 mb-2">Email *</label>
                            <input wire:model="email" type="email" required
                                   class="w-full px-3 py-2 border border-amber-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500">
                            @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-amber-900 mb-2">Ville *</label>
                            <input wire:model="ville" type="text" required
                                   class="w-full px-3 py-2 border border-amber-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500">
                            @error('ville') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-amber-900 mb-2">Pays *</label>
                            <input wire:model="pays" type="text" required
                                   class="w-full px-3 py-2 border border-amber-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500">
                            @error('pays') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-amber-900 mb-2">Adresse *</label>
                        <textarea wire:model="adresse" rows="3" required
                                  class="w-full px-3 py-2 border border-amber-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500"></textarea>
                        @error('adresse') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex justify-end space-x-3">
                        <button type="button" wire:click="$set('showModal', false)"
                                class="px-4 py-2 bg-stone-200 text-stone-800 rounded-lg hover:bg-stone-300 transition-colors duration-200">
                            Annuler
                        </button>
                        <button type="submit"
                                class="px-4 py-2 bg-amber-600 text-white rounded-lg hover:bg-amber-700 transition-colors duration-200">
                            Enregistrer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
