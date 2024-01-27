<x-dashboard-layout>
    <x-slot name="header">{{ __('Dashboard') }}</x-slot>
    <x-slot name="description">
        Disini anda dapat melihat statistik terkait tanaman obat dan nutrasetikal di
        {{ config('app.name', 'Laravel') }}, seperti jumlah tanaman yang ada di database, jumlah tanaman yang
        ditambahkan dalam seminggu, dan jumlah tanaman yang ditambahkan dalam sebulan.
    </x-slot>

    <div class="grid grid-cols-1 gap-8 xl:grid-cols-3">
        <div class="p-6 border bg-zinc-50 rounded-xl border-zinc-300 dark:border-zinc-700 dark:bg-zinc-900">
            <span class="font-semibold">Total Tanaman</span>
            <p class="text-sm text-zinc-600 dark:text-zinc-400">
                Total jumlah tanaman obat dan nutrasetikal di {{ config('app.name', 'Laravel') }}.
            </p>
            <p class="mt-2 text-4xl font-bold">{{ $count['total'] }}</p>
        </div>

        <div class="p-6 border bg-zinc-50 rounded-xl border-zinc-300 dark:border-zinc-700 dark:bg-zinc-900">
            <span class="font-semibold">Minggu Ini</span>
            <p class="text-sm text-zinc-600 dark:text-zinc-400">
                Jumlah tanaman yang ditambahkan dalam seminggu terakhir.
            </p>
            <p class="mt-2 text-4xl font-bold">{{ $count['week'] }}</p>
        </div>

        <div class="p-6 border bg-zinc-50 rounded-xl border-zinc-300 dark:border-zinc-700 dark:bg-zinc-900">
            <span class="font-semibold">Bulan Ini</span>
            <p class="text-sm text-zinc-600 dark:text-zinc-400">
                Jumlah tanaman yang ditambahkan dalam sebulan terakhir.
            </p>
            <p class="mt-2 text-4xl font-bold">{{ $count['month'] }}</p>
        </div>
    </div>

</x-dashboard-layout>
