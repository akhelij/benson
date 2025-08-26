@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 border-b-2 border-amber-300 text-sm font-semibold leading-5 text-amber-100 focus:outline-none focus:border-amber-200 transition duration-150 ease-in-out'
            : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-amber-100 hover:text-amber-200 hover:border-amber-600 focus:outline-none focus:text-amber-200 focus:border-amber-600 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
