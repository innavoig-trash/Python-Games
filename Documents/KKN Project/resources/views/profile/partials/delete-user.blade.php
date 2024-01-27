<section class="space-y-6">
    <header>
        <h2 class="text-lg">
            {{ __('Hapus Akun') }}
        </h2>

        <p class="text-sm text-zinc-600 dark:text-zinc-400">
            Setelah akun Anda dihapus, data dan informasi yang ada akan dihapus secara permanen. Sebelum menghapus akun
            Anda, silakan unduh data atau informasi apa pun yang ingin Anda simpan.
        </p>
    </header>

    <x-danger-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">
        {{ __('Hapus') }}
    </x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-8">
            @csrf
            @method('delete')

            <h2 class="text-lg">
                Apakah Anda yakin ingin menghapus akun Anda?
            </h2>
            <p class="text-sm text-zinc-600 dark:text-zinc-400">
                Setelah akun Anda dihapus, semua sumber daya dan data akan dihapus secara permanen. Silakan masukkan
                kata sandi Anda untuk mengkonfirmasi bahwa Anda ingin menghapus akun Anda secara permanen.
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Password') }}" />
                <x-text-input id="password" name="password" type="password" class="block w-full mt-1"
                    placeholder="{{ __('Password') }}" />
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="flex justify-end mt-6">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Batal') }}
                </x-secondary-button>

                <x-danger-button class="ms-3">
                    {{ __('Hapus') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
