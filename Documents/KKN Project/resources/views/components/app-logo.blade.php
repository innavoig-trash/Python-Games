@props([
    'variant' => 'color',
])

@php
    switch ($variant) {
        case 'white':
            $logoStyle = 'filter invert saturate-100 grayscale-0 brightness-0 contrast-100';
            $textColor = 'text-white';
            break;
        default:
            $logoStyle = 'dark:filter dark:invert dark:saturate-100 dark:grayscale-0 dark:brightness-0 dark:contrast-100';
            $textColor = '';
            break;
    }
@endphp

<a href="{{ route('home') }}" {{ $attributes->merge(['class' => 'flex items-center space-x-1 select-none']) }}>
    <img src="{{ asset('images/logo-color.svg') }}" alt="logo" class="w-6 h-6 -mt-1 {{ $logoStyle }}" />
    <span class="font-sans text-xl font-semibold {{ $textColor }}">
        {{ config('app.name', 'Laravel') }}
    </span>
</a>
