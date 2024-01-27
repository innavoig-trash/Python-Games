<x-app-layout>
    <div class="grid grid-cols-1 gap-8 lg:grid-cols-2 xl:grid-cols-2">
        <div class="p-4 bg-white border dark:bg-zinc-800 rounded-xl border-zinc-200 dark:border-zinc-700 aspect-square">
            <img class="object-cover w-full h-full rounded-lg" src="{{ $plant->photo }}" alt="{{ $plant->name }}">
        </div>

        <div class="p-2 space-y-6">
            <div>
                <h1 class="text-5xl">{{ $plant->name }}</h1>
                <p class="text-sm text-zinc-600 dark:text-zinc-400">{{ $plant->description }}</p>
            </div>

            <div>
                <span class="font-semibold">Manfaat</span>
                <p class="text-sm text-zinc-600 dark:text-zinc-400">{{ $plant->benefit }}</p>
            </div>

            <div>
                <span class="font-semibold">Umur Simpan</span>
                <p class="text-sm text-zinc-600 dark:text-zinc-400">
                    {{ $plant->expiration }} Hari
                </p>
            </div>

            <div>
                <span class="font-semibold">QR Code</span>
                <div class="flex py-2">
                    <div class="p-3 bg-white border rounded-lg border-zinc-200">
                        {!! QrCode::size('150')->generate(route('plants.show', $plant)) !!}
                    </div>
                </div>
            </div>

            <div class="flex items-center mt-8 space-x-4">
                @auth
                    <a href="{{ route('dashboard.plants.edit', $plant) }}" class="flex">
                        <x-primary-button>
                            <i class="w-4 h-4 mr-2" data-lucide="settings-2"></i>
                            {{ __('Edit') }}
                        </x-primary-button>
                    </a>
                @endauth
                <a href="{{ route('plants.download', $plant) }}" class="flex">
                    <x-secondary-button>
                        <i class="w-4 h-4 mr-2" data-lucide="download"></i>
                        {{ __('Download') }}
                    </x-secondary-button>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
