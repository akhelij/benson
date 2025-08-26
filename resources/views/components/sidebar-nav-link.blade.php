@props(['active'])

@php
$classes = ($active ?? false)
            ? 'flex items-center px-4 py-3 text-sm font-semibold leading-5 text-white bg-amber-700 border-r-4 border-amber-300 focus:outline-none transition duration-150 ease-in-out'
            : 'flex items-center px-4 py-3 text-sm font-medium leading-5 text-amber-100 hover:text-white hover:bg-amber-700 focus:outline-none focus:text-white focus:bg-amber-700 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
