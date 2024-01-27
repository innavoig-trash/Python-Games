<x-dashboard-layout>
    <x-slot name="header">{{ __('Tambah Tanaman Obat dan Nutrasetikal') }}</x-slot>
    <x-slot name="description">
        Tambahkan tanaman obat dan Nutrasetika ke dalam database {{ config('app.name', 'Laravel') }},
        dengan mengisi form berikut dengan lengkap dan benar.
    </x-slot>

    <form class="space-y-6" action="{{ route('dashboard.plants.store') }}" method="POST" enctype="multipart/form-data"
        x-data="{
            url: null,
            image: null,
            preview: null,
            init() {
                this.url = '{{ old('image') }}';
                this.image = this.$refs.image;
                this.preview = this.$refs.preview;
        
                this.image.addEventListener('change', () => {
                    const file = this.image.files[0];
                    if (file) this.url = URL.createObjectURL(file);
                });
            }
        }" x-init="init()">
        @csrf

        <div class="grid items-start grid-cols-1 gap-8 xl:grid-cols-2">
            <div class="space-y-6">
                <div>
                    <x-input-label for="name" :value="__('Nama')" />
                    <x-text-input id="name" name="name" type="text" class="block w-full mt-1"
                        x-value="old('name')" required autofocus />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="description" :value="__('Deskripsi')" />
                    <x-textarea-input id="description" name="description" class="block w-full mt-1" rows="5"
                        required>{{ old('description') }}</x-textarea-input>
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="expiration" :value="__('Umur Simpan')" />
                    <x-text-input id="expiration" name="expiration" type="number" class="block w-full mt-1"
                        x-value="old('expiration')" required />
                    <x-input-error :messages="$errors->get('expiration')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="benefit" :value="__('Manfaat')" />
                    <x-textarea-input id="benefit" name="benefit" class="block w-full mt-1" rows="5"
                        required>{{ old('benefit') }}</x-textarea-input>
                    <x-input-error :messages="$errors->get('benefit')" class="mt-2" />
                </div>
            </div>

            <div>
                <x-input-label for="image" :value="__('Unggah Gambar')" />
                <div
                    class="mt-1 relative w-full overflow-hidden border rounded-md aspect-[4/3] bg-zinc-50 dark:bg-zinc-900 border-zinc-300 dark:border-zinc-700">
                    <img class="object-cover w-full h-full" x-show="url" x-ref="preview"
                        x-bind:src="url" />
                    <div class="absolute flex flex-col items-center justify-center w-full h-full cursor-pointer text-zinc-400 dark:text-zinc-600"
                        x-show="!url" x-on:click="image.click()">
                        <i class="w-5 h-5 mb-2" data-lucide="image"></i>
                        <p class="text-sm">{{ __('Pilih gambar') }}</p>
                        <p class="text-sm">{{ __('Dengan format JPG, PNG, GIF maks 2MB') }}</p>
                    </div>
                    <input id="image" name="image" type="file"
                        class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" x-ref="image"
                        accept="image/*" />
                </div>
                <x-input-error :messages="$errors->get('image')" class="mt-2" />
            </div>
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save Plant') }}</x-primary-button>
            <x-secondary-button type="reset"
                x-on:click="url = null; image.value = null; preview.src = null;">{{ __('Reset') }}</x-secondary-button>
        </div>
    </form>
</x-dashboard-layout>
