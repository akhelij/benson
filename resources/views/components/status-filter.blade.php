{{-- resources/views/components/status-filter.blade.php --}}
@props(['options' => [
    '' => 'Tous les statuts',
    'draft' => 'Brouillon',
    'confirmed' => 'Confirmée',
    'in_production' => 'En Production',
    'delivered' => 'Livrée',
    'cancelled' => 'Annulée',
]])

<select {{ $attributes->merge(['class' => 'px-3 py-2 border border-amber-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent text-sm']) }}>
    @foreach($options as $value => $label)
        <option value="{{ $value }}">{{ $label }}</option>
    @endforeach
</select>