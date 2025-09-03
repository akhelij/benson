{{-- resources/views/components/kpi-card.blade.php --}}
@props(['title', 'value', 'icon', 'color' => 'gray'])

@php
$bgColorClasses = [
    'amber' => 'bg-amber-100',
    'emerald' => 'bg-emerald-100',
    'orange' => 'bg-orange-100',
    'purple' => 'bg-purple-100',
    'red' => 'bg-red-100',
    'teal' => 'bg-teal-100',
    'gray' => 'bg-gray-100',
][$color];

$textColorClasses = [
    'amber' => 'text-amber-700',
    'emerald' => 'text-emerald-700',
    'orange' => 'text-orange-700',
    'purple' => 'text-purple-700',
    'red' => 'text-red-700',
    'teal' => 'text-teal-700',
    'gray' => 'text-gray-700',
][$color];

$iconSvg = [
    'clipboard-list' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>',
    'euro' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>',
    'clock' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>',
    'calendar' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>',
    'exclamation' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>',
    'check-circle' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>',
][$icon] ?? '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>';
@endphp

<div class="bg-white rounded-lg shadow-lg border border-amber-100 p-4">
    <div class="flex items-center justify-between">
        <div>
            <p class="text-sm font-medium text-stone-600">{{ $title }}</p>
            <p class="text-2xl font-bold {{ $textColorClasses }} mt-1">{{ $value }}</p>
        </div>
        <div class="{{ $bgColorClasses }} p-3 rounded-full">
            <svg class="w-6 h-6 {{ $textColorClasses }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                {!! $iconSvg !!}
            </svg>
        </div>
    </div>
</div>