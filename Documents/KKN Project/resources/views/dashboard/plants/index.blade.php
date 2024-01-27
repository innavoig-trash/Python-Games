<x-dashboard-layout>
    <x-slot name="header">{{ __('Daftar Tanaman Obat dan Nutrasetikal') }}</x-slot>
    <x-slot name="description">
        Berikut adalah daftar lengkap tanaman obat dan nutrasetikal di {{ config('app.name', 'Laravel') }}. Kelola
        tanaman dengan mudah dan dapatkan informasi terkait tanaman secara lengkap.
    </x-slot>

    <div class="mb-8 overflow-hidden overflow-x-auto border rounded pxw-full border-zinc-300 dark:border-zinc-700">
        <table class="w-full text-sm table-auto">
            <thead>
                <tr class="bg-zinc-100 dark:bg-zinc-700">
                    <th class="px-4 py-2 font-semibold text-start">Id</th>
                    <th class="px-4 py-2 font-semibold text-start">Nama</th>
                    <th class="hidden px-4 py-2 font-semibold text-start xl:table-cell">Deskripsi</th>
                    <th class="px-4 py-2 font-semibold text-start">Dibuat</th>
                    <th class="px-4 py-2 font-semibold text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($plants as $plant)
                    <tr class="border-zinc-200 dark:border-zinc-700 {{ $loop->last ? 'border-none' : 'border-b' }}">
                        <td class="w-10 px-4 py-2">{{ $plant->id }}</td>
                        <td class="px-4 py-2 w-52">
                            <a href="{{ route('dashboard.plants.show', ['plant' => $plant->id]) }}"
                                class="hover:text-plant-600">
                                {{ $plant->name }}
                            </a>
                        </td>
                        <td class="hidden px-4 py-2 xl:table-cell">
                            <p class="line-clamp-2 text-zinc-600 dark:text-zinc-400">
                                {{ $plant->description }}
                            </p>
                        </td>
                        <td class="w-40 px-4 py-2">{{ $plant->created_at->diffForHumans() }}</td>
                        <td class="w-40 px-4 py-2">
                            <div class="flex items-center justify-center space-x-2">
                                <a href="{{ route('dashboard.plants.edit', ['plant' => $plant->id]) }}"
                                    class="px-4 py-2 text-sm rounded-md hover:bg-plant-500 dark:hover:bg-zinc-100 text-zinc-600 dark:text-zinc-400 hover:text-zinc-50 dark:hover:text-zinc-900">
                                    {{ __('Edit') }}
                                </a>
                                <form method="POST"
                                    action="{{ route('dashboard.plants.destroy', ['plant' => $plant->id]) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="px-4 py-2 text-sm rounded-md hover:bg-red-500 text-zinc-600 dark:text-zinc-400 hover:text-zinc-50 dark:hover:text-zinc-50">
                                        {{ __('Delete') }}
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-8">
        {{ $plants->links() }}
    </div>
</x-dashboard-layout>
