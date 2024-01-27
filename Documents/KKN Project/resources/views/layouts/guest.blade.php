<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="theme"
    x-bind:class="{ 'dark': mode === 'dark' }" x-cloak>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    @include('layouts.partials.metatags')

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased bg-zinc-50 dark:bg-zinc-900 text-zinc-900 dark:text-zinc-100">
    <main class="relative grid h-screen grid-cols-1 overflow-hidden xl:grid-cols-2">

        <div class="absolute top-0 left-0 z-10 flex items-center justify-between w-full p-8">
            <x-app-logo variant="white" class="hidden xl:flex" />
            <x-app-logo class="xl:hidden" />
            <x-theme-toggle></x-theme-toggle>
        </div>

        <div class="hidden w-full overflow-hidden xl:block">
            <img src="{{ asset('images/backdrop.jpg') }}" alt="Hero" class="object-cover w-full h-full">
        </div>

        <div class="relative flex items-center justify-center">
            <div class="w-full max-w-md">
                <div class="flex items-center justify-between mb-2">
                    <x-app-logo />
                </div>
                {{ $slot }}
            </div>

            <div class="absolute bottom-0 left-0 w-full">
                @include('layouts.partials.footer')
            </div>
        </div>
    </main>

    @stack('scripts')
</body>

</html>
