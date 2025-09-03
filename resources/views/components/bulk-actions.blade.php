{{-- resources/views/components/bulk-actions.blade.php --}}
@props(['count' => 0])

<div class="flex items-center gap-2">
    <span class="text-sm text-stone-600">{{ $count }} sélectionné(s)</span>
    
    <button {{ $attributes->wire('export') }}
            class="px-3 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition-colors flex items-center gap-2 text-sm">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
        </svg>
        Exporter
    </button>
    
    <button {{ $attributes->wire('delete') }}
            wire:confirm="Êtes-vous sûr de vouloir supprimer {{ $count }} commande(s)?"
            class="px-3 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors flex items-center gap-2 text-sm">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
        </svg>
        Supprimer
    </button>
</div>