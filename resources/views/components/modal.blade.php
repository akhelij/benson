{{-- resources/views/components/modal.blade.php --}}
@props([
    'show' => false,
    'maxWidth' => '4xl',
    'title' => '',
])

@php
$maxWidthClass = [
    'sm' => 'sm:max-w-sm',
    'md' => 'sm:max-w-md', 
    'lg' => 'sm:max-w-lg',
    'xl' => 'sm:max-w-xl',
    '2xl' => 'sm:max-w-2xl',
    '3xl' => 'sm:max-w-3xl',
    '4xl' => 'sm:max-w-4xl',
    '5xl' => 'sm:max-w-5xl',
    '6xl' => 'sm:max-w-6xl',
    '7xl' => 'sm:max-w-7xl',
][$maxWidth ?? '4xl'];
@endphp

<div 
    x-data="{ show: @entangle($attributes->wire('model')) }"
    x-show="show"
    x-cloak
    class="fixed inset-0 z-50 overflow-y-auto"
    aria-labelledby="modal-title" 
    role="dialog" 
    aria-modal="true"
>
    {{-- Background overlay --}}
    <div 
        x-show="show"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
        @click="show = false"
    ></div>

    {{-- Modal panel --}}
    <div class="flex min-h-full items-center justify-center p-4">
        <div
            x-show="show"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            @click.stop
            class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all w-full {{ $maxWidthClass }}"
        >
            {{-- Modal Header --}}
            @if($title)
            <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4">
                <div class="flex items-center justify-between">
                    <h3 class="text-xl font-semibold text-white" id="modal-title">
                        {{ $title }}
                    </h3>
                    <button 
                        @click="show = false" 
                        class="text-white hover:text-gray-200 transition-colors"
                    >
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
            @endif

            {{-- Modal Body --}}
            <div class="px-6 py-4 max-h-[calc(100vh-200px)] overflow-y-auto">
                {{ $slot }}
            </div>

            {{-- Modal Footer (optional) --}}
            @if(isset($footer))
            <div class="bg-gray-50 px-6 py-4 flex justify-end space-x-3">
                {{ $footer }}
            </div>
            @endif
        </div>
    </div>
</div>