<x-dashboard-layout>
    <x-slot name="header">{{ __('Pemindaian Tanaman') }}</x-slot>
    <x-slot name="description">
        Nikmati pengalaman penjelajahan tanaman tanpa batas dengan bantuan teknologi QR-code kami. Dapatkan informasi
        lengkap tentang tanaman obat dan nutrasetikal hanya dengan satu pemindaian, mari temukan keajaiban alam di balik
        setiap tanaman.
    </x-slot>

    <div class="grid grid-cols-1 gap-8 lg:grid-cols-2">
        <div
            class="relative w-full overflow-hidden bg-white border aspect-square rounded-xl border-zinc-200 dark:border-zinc-700 dark:bg-zinc-800">
            <div
                class="absolute w-4/5 transform -translate-x-1/2 -translate-y-1/2 border-2 border-dashed aspect-square top-1/2 left-1/2 border-zinc-200 dark:border-zinc-700 rounded-xl">
            </div>
            <video id="preview" class="object-cover w-full h-full"></video>
            <div id="reader"></div>
        </div>

        <div class="p-6">
            <h2 class="text-xl font-bold">Pastikan Perangkat Mendukung Kamera</h2>
            <p class="mt-2 text-sm text-zinc-600 dark:text-zinc-400">
                Pastikan perangkat Anda mendukung kamera untuk mengakses fitur ini. Jika tidak, kami menyediakan opsi
                alternatif untuk mengunggah gambar tanaman secara manual.
            </p>

            <p class="hidden mt-1 text-sm text-red-500" id="error"></p>

            <div class="mt-6">
                <x-input-label for="image" :value="__('Pilih Gambar')" />
                <input id="image" name="image" type="file" class="hidden" />
                <x-primary-button class="mt-1" onclick="document.getElementById('image').click()">
                    {{ __('Unggah Gambar') }}
                </x-primary-button>
            </div>

            <div class="flex items-center mt-6 space-x-4">
                <div>
                    <x-input-label for="cameras" :value="__('Kamera')" />
                    <select
                        class="flex items-center px-4 py-2 mt-1 text-sm font-semibold bg-white border rounded-md w-52 dark:bg-zinc-800 border-zinc-200 dark:border-zinc-700 text-zinc-900 dark:text-zinc-100 hover:bg-zinc-100 dark:hover:bg-zinc-700 focus:outline-none disabled:opacity-2 focus:ring-plant-500 focus:border-plant-500"
                        id="cameras">
                        <option value="" disabled selected>Pilih Kamera</option>
                    </select>
                </div>

                <div>
                    <x-input-label for="close" :value="__('Berhenti')" />
                    <x-danger-button id="close" class="mt-1">
                        {{ __('Tutup Kamera') }}
                    </x-danger-button>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
        <script>
            const scanner = new Html5Qrcode("reader");

            const video = document.querySelector('video');
            const select = document.getElementById('cameras');
            const close = document.getElementById('close');
            const error = document.getElementById('error');
            const upload = document.getElementById('image');

            const qrCodeSuccessCallback = (decodedText, decodedResult) => {
                console.log(`Scan result: ${decodedText}`, decodedResult);

                try {
                    const origin = new URL(window.location.href).origin;
                    const url = new URL(decodedText);
                    const pattern = new RegExp(`^${origin}/plants/[0-9]+$`);

                    if (!pattern.test(decodedText)) {
                        error.classList.remove('hidden');
                        error.textContent = 'Only QR code from this application is allowed';
                        return;
                    }
                    window.location.href = decodedText;
                } catch (err) {
                    error.classList.remove('hidden');
                    error.textContent = 'QR code is not a URL';
                }
            };

            const qrCodeErrorCallback = (err) => {
                // dont do anything
            };

            const changeCamera = (deviceId) => {
                // reset the video source
                video.srcObject?.getTracks().forEach(track => track.stop());
                video.srcObject = null;

                // change the video source
                navigator.mediaDevices.getUserMedia({
                        video: {
                            deviceId: {
                                exact: deviceId
                            }
                        }
                    })
                    .then(function(stream) {
                        video.srcObject = stream;
                        video.onloadedmetadata = function(e) {
                            video.play();
                        };
                    })
                    .catch(function(err) {
                        document.getElementById('error').classList.remove('hidden');
                    });

                // start scanning the qr code
                scanner.start(
                        deviceId, {
                            fps: 10,
                            qrbox: {
                                width: 400,
                                height: 400
                            }
                        },
                        qrCodeSuccessCallback,
                        qrCodeErrorCallback
                    )
                    .catch((err) => {
                        console.log(`Unable to start scanning, error: ${err}`);
                    });
            };

            // get all the cameras
            Html5Qrcode.getCameras()
                .then((devices) => {
                    devices.forEach((device) => {
                        const option = document.createElement('option');
                        option.value = device.id;
                        option.text = device.label;
                        select.appendChild(option);
                    });
                })
                .catch((err) => {
                    error.classList.remove('hidden');
                    error.textContent = 'Unable to get cameras, please refresh the page.'
                });

            // listen to the change event of the camera select
            select.addEventListener('change', (e) => {
                changeCamera(e.target.value);
            });

            // stop the scanner
            close.addEventListener('click', (e) => {
                video.srcObject?.getTracks().forEach(track => track.stop());
                video.srcObject = null;

                // reset the scanner and camera select
                select.value = '';
                scanner.stop();
            });

            // listen to file input change event
            upload.addEventListener('change', (e) => {
                if (e.target.files && e.target.files.length > 0) {
                    const file = e.target.files[0];
                    scanner.scanFile(file, true)
                        .then(qrCodeSuccessCallback)
                        .catch(qrCodeErrorCallback);
                }
            });
        </script>
    @endpush
</x-dashboard-layout>
