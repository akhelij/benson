<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component
{
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>

<div x-data="{ open: false }">
    <!-- Sidebar Navigation -->
    <nav class="bg-gradient-to-b from-amber-900 to-amber-800 shadow-lg border-r-4 border-amber-700 w-64 min-h-screen flex flex-col fixed md:relative z-50 transform md:transform-none transition-transform duration-300 ease-in-out" :class="{ '-translate-x-full md:translate-x-0': !open, 'translate-x-0': open }">
        <!-- Logo Section -->
        <div class="p-6 border-b border-amber-700">
            <a href="{{ route('dashboard') }}" wire:navigate class="flex items-center space-x-3">
                <x-application-logo class="block h-12 w-auto" />
            </a>
        </div>

        <!-- Navigation Links -->
        <div class="flex-1 py-6">
            <nav class="space-y-2 px-4">
                <x-sidebar-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" wire:navigate>
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v6H8V5z"></path>
                    </svg>
                    {{ __('Dashboard') }}
                </x-sidebar-nav-link>
                
                <x-sidebar-nav-link :href="route('orders')" :active="request()->routeIs('orders')" wire:navigate>
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    {{ __('Orders') }}
                </x-sidebar-nav-link>
                
                <x-sidebar-nav-link :href="route('items')" :active="request()->routeIs('items')" wire:navigate>
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                    {{ __('Formes & Articles') }}
                </x-sidebar-nav-link>
                
                <x-sidebar-nav-link :href="route('cuirs-supplements')" :active="request()->routeIs('cuirs-supplements')" wire:navigate>
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h4"></path>
                    </svg>
                    {{ __('Cuirs & Supplements') }}
                </x-sidebar-nav-link>
                
                <x-sidebar-nav-link :href="route('semelles-constructions')" :active="request()->routeIs('semelles-constructions')" wire:navigate>
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                    </svg>
                    {{ __('Semelles & Constructions') }}
                </x-sidebar-nav-link>
                
                <x-sidebar-nav-link :href="route('planning')" :active="request()->routeIs('planning')" wire:navigate>
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    {{ __('Planning') }}
                </x-sidebar-nav-link>
                
                <x-sidebar-nav-link :href="route('clients')" :active="request()->routeIs('clients')" wire:navigate>
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                    </svg>
                    {{ __('Clients') }}
                </x-sidebar-nav-link>
                
                <x-sidebar-nav-link :href="route('users')" :active="request()->routeIs('users')" wire:navigate>
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                    </svg>
                    {{ __('Users') }}
                </x-sidebar-nav-link>
            </nav>
        </div>

        <!-- User Profile Section -->
        <div class="border-t border-amber-700 p-4 space-y-2">
            <!-- User Info -->
            <div class="px-3 py-2 text-sm text-amber-100">
                <div class="font-medium" x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name" x-on:profile-updated.window="name = $event.detail.name"></div>
                <div class="text-xs text-amber-200">{{ auth()->user()->email }}</div>
            </div>
            
            <!-- Profile Link -->
            <x-sidebar-nav-link :href="route('profile')" :active="request()->routeIs('profile')" wire:navigate>
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                {{ __('Profile') }}
            </x-sidebar-nav-link>
            
            <!-- Logout Button -->
            <button wire:click="logout" class="w-full flex items-center px-4 py-3 text-sm font-medium leading-5 text-amber-100 hover:text-white hover:bg-amber-700 focus:outline-none focus:text-white focus:bg-amber-700 transition duration-150 ease-in-out">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                </svg>
                {{ __('Log Out') }}
            </button>
        </div>

        <!-- Mobile Menu Toggle -->
        <div class="md:hidden absolute top-4 right-4 z-50">
            <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-amber-100 hover:text-white hover:bg-amber-700 focus:outline-none focus:bg-amber-700 transition duration-150 ease-in-out">
                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </nav>

    <!-- Mobile Overlay -->
    <div x-show="open" @click="open = false" class="fixed inset-0 bg-black bg-opacity-50 z-40 md:hidden" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"></div>
</div>
