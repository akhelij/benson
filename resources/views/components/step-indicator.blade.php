{{-- resources/views/components/step-indicator.blade.php --}}
@props(['currentStep' => 1, 'steps' => []])

<div class="px-6 py-4 border-b border-gray-200">
    <div class="flex items-center justify-between">
        <div class="flex items-center">
            @foreach($steps as $index => $step)
                <div class="flex items-center">
                    <span class="flex items-center justify-center w-8 h-8 
                        {{ $currentStep === ($index + 1) ? 'bg-blue-600' : ($currentStep > ($index + 1) ? 'bg-green-600' : 'bg-gray-300') }} 
                        text-white rounded-full text-sm font-semibold">
                        @if($currentStep > ($index + 1))
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        @else
                            {{ $index + 1 }}
                        @endif
                    </span>
                    <span class="ml-2 text-sm {{ $currentStep === ($index + 1) ? 'font-medium text-gray-900' : 'text-gray-600' }}">
                        {{ $step }}
                    </span>
                </div>
                @if(!$loop->last)
                    <svg class="w-5 h-5 mx-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                @endif
            @endforeach
        </div>
    </div>
</div>