<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Statistiques') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Filter Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <!-- Filter Type -->
                        <div>
                            <label for="filterType" class="block text-sm font-medium text-gray-700 mb-1">Type de filtre</label>
                            <select wire:model.live="filterType" id="filterType" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="article">Article</option>
                                <option value="forme">Forme</option>
                                <option value="client">Client</option>
                            </select>
                        </div>

                        <!-- Filter Value -->
                        <div>
                            <label for="filterValue" class="block text-sm font-medium text-gray-700 mb-1">Valeur</label>
                            <select wire:model="filterValue" id="filterValue" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                @foreach($filterOptions as $option)
                                    <option value="{{ $option['value'] }}">{{ $option['label'] }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Date From -->
                        <div>
                            <label for="dateFrom" class="block text-sm font-medium text-gray-700 mb-1">Du</label>
                            <input type="date" wire:model="dateFrom" id="dateFrom" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>

                        <!-- Date To -->
                        <div>
                            <label for="dateTo" class="block text-sm font-medium text-gray-700 mb-1">Au</label>
                            <input type="date" wire:model="dateTo" id="dateTo" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>
                    </div>

                    <!-- Search Button -->
                    <div class="mt-4">
                        <button wire:click="searchStatistics" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            Chercher
                        </button>
                    </div>
                </div>
            </div>

            <!-- Chart Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div id="areaChart" style="height: 400px;"></div>
                    
                    @if(empty($chartData))
                        <div class="text-center text-gray-500 py-8">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                            <p class="mt-2">Aucune donnée disponible pour les critères sélectionnés</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Summary Cards -->
            @if(!empty($chartData))
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
                <!-- Total Revenue Card -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-indigo-500 rounded-md p-3">
                                <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Revenu Total</dt>
                                    <dd class="text-lg font-semibold text-gray-900">
                                        {{ number_format(collect($chartData)->sum('y'), 2, ',', ' ') }} €
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Pairs Card -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-green-500 rounded-md p-3">
                                <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Nombre de Paires</dt>
                                    <dd class="text-lg font-semibold text-gray-900">
                                        {{ number_format(collect($chartData)->sum('z'), 0, ',', ' ') }}
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Average Price Card -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-yellow-500 rounded-md p-3">
                                <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Prix Moyen</dt>
                                    <dd class="text-lg font-semibold text-gray-900">
                                        @php
                                            $totalRevenue = collect($chartData)->sum('y');
                                            $totalPairs = collect($chartData)->sum('z');
                                            $avgPrice = $totalPairs > 0 ? $totalRevenue / $totalPairs : 0;
                                        @endphp
                                        {{ number_format($avgPrice, 2, ',', ' ') }} €
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>

    <!-- Morris.js Scripts -->
    @push('styles')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    @endpush

    @push('scripts')
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    
    <script>
        document.addEventListener('livewire:initialized', () => {
            let chart = null;

            function drawChart(data) {
                $('#areaChart').empty();
                
                if (data && data.length > 0) {
                    chart = Morris.Area({
                        element: 'areaChart',
                        behaveLikeLine: true,
                        data: data,
                        xkey: 'x',
                        ykeys: ['y', 'z'],
                        labels: ['Revenu (€)', 'Nombre de paires'],
                        lineColors: ["#6366f1", "#10b981"],
                        fillOpacity: 0.6,
                        hideHover: 'auto',
                        resize: true,
                        gridTextFamily: 'system-ui, -apple-system, sans-serif',
                        gridTextSize: 12,
                        xLabelFormat: function(x) {
                            return x.src.x;
                        }
                    });
                }
            }

            // Initial chart draw
            drawChart(@json($chartData));

            // Listen for Livewire updates
            Livewire.on('chartDataUpdated', (data) => {
                drawChart(data[0]);
            });

            // Redraw chart when data changes
            Livewire.hook('morph.updated', ({ el, component }) => {
                if (component.fingerprint.name === 'dashboard') {
                    drawChart(component.data.chartData);
                }
            });
        });
    </script>
    @endpush
</div>
