@props(['active'])

@php
    $classes = $active ?? false ? 'block w-full ps-3 pe-4 py-2 border-l-4 border-plant-400 dark:border-plant-600 text-start text-base font-medium text-plant-700 dark:text-plant-300 bg-plant-50 dark:bg-plant-900/50 focus:outline-none focus:text-plant-800 dark:focus:text-plant-200 focus:bg-plant-100 dark:focus:bg-plant-900 focus:border-plant-700 dark:focus:border-plant-300 transition duration-150 ease-in-out' : 'block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-zinc-600 dark:text-zinc-400 hover:text-zinc-800 dark:hover:text-zinc-200 hover:bg-zinc-50 dark:hover:bg-zinc-700 hover:border-zinc-300 dark:hover:border-zinc-600 focus:outline-none focus:text-zinc-800 dark:focus:text-zinc-200 focus:bg-zinc-50 dark:focus:bg-zinc-700 focus:border-zinc-300 dark:focus:border-zinc-600 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
