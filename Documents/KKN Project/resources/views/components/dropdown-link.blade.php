<a
    {{ $attributes->merge([
        'class' =>
            'block w-full px-4 py-2 text-start text-sm leading-5 text-zinc-700 dark:text-zinc-300 focus:outline-none rounded',
    ]) }}>
    {{ $slot }}
</a>
