<x-guest-layout>
    <div class="mb-4 text-sm text-zinc-600 dark:text-zinc-400">
        Terima kasih telah mendaftar! Sebelum memulai, silahkan verifikasi email anda dengan mengklik link yang telah
        kami kirimkan ke email anda. Jika anda tidak menerima email, kami akan mengirimkan email lainnya.
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 text-sm font-medium text-green-600 dark:text-green-400">
            Link verifikasi baru telah dikirim ke email yang anda gunakan saat mendaftar.
        </div>
    @endif

    <div class="flex items-center justify-between mt-4">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <div>
                <x-primary-button>
                    {{ __('Kirim ulang email verifikasi') }}
                </x-primary-button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="text-sm underline rounded-md text-zinc-600 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-zinc-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-plant-500 dark:focus:ring-offset-zinc-800">
                {{ __('Keluar') }}
            </button>
        </form>
    </div>
</x-guest-layout>
