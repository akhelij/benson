{{-- resources/views/components/search-input.blade.php --}}
@props(['placeholder' => 'Rechercher...'])

<div class="relative flex-1 max-w-md">
    <input {{ $attributes->merge(['type' => 'text', 'class' => 'w-full pl-10 pr-4 py-2 border border-amber-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent text-sm']) }}
           placeholder="{{ $placeholder }}">
    <svg class="absolute left-3 top-2.5 h-5 w-5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
    </svg>
    
    {{-- Loading indicator --}}
    <div wire:loading wire:target="{{ $attributes->wire('model')->value() }}" class="absolute right-3 top-2.5">
        <svg class="animate-spin h-5 w-5 text-amber-500" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
    </div>
</div>