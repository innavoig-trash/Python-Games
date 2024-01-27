<x-app-layout>
    <section id='hero'
        class='flex flex-col space-y-4 items-center justify-center h-[700px] w-full max-w-3xl mx-auto'>

        <span class='px-2 py-0.5 text-xs border rounded-full border-plant-500 font-medium'>Selamat Datang</span>

        <h1 class='text-5xl text-center md:text-6xl xl:text-7xl'>
            Jelajahi Kekuatan Alami Tanaman Obat dan Nutrasetikal Bersama Kami
        </h1>

        <p class='text-sm text-center text-zinc-600 dark:text-zinc-400'>
            Temukan solusi alami untuk kesehatan Anda melalui kearifan alam. Gunakan fitur kami untuk memindai QR code
            dan temukan tanaman obat secara instan atau jelajahi daftar lengkap tanaman dan nutrasetikal yang
            bermanfaat. Mari bergabung dalam perjalanan menuju kesehatan yang holistik!
        </p>

        <div class='flex items-center justify-center space-x-2'>
            <a href='{{ route('scanner') }}'>
                <x-primary-button>Pindai QR Tanaman</x-primary-button>
            </a>
            <a href='{{ route('plants.index') }}'>
                <x-secondary-button>Telusuri Tanaman</x-secondary-button>
            </a>
        </div>
    </section>

    <section id='service' class='py-10'>
        <div class='w-full max-w-3xl mx-auto text-center'>
            <h2 class='text-2xl font-bold'>Fitur Unggulan</h2>
            <p class='mb-4 text-sm text-zinc-600 dark:text-zinc-400'>
                Temukan bagaimana {{ config('app.name', 'Laravel') }} dapat memberikan kemudahan dan kepraktisan untuk
                mendapatkan pengetahuan yang lebih dalam tentang tanaman yang bermanfaat.
            </p>
        </div>
        <div class='grid grid-cols-1 gap-6 xl:grid-cols-3'>
            <div class='p-8 bg-white border rounded-xl border-zinc-200 dark:border-zinc-700 dark:bg-zinc-800'>
                <div class='relative flex-none w-10 h-10 rounded-full bg-plant-500'>
                    <i class='absolute w-5 h-5 -translate-x-1/2 -translate-y-1/2 text-zinc-50 top-1/2 left-1/2'
                        data-lucide='qr-code'></i>
                </div>
                <h3 class='mt-4 text-xl font-bold'>Pemindaian Tanaman</h3>
                <p class='text-sm text-zinc-600 dark:text-zinc-400'>
                    Temukan tanaman obat dan nutrasetikal secara instan dengan fitur pemindaian kamil, dan dapatkan
                    informasi rinci seputar manfaat dan penggunaan tanaman tersebut
                </p>
            </div>
            <div class='p-8 bg-white border rounded-xl border-zinc-200 dark:border-zinc-700 dark:bg-zinc-800'>
                <div class='relative flex-none w-10 h-10 rounded-full bg-plant-500'>
                    <i class='absolute w-5 h-5 -translate-x-1/2 -translate-y-1/2 text-zinc-50 top-1/2 left-1/2'
                        data-lucide='flower'></i>
                </div>
                <h3 class='mt-4 text-xl font-bold'>Kelola Tanaman</h3>
                <p class='text-sm text-zinc-600 dark:text-zinc-400'>
                    Pengeloalaan tanaman menjadi lebih mudah dengan fitur kelola tanaman kami, admin dapat
                    dengan mudah menambahkan, mengubah, dan menghapus data tanaman.
                </p>
            </div>
            <div class='p-8 bg-white border rounded-xl border-zinc-200 dark:border-zinc-700 dark:bg-zinc-800'>
                <div class='relative flex-none w-10 h-10 rounded-full bg-plant-500'>
                    <i class='absolute w-5 h-5 -translate-x-1/2 -translate-y-1/2 text-zinc-50 top-1/2 left-1/2'
                        data-lucide='key-square'></i>
                </div>
                <h3 class='mt-4 text-xl font-bold'>QR Code</h3>
                <p class='text-sm text-zinc-600 dark:text-zinc-400'>
                    Gunakan QR-code ini untuk berbagi informasi dengan teman, keluarga, atau pelanggan Anda, menjadikan
                    penyebaran pengetahuan tanaman lebih mudah dan cepat.
                </p>
            </div>
        </div>
    </section>

    <section id="about" class="py-10">
        <div class="grid items-center grid-cols-1 gap-8 xl:grid-cols-2">
            <div class="relative p-8">
                <div
                    class="absolute w-3/4 transform -translate-x-1/2 -translate-y-1/2 bg-white border rounded-full -z-10 aspect-square dark:bg-zinc-800 top-1/2 left-1/2 border-zinc-200 dark:border-zinc-700">
                </div>
                <img src="{{ asset('images/plant.png') }}" alt="Hero" class="w-full">
            </div>
            <div class="p-8">
                <h2 class='text-5xl font-bold'>Tentang kami</h2>
                <div class="flex py-4">
                    <span class='block px-6 py-2 text-sm font-semibold text-white rounded-full bg-plant-500'>
                        TIM 114 KKN ITERA
                    </span>
                </div>
                <p class='mb-4 text-sm text-zinc-600 dark:text-zinc-400'>
                    {{ config('app.name', 'Laravel') }} bertujuan untuk memanajemen tanaman obat dan produk nutrasetikal
                    hasil pengembangan Kelompok 114 KKN ITERA Periode-12. Bertujuan untuk mempermudah dalam mengakses
                    informasi mengenai tanaman obat dan hasil produk nutrasetikal yang telah dibuat.
                </p>
            </div>
        </div>
</x-app-layout>
