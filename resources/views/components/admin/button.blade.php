@props([
    'variant' => 'primary', // primary, outline, active, default
    'icon' => null,
])

@php
    $classes = 'px-[11.25px] py-[7.5px] rounded-btn font-bold text-sm shadow-sm flex items-center gap-2 transition-colors border ';
    
    if ($variant === 'primary') {
        $classes .= 'bg-primary hover:bg-primary-dark text-white border-transparent';
    } elseif ($variant === 'outline') {
        $classes .= 'bg-white hover:bg-gray-50 text-gray-700 border-gray-200';
    } elseif ($variant === 'active') {
        $classes .= 'bg-gray-100 text-gray-800 border-gray-200';
    } else {
        $classes .= 'bg-white hover:bg-gray-50 text-gray-600 border-gray-200';
    }
@endphp

<button {{ $attributes->merge(['class' => $classes]) }}>
    @if($icon)
        @if($icon === '+')
            <span>+</span>
        @else
            <i class="pi {{ $icon }}"></i>
        @endif
    @endif
    {{ $slot }}
</button>
