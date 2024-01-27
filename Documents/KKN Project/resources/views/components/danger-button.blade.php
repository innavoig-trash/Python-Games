<button
    {{ $attributes->merge([
        'type' => 'submit',
        'class' =>
            'flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-sm text-white hover:bg-red-500 active:bg-red-700 focus:outline-none',
    ]) }}>
    {{ $slot }}
</button>
