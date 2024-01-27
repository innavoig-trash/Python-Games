<x-app-layout>
    <x-slot name="header">{{ __('Tanaman Obat dan Nutrasetikal') }}</x-slot>
    <x-slot name="description">
        Temukan kekayaan alam melalui daftar lengkap tanaman obat dan nutrasetikal di
        {{ config('app.name', 'Laravel') }}. Setiap tanaman
        memiliki cerita uniknya sendiri dan potensi untuk meningkatkan kesehatan Anda. Mari temukan keajaiban alam yang
        tersembunyi dan pilih tanaman yang sesuai dengan kebutuhan Anda
    </x-slot>

    <div class="grid grid-cols-2 gap-6 lg:grid-cols-3 xl:grid-cols-4">
        @forelse ($plants as $plant)
            <a href="{{ route('plants.show', ['plant' => $plant->id]) }}"
                class="p-4 bg-white border rounded-xl border-zinc-200 dark:border-zinc-700 dark:bg-zinc-800">
                <img src="{{ asset($plant->photo) }}" alt="{{ $plant->name }}"
                    class="object-cover object-center w-full rounded-md aspect-square">
                <div class="px-2 py-4">
                    <h2 class="mb-2 text-lg font-semibold ">{{ $plant->name }}</h2>
                    <p class="text-sm text-zinc-600 dark:text-zinc-400 line-clamp-3">
                        {{ $plant->description }}
                    </p>
                </div>
            </a>
        @empty
            <div class="col-span-4">
                <div class="flex flex-col items-center justify-center h-96">
                    <h2 class="mb-2 text-lg font-semibold text-center">No plants found</h2>
                    <p class="text-sm text-center text-zinc-600 dark:text-zinc-400">No plants found. Please add some
                        plants.</p>
                </div>
            </div>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $plants->links() }}
    </div>
</x-app-layout>
