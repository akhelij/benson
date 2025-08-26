<div class="min-h-screen bg-gradient-to-br from-stone-50 via-amber-50/30 to-stone-100 p-6">
    <!-- Page Header with Vintage Styling -->
    <div class="mb-8">
        <h1 class="text-4xl font-serif text-amber-900 tracking-wide" style="font-family: 'Playfair Display', serif;">
            👥 Gestion des Utilisateurs
        </h1>
        <div class="mt-2 h-1 w-32 bg-gradient-to-r from-amber-700 to-amber-500 rounded"></div>
        <p class="mt-3 text-stone-600 italic">Registre distingué des membres de votre atelier</p>
    </div>

    <!-- Success/Error Messages -->
    @if (session()->has('success'))
        <div class="mb-4 bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-lg shadow-sm">
            {{ session('success') }}
        </div>
    @endif
    @if (session()->has('error'))
        <div class="mb-4 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg shadow-sm">
            {{ session('error') }}
        </div>
    @endif

    <!-- Main Card -->
    <div class="bg-white rounded-lg shadow-lg border border-amber-100 overflow-hidden">
        <!-- Header Section -->
        <div class="bg-gradient-to-r from-amber-600 to-amber-700 px-6 py-4">
            <div class="flex justify-between items-center">
                <h2 class="text-xl font-bold text-white" style="font-family: 'Playfair Display', serif;">Utilisateurs</h2>
                <button wire:click="openModal" 
                        class="bg-amber-600 text-white px-4 py-2 rounded-lg hover:bg-amber-700 transition-colors duration-200 flex items-center text-sm">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Ajouter
                </button>
            </div>
        </div>

        <!-- Search Bar -->
        <div class="px-6 py-3 bg-amber-50 border-b border-amber-100 flex justify-between items-center">
            <input type="text" 
                   wire:model.live="search" 
                   placeholder="Rechercher par nom ou email..."
                   class="flex-1 mr-4 px-3 py-2 border border-amber-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent text-sm">
        </div>

        <!-- Users Table -->
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-stone-100 border-b border-amber-100">
                    <tr>
                        <th wire:click="sortBy('name')" class="px-6 py-3 text-left text-xs font-semibold text-amber-900 uppercase tracking-wider cursor-pointer hover:bg-amber-200 transition">
                            <div class="flex items-center">
                                Nom
                                @if($sortField === 'name')
                                    @if($sortDirection === 'asc')
                                        <svg class="w-4 h-4 ml-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M7 10l5-5 5 5H7z"/>
                                        </svg>
                                    @else
                                        <svg class="w-4 h-4 ml-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M7 10l5 5 5-5H7z"/>
                                        </svg>
                                    @endif
                                @endif
                            </div>
                        </th>
                        <th wire:click="sortBy('email')" class="px-6 py-3 text-left text-xs font-semibold text-amber-900 uppercase tracking-wider cursor-pointer hover:bg-amber-200 transition">
                            <div class="flex items-center">
                                Email
                                @if($sortField === 'email')
                                    @if($sortDirection === 'asc')
                                        <svg class="w-4 h-4 ml-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M7 10l5-5 5 5H7z"/>
                                        </svg>
                                    @else
                                        <svg class="w-4 h-4 ml-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M7 10l5 5 5-5H7z"/>
                                        </svg>
                                    @endif
                                @endif
                            </div>
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-amber-900 uppercase tracking-wider">
                            Inscrit depuis
                        </th>
                        <th class="px-6 py-3 text-center text-xs font-semibold text-amber-900 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-amber-50">
                    @forelse($users as $user)
                        <tr class="hover:bg-amber-50/30 transition-colors duration-150">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <div class="w-10 h-10 bg-gradient-to-br from-amber-100 to-amber-200 rounded-lg flex items-center justify-center shadow-sm">
                                            <span class="text-amber-800 font-bold text-xs">{{ strtoupper(substr($user->name, 0, 2)) }}</span>
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-stone-900">{{ $user->name }}</div>
                                        @if($user->id === auth()->id())
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-amber-200 text-amber-800">
                                                Utilisateur actuel
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-stone-900">{{ $user->email }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-stone-600">
                                {{ $user->created_at->format('d M Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                <button wire:click="editUser({{ $user->id }})" 
                                        class="text-amber-600 hover:text-amber-800 mr-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </button>
                                @if($user->id !== auth()->id())
                                    <button wire:click="deleteUser({{ $user->id }})" 
                                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce membre?')"
                                            class="text-red-600 hover:text-red-800">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-8 text-center text-stone-500 italic">
                                Aucun membre trouvé
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="px-6 py-3 bg-stone-50 border-t border-amber-100">
            {{ $users->links() }}
        </div>
    </div>

    <!-- Modal -->
    @if($showModal)
        <div class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white rounded-lg shadow-xl p-6 max-w-md w-full mx-4">
                <h3 class="text-xl font-bold text-stone-800 mb-4" style="font-family: 'Playfair Display', serif;">
                    {{ $editingUser ? 'Modifier le Membre' : 'Nouveau Membre' }}
                </h3>
                
                <form wire:submit.prevent="saveUser">
                    <!-- Name -->
                    <div class="mb-4">
                        <label class="block text-amber-900 text-sm font-bold mb-2" for="name">
                            Nom complet
                        </label>
                        <input wire:model="name" 
                               type="text" 
                               id="name"
                               class="w-full px-3 py-2 border border-amber-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500 @error('name') border-red-500 @enderror">
                        @error('name')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="mb-4">
                        <label class="block text-amber-900 text-sm font-bold mb-2" for="email">
                            Adresse email
                        </label>
                        <input wire:model="email" 
                               type="email" 
                               id="email"
                               class="w-full px-3 py-2 border border-amber-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500 @error('email') border-red-500 @enderror">
                        @error('email')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-4">
                        <label class="block text-amber-900 text-sm font-bold mb-2" for="password">
                            Mot de passe {{ $editingUser ? '(laisser vide pour conserver)' : '' }}
                        </label>
                        <input wire:model="password" 
                               type="password" 
                               id="password"
                               class="w-full px-3 py-2 border border-amber-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500 @error('password') border-red-500 @enderror">
                        @error('password')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password Confirmation -->
                    <div class="mb-6">
                        <label class="block text-amber-900 text-sm font-bold mb-2" for="password_confirmation">
                            Confirmer le mot de passe
                        </label>
                        <input wire:model="password_confirmation" 
                               type="password" 
                               id="password_confirmation"
                               class="w-full px-3 py-2 border border-amber-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500">
                    </div>

                    <div class="flex justify-end space-x-3">
                        <button type="button" 
                                wire:click="$set('showModal', false)"
                                class="px-4 py-2 bg-stone-200 text-stone-800 rounded-lg hover:bg-stone-300 transition-colors duration-200">
                            Annuler
                        </button>
                        <button type="submit" 
                                class="px-4 py-2 bg-amber-600 text-white rounded-lg hover:bg-amber-700 transition-colors duration-200">
                            {{ $editingUser ? 'Mettre à jour' : 'Créer' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
