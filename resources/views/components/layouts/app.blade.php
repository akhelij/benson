<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ $title ?? 'Gestion des Commandes de Chaussures' }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
    </head>
    <body class="bg-gray-100 font-sans antialiased">
        <!-- Navigation -->
        <nav class="bg-white shadow-lg">
            <div class="max-w-7xl mx-auto px-4">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <h1 class="text-xl font-bold text-gray-900">Gestion Chaussures</h1>
                        </div>
                        <div class="hidden md:ml-6 md:flex md:space-x-8">
                            <a href="{{ route('orders') }}" 
                               class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium {{ request()->routeIs('orders') ? 'border-blue-500 text-gray-900' : '' }}">
                                Commandes
                            </a>
                            <a href="{{ route('clients') }}" 
                               class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium {{ request()->routeIs('clients') ? 'border-blue-500 text-gray-900' : '' }}">
                                Clients
                            </a>
                            <a href="{{ route('items') }}" 
                               class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium {{ request()->routeIs('items') ? 'border-blue-500 text-gray-900' : '' }}">
                                Articles
                            </a>
                            <a href="{{ route('planning') }}" 
                               class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium {{ request()->routeIs('planning') ? 'border-blue-500 text-gray-900' : '' }}">
                                Planning
                            </a>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <span class="text-sm text-gray-500">Utilisateur connecté</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Mobile menu -->
            <div class="md:hidden">
                <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                    <a href="{{ route('orders') }}" class="text-gray-500 hover:text-gray-700 block px-3 py-2 text-base font-medium">Commandes</a>
                    <a href="{{ route('clients') }}" class="text-gray-500 hover:text-gray-700 block px-3 py-2 text-base font-medium">Clients</a>
                    <a href="{{ route('items') }}" class="text-gray-500 hover:text-gray-700 block px-3 py-2 text-base font-medium">Articles</a>
                    <a href="{{ route('planning') }}" class="text-gray-500 hover:text-gray-700 block px-3 py-2 text-base font-medium">Planning</a>
                    <a href="{{ route('statistics') }}" class="text-gray-500 hover:text-gray-700 block px-3 py-2 text-base font-medium">Statistiques</a>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="max-w-7xl mx-auto py-6">
            {{ $slot }}
        </main>

        @livewireScripts
    </body>
</html>
