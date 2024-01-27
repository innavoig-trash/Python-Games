<button
    {{ $attributes->merge([
        'type' => 'button',
        'class' =>
            'flex items-center px-4 py-2 bg-white dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 rounded-md font-semibold text-sm text-zinc-900 dark:text-zinc-100 hover:bg-zinc-100 dark:hover:bg-zinc-700 focus:outline-none disabled:opacity-25',
    ]) }}>
    {{ $slot }}
</button>
