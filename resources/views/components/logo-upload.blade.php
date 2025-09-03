{{-- resources/views/components/logo-upload.blade.php --}}
@props(['field', 'label' => 'Logo'])

<div>
    <label class="block text-sm font-medium text-gray-700 mb-1">{{ $label }}</label>
    
    {{-- Current Logo Preview if exists and is string (existing file) --}}
    @if($this->$field && is_string($this->$field))
        <div class="mb-3 p-3 border border-gray-200 rounded-lg bg-gray-50">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <img src="{{ asset('storage/' . $this->$field) }}" alt="{{ $label }}" 
                         class="w-16 h-16 object-contain border rounded">
                    <div>
                        <p class="text-sm font-medium text-gray-700">{{ $label }} actuel</p>
                        <p class="text-xs text-gray-500">{{ basename($this->$field) }}</p>
                    </div>
                </div>
                <button type="button" wire:click="remove{{ ucfirst($field) }}" 
                    class="px-3 py-1 text-sm bg-red-100 text-red-700 rounded hover:bg-red-200 transition-colors">
                    Supprimer
                </button>
            </div>
        </div>
    @endif
    
    {{-- New Logo Upload Preview if file was selected --}}
    @if($this->$field && !is_string($this->$field))
        <div class="mb-3 p-3 border border-green-200 rounded-lg bg-green-50">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-16 h-16 bg-green-100 border border-green-300 rounded flex items-center justify-center">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-green-700">Nouveau {{ strtolower($label) }} sélectionné</p>
                        <p class="text-xs text-green-600">{{ $this->$field->getClientOriginalName() }}</p>
                        <p class="text-xs text-green-600">Sera sauvegardé lors de l'enregistrement</p>
                    </div>
                </div>
                <button type="button" wire:click="remove{{ ucfirst($field) }}" 
                    class="px-3 py-1 text-sm bg-red-100 text-red-700 rounded hover:bg-red-200 transition-colors">
                    Annuler
                </button>
            </div>
        </div>
    @endif
    
    {{-- File Input --}}
    <input wire:model="{{ $field }}" type="file" accept="image/*"
        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
    
    {{-- Loading state --}}
    <div wire:loading wire:target="{{ $field }}" class="mt-2">
        <div class="flex items-center text-sm text-gray-500">
            <svg class="animate-spin h-4 w-4 mr-2 text-blue-500" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            Téléchargement en cours...
        </div>
    </div>
    
    {{-- Error display --}}
    @error($field)
        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
    @enderror
</div>