<button
    {{ $attributes->merge([
        'type' => 'submit',
        'class' =>
            'flex items-center px-4 py-2 bg-plant-500 border border-transparent rounded-md font-semibold text-sm text-zinc-50 hover:bg-plant-600 active:bg-plant-600 focus:outline-none disabled:opacity-25',
    ]) }}>
    {{ $slot }}
</button>
