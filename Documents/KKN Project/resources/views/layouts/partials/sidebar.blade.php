<div class="space-y-2">
    <h2 class="px-3">Dashboard</h2>
    <p class="px-3 mb-2 text-sm text-zinc-600 dark:text-zinc-400">
        Lihat statistik dan informasi terkait tanaman obat dan nutrasetikal.
    </p>
    <a href="{{ route('dashboard.index') }}"
        class="flex items-center p-3 text-sm rounded-md hover:bg-zinc-100 dark:hover:bg-zinc-800 text-zinc-600 hover:text-plant-600 dark:text-zinc-400 dark:hover:text-zinc-50 {{ request()->routeIs('dashboard.index') ? 'bg-zinc-100 dark:bg-zinc-800 text-plant-600 dark:text-zinc-50' : '' }}">
        <i class="w-5 h-5 mr-2" data-lucide="home"></i>
        {{ __('Halaman Utama') }}
    </a>
    <a href="{{ route('dashboard.scanner') }}"
        class="flex items-center p-3 text-sm rounded-md hover:bg-zinc-100 dark:hover:bg-zinc-800 text-zinc-600 hover:text-plant-600 dark:text-zinc-400 dark:hover:text-zinc-50 {{ request()->routeIs('dashboard.scanner') ? 'bg-zinc-100 dark:bg-zinc-800 text-plant-600 dark:text-zinc-50' : '' }}">
        <i class="w-5 h-5 mr-2" data-lucide="qr-code"></i>
        {{ __('Pemindai Tanaman') }}
    </a>

    <div class="py-4 hidden xl:block mx-auto w-[200px]">
        <hr class="border-zinc-200 dark:border-zinc-700" />
    </div>

    <h2 class="px-3">Tanaman dan Nutrastikal</h2>
    <p class="px-3 mb-2 text-sm text-zinc-600 dark:text-zinc-400">
        Kelola tambahkan dan lihat statistik tanaman obat dan nutrasetikal.
    </p>
    <a href="{{ route('dashboard.plants.index') }}"
        class="flex items-center p-3 text-sm rounded-md hover:bg-zinc-100 dark:hover:bg-zinc-800 text-zinc-600 hover:text-plant-600 dark:text-zinc-400 dark:hover:text-zinc-50 {{ request()->routeIs('dashboard.plants.index') ? 'bg-zinc-100 dark:bg-zinc-800 text-plant-600 dark:text-zinc-50' : '' }}">
        <i class="w-5 h-5 mr-2" data-lucide="flower"></i>
        {{ __('Daftar Tanaman') }}
    </a>
    <a href="{{ route('dashboard.plants.create') }}"
        class="flex items-center p-3 text-sm rounded-md hover:bg-zinc-100 dark:hover:bg-zinc-800 text-zinc-600 hover:text-plant-600 dark:text-zinc-400 dark:hover:text-zinc-50 {{ request()->routeIs('dashboard.plants.create') ? 'bg-zinc-100 dark:bg-zinc-800 text-plant-600 dark:text-zinc-50' : '' }}">
        <i class="w-5 h-5 mr-2" data-lucide="square-pen"></i>
        {{ __('Tambah Tanaman') }}
    </a>
</div>
