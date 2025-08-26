@props(['class' => ''])

<img src="{{ asset('logo.png') }}" {{ $attributes->merge(['class' => $class]) }} alt="Logo" />
