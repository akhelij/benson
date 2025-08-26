<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-stone-50 via-amber-50/30 to-stone-100 p-6">
        <!-- Page Header with Vintage Styling -->
        <div class="mb-8">
            <h1 class="text-4xl font-serif text-amber-900 tracking-wide" style="font-family: 'Playfair Display', serif;">
                👤 Profil Membre
            </h1>
            <div class="mt-2 h-1 w-32 bg-gradient-to-r from-amber-700 to-amber-500 rounded"></div>
            <p class="mt-3 text-stone-600 italic">Gestion élégante de votre profil personnel</p>
        </div>

        <div class="max-w-4xl mx-auto space-y-6">
            <div class="bg-white rounded-lg shadow-lg border border-amber-100 overflow-hidden">
                <div class="bg-gradient-to-r from-amber-600 to-amber-700 px-6 py-4">
                    <h2 class="text-xl font-bold text-white" style="font-family: 'Playfair Display', serif;">Informations Personnelles</h2>
                </div>
                <div class="p-6">
                    <livewire:profile.update-profile-information-form />
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-lg border border-amber-100 overflow-hidden">
                <div class="bg-gradient-to-r from-amber-600 to-amber-700 px-6 py-4">
                    <h2 class="text-xl font-bold text-white" style="font-family: 'Playfair Display', serif;">Paramètres de Sécurité</h2>
                </div>
                <div class="p-6">
                    <livewire:profile.update-password-form />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
