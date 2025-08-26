<div class="min-h-screen bg-gradient-to-br from-stone-50 via-amber-50/30 to-stone-100 p-6">
    <!-- Page Header with Vintage Styling -->
    <div class="mb-8">
        <h1 class="text-4xl font-serif text-amber-900 tracking-wide" style="font-family: 'Playfair Display', serif;">
            📅 Planning des Livraisons
        </h1>
        <div class="mt-2 h-1 w-32 bg-gradient-to-r from-amber-700 to-amber-500 rounded"></div>
        <p class="mt-3 text-stone-600 italic">Organisation élégante de vos livraisons d'exception</p>
    </div>

    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <div class="flex space-x-2">
            <button wire:click="setViewMode('day')" 
                    class="px-4 py-2 text-sm rounded-lg {{ $viewMode === 'day' ? 'bg-amber-600 text-white' : 'bg-amber-100 text-amber-800 hover:bg-amber-200' }} transition-colors duration-200">
                Jour
            </button>
            <button wire:click="setViewMode('week')" 
                    class="px-4 py-2 text-sm rounded-lg {{ $viewMode === 'week' ? 'bg-amber-600 text-white' : 'bg-amber-100 text-amber-800 hover:bg-amber-200' }} transition-colors duration-200">
                Semaine
            </button>
            <button wire:click="setViewMode('month')" 
                    class="px-4 py-2 text-sm rounded-lg {{ $viewMode === 'month' ? 'bg-amber-600 text-white' : 'bg-amber-100 text-amber-800 hover:bg-amber-200' }} transition-colors duration-200">
                Mois
            </button>
        </div>
    </div>

    <!-- Navigation -->
    <div class="flex justify-between items-center mb-6">
        <div class="flex items-center space-x-4">
            <button wire:click="previousPeriod" class="p-2 rounded-lg bg-amber-100 hover:bg-amber-200 text-amber-800 transition-colors duration-200">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </button>
            <h2 class="text-xl font-semibold text-amber-900" style="font-family: 'Playfair Display', serif;">
                @if($viewMode === 'month')
                    {{ $currentMonth }}
                @elseif($viewMode === 'week')
                    Semaine du {{ \Carbon\Carbon::parse($selectedDate)->startOfWeek()->format('d/m/Y') }}
                @else
                    {{ \Carbon\Carbon::parse($selectedDate)->format('d/m/Y') }}
                @endif
            </h2>
            <button wire:click="nextPeriod" class="p-2 rounded-lg bg-amber-100 hover:bg-amber-200 text-amber-800 transition-colors duration-200">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </button>
        </div>
        <button wire:click="goToToday" class="px-4 py-2 bg-amber-600 text-white rounded-lg hover:bg-amber-700 transition-colors duration-200">
            Aujourd'hui
        </button>
    </div>

    <!-- Calendar View -->
    @if($viewMode === 'month')
        <div class="bg-white rounded-lg shadow-lg border border-amber-100 overflow-hidden">
            <!-- Calendar Header -->
            <div class="grid grid-cols-7 bg-stone-100 border-b border-amber-100">
                @foreach(['Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam', 'Dim'] as $day)
                    <div class="p-3 text-center text-sm font-semibold text-amber-900">{{ $day }}</div>
                @endforeach
            </div>
            
            <!-- Calendar Body -->
            <div class="grid grid-cols-7">
                @foreach($calendarDays as $day)
                    <div class="min-h-32 p-2 border-b border-r border-amber-100 {{ !$day['isCurrentMonth'] ? 'bg-amber-50/30' : '' }} {{ $day['isToday'] ? 'bg-amber-100' : '' }}">
                        <div class="flex justify-between items-start mb-2">
                            <span class="text-sm {{ !$day['isCurrentMonth'] ? 'text-stone-400' : ($day['isToday'] ? 'font-bold text-amber-800' : 'text-stone-900') }}">
                                {{ $day['day'] }}
                            </span>
                            @if($day['orders']->count() > 0)
                                <span class="bg-amber-200 text-amber-800 text-xs px-2 py-1 rounded-full">
                                    {{ $day['orders']->count() }}
                                </span>
                            @endif
                        </div>
                        
                        @foreach($day['orders']->take(3) as $order)
                            <div class="mb-1 p-1 bg-amber-100 text-amber-800 text-xs rounded truncate" title="{{ $order->firm }} - {{ $order->code }}">
                                {{ $order->code }}
                            </div>
                        @endforeach
                        
                        @if($day['orders']->count() > 3)
                            <div class="text-xs text-stone-500">+{{ $day['orders']->count() - 3 }} autres</div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <!-- List View for Week/Day -->
    @if($viewMode !== 'month')
        <div class="space-y-4">
            @forelse($ordersByDate as $date => $dayOrders)
                <div class="bg-white rounded-lg shadow-lg border border-amber-100 overflow-hidden">
                    <div class="px-6 py-4 bg-gradient-to-r from-amber-600 to-amber-700">
                        <h3 class="text-lg font-bold text-white" style="font-family: 'Playfair Display', serif;">
                            {{ \Carbon\Carbon::parse($date)->format('l d F Y') }}
                            <span class="ml-2 bg-amber-100 text-amber-800 text-sm px-2 py-1 rounded-full">
                                {{ $dayOrders->count() }} commande(s)
                            </span>
                        </h3>
                    </div>
                    <div class="divide-y divide-amber-50">
                        @foreach($dayOrders as $order)
                            <div class="p-6 hover:bg-amber-50/30 transition-colors duration-150">
                                <div class="flex justify-between items-start">
                                    <div class="flex-1">
                                        <div class="flex items-center space-x-4">
                                            <h4 class="text-lg font-medium text-stone-900">{{ $order->code }}</h4>
                                            <span class="bg-amber-200 text-amber-800 text-sm px-2 py-1 rounded-full">
                                                {{ $order->firm }}
                                            </span>
                                        </div>
                                        <p class="mt-1 text-sm text-stone-600">
                                            {{ $order->ville }} • {{ $order->telephone }}
                                        </p>
                                        <p class="mt-1 text-sm text-stone-600">
                                            Transporteur: {{ $order->transporteur ?: 'Non spécifié' }}
                                        </p>
                                        @if($order->notes)
                                            <p class="mt-2 text-sm text-stone-700 italic">{{ $order->notes }}</p>
                                        @endif
                                    </div>
                                    <div class="text-right">
                                        <div class="text-lg font-semibold text-stone-900">
                                            {{ number_format($order->total_price, 2) }} €
                                        </div>
                                        <div class="text-sm text-stone-600">
                                            {{ $order->total_quantity }} paires
                                        </div>
                                    </div>
                                </div>
                                
                                @if($order->orderLines->count() > 0)
                                    <div class="mt-4 border-t border-amber-100 pt-4">
                                        <h5 class="text-sm font-medium text-stone-900 mb-2">Détails des articles:</h5>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                                            @foreach($order->orderLines as $line)
                                                <div class="text-sm text-stone-600 bg-amber-50 p-2 rounded">
                                                    <strong>{{ $line->article }}</strong> ({{ $line->forme }})
                                                    <br>{{ $line->cuir }} • {{ $line->semelle }}
                                                    <br>Quantité: {{ $line->total_quantity }} • {{ number_format($line->prix, 2) }}€
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            @empty
                <div class="bg-white rounded-lg shadow-lg border border-amber-100 p-8 text-center">
                    <div class="text-amber-400 mb-4">
                        <svg class="mx-auto h-12 w-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a2 2 0 012-2h4a2 2 0 012 2v4m-6 4v10m6-10v10m-6-4h6"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-stone-900 mb-2">Aucune livraison prévue</h3>
                    <p class="text-stone-600">Aucune commande n'est programmée pour cette période.</p>
                </div>
            @endforelse
        </div>
    @endif

    <!-- Summary Statistics -->
    <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white rounded-lg shadow-lg border border-amber-100 p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-amber-600 rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                </div>
                <div class="ml-4">
                    <div class="text-2xl font-bold text-stone-900">{{ $orders->count() }}</div>
                    <div class="text-sm text-stone-600">Commandes à livrer</div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-lg border border-amber-100 p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-amber-700 rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                        </svg>
                    </div>
                </div>
                <div class="ml-4">
                    <div class="text-2xl font-bold text-stone-900">{{ number_format($orders->sum('total_price'), 0) }} €</div>
                    <div class="text-sm text-stone-600">Valeur totale</div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-lg border border-amber-100 p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-amber-800 rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                    </div>
                </div>
                <div class="ml-4">
                    <div class="text-2xl font-bold text-stone-900">{{ $orders->sum('total_quantity') }}</div>
                    <div class="text-sm text-stone-600">Paires à produire</div>
                </div>
            </div>
        </div>
    </div>
</div>
