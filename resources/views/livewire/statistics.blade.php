<div class="min-h-screen bg-gradient-to-br from-stone-50 via-amber-50/30 to-stone-100 p-6">
    <!-- Page Header with Vintage Styling -->
    <div class="mb-8">
        <h1 class="text-4xl font-serif text-amber-900 tracking-wide" style="font-family: 'Playfair Display', serif;">
            📊 Statistiques de production
        </h1>
        <div class="mt-2 h-1 w-32 bg-gradient-to-r from-amber-700 to-amber-500 rounded"></div>
        <p class="mt-3 text-stone-600 italic">Tableau de bord des performances de votre atelier</p>
    </div>

    <!-- Period Selection -->
    <div class="mb-6 flex justify-between items-center">
        <div class="text-stone-700 font-medium">
            Période: {{ $dateRange }}
        </div>
        <div class="flex space-x-2">
            <button wire:click="setPeriod('week')" 
                    class="px-4 py-2 text-sm rounded-lg transition-colors duration-200 {{ $selectedPeriod === 'week' ? 'bg-amber-600 text-white shadow-md' : 'bg-white text-amber-700 border border-amber-200 hover:bg-amber-50' }}">
                Semaine
            </button>
            <button wire:click="setPeriod('month')" 
                    class="px-4 py-2 text-sm rounded-lg transition-colors duration-200 {{ $selectedPeriod === 'month' ? 'bg-amber-600 text-white shadow-md' : 'bg-white text-amber-700 border border-amber-200 hover:bg-amber-50' }}">
                Mois
            </button>
            <button wire:click="setPeriod('quarter')" 
                    class="px-4 py-2 text-sm rounded-lg transition-colors duration-200 {{ $selectedPeriod === 'quarter' ? 'bg-amber-600 text-white shadow-md' : 'bg-white text-amber-700 border border-amber-200 hover:bg-amber-50' }}">
                Trimestre
            </button>
            <button wire:click="setPeriod('year')" 
                    class="px-4 py-2 text-sm rounded-lg transition-colors duration-200 {{ $selectedPeriod === 'year' ? 'bg-amber-600 text-white shadow-md' : 'bg-white text-amber-700 border border-amber-200 hover:bg-amber-50' }}">
                Année
            </button>
        </div>
    </div>

    <!-- Key Metrics -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-xl border border-amber-200 overflow-hidden">
            <div class="bg-gradient-to-r from-amber-600 to-amber-700 px-6 py-4">
                <div class="flex items-center">
                    <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <div class="text-2xl font-bold text-white">{{ $totalOrders }}</div>
                        <div class="text-sm text-amber-100">Commandes</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-xl border border-amber-200 overflow-hidden">
            <div class="bg-gradient-to-r from-emerald-600 to-emerald-700 px-6 py-4">
                <div class="flex items-center">
                    <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <div class="text-2xl font-bold text-white">{{ number_format($totalRevenue, 0) }} €</div>
                        <div class="text-sm text-emerald-100">Chiffre d'affaires</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-xl border border-amber-200 overflow-hidden">
            <div class="bg-gradient-to-r from-purple-600 to-purple-700 px-6 py-4">
                <div class="flex items-center">
                    <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <div class="text-2xl font-bold text-white">{{ $totalQuantity }}</div>
                        <div class="text-sm text-purple-100">Paires vendues</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-xl border border-amber-200 overflow-hidden">
            <div class="bg-gradient-to-r from-orange-600 to-orange-700 px-6 py-4">
                <div class="flex items-center">
                    <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <div class="text-2xl font-bold text-white">{{ number_format($averageOrderValue, 0) }} €</div>
                        <div class="text-sm text-orange-100">Panier moyen</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Status Overview -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-xl border border-amber-200 overflow-hidden">
            <div class="bg-gradient-to-r from-amber-600 to-amber-700 px-6 py-4">
                <h3 class="text-xl font-serif text-white" style="font-family: 'Playfair Display', serif;">État des commandes</h3>
            </div>
            <div class="p-6 space-y-4">
                <div class="flex justify-between items-center p-3 bg-amber-50/50 rounded-lg">
                    <span class="text-stone-700 font-medium">Commandes en attente</span>
                    <span class="bg-yellow-200 text-yellow-800 text-sm px-3 py-1 rounded-full font-semibold">{{ $pendingOrders }}</span>
                </div>
                <div class="flex justify-between items-center p-3 bg-amber-50/50 rounded-lg">
                    <span class="text-stone-700 font-medium">Commandes en retard</span>
                    <span class="bg-red-200 text-red-800 text-sm px-3 py-1 rounded-full font-semibold">{{ $overdueOrders }}</span>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-xl border border-amber-200 overflow-hidden">
            <div class="bg-gradient-to-r from-amber-600 to-amber-700 px-6 py-4">
                <h3 class="text-xl font-serif text-white" style="font-family: 'Playfair Display', serif;">Évolution mensuelle</h3>
            </div>
            <div class="p-6 space-y-3">
                @foreach($monthlyRevenue->take(3) as $month)
                    <div class="flex justify-between items-center p-3 bg-amber-50/30 rounded-lg hover:bg-amber-50/50 transition-colors duration-150">
                        <span class="text-stone-700 font-medium">{{ $month->month_name }}</span>
                        <div class="text-right">
                            <div class="text-sm font-bold text-amber-900">{{ number_format($month->revenue, 0) }} €</div>
                            <div class="text-xs text-stone-600">{{ $month->orders }} commandes</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Top Clients and Articles -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-xl border border-amber-200 overflow-hidden">
            <div class="bg-gradient-to-r from-amber-600 to-amber-700 px-6 py-4">
                <h3 class="text-xl font-serif text-white" style="font-family: 'Playfair Display', serif;">Top Clients</h3>
            </div>
            <div class="divide-y divide-amber-50">
                @forelse($topClients as $client)
                    <div class="p-6 hover:bg-amber-50/30 transition-colors duration-150">
                        <div class="flex justify-between items-center">
                            <div>
                                <h4 class="text-sm font-bold text-amber-900">{{ $client->firm }}</h4>
                                <p class="text-sm text-stone-600">{{ $client->order_count }} commande(s)</p>
                            </div>
                            <div class="text-right">
                                <div class="text-sm font-bold text-stone-900">{{ number_format($client->total_revenue, 2) }} €</div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="p-6 text-center text-stone-500 italic">
                        Aucune donnée disponible
                    </div>
                @endforelse
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-xl border border-amber-200 overflow-hidden">
            <div class="bg-gradient-to-r from-amber-600 to-amber-700 px-6 py-4">
                <h3 class="text-xl font-serif text-white" style="font-family: 'Playfair Display', serif;">Articles Populaires</h3>
            </div>
            <div class="divide-y divide-amber-50">
                @forelse($popularArticles as $article)
                    <div class="p-6 hover:bg-amber-50/30 transition-colors duration-150">
                        <div class="flex justify-between items-center">
                            <div>
                                <h4 class="text-sm font-bold text-amber-900">{{ $article->article }}</h4>
                            </div>
                            <div class="text-right">
                                <div class="text-sm font-bold text-stone-900">{{ $article->total_quantity }} paires</div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="p-6 text-center text-stone-500 italic">
                        Aucune donnée disponible
                    </div>
                @endforelse
            </div>
        </div>
    </div>

</div>
</div>
