<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-stone-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-br from-stone-50 via-amber-50/30 to-stone-100">
            <div class="mb-8">
                <div class="text-center">
                    <h1 class="text-4xl font-serif text-amber-900 tracking-wide mb-2" style="font-family: 'Playfair Display', serif;">
                        👞 Gestion Chaussures
                    </h1>
                    <div class="h-1 w-32 bg-gradient-to-r from-amber-700 to-amber-500 rounded mx-auto"></div>
                    <p class="mt-3 text-stone-600 italic">Système de gestion artisanale</p>
                </div>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-8 py-6 bg-white shadow-lg overflow-hidden sm:rounded-lg border border-amber-100">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
