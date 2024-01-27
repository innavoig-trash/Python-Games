@props(['disabled' => false])

<textarea {{ $disabled ? 'disabled' : '' }}
    {{ $attributes->merge([
        'class' =>
            'border-zinc-300 dark:border-zinc-700 bg-zinc-50 dark:bg-zinc-900 dark:text-zinc-300 focus:border-plant-500 dark:focus:border-plant-600 focus:ring-plant-500 dark:focus:ring-plant-600 rounded-md text-inter text-sm',
    ]) }}>{{ $slot }}</textarea>
