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
    @include('layouts.partials.navigation')

    <main class="container px-4 py-8 mx-auto min-h-96">

        @if (session('error'))
            <div class="mb-4 text-sm text-red-600" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
                x-transition>
                {{ session('error') }}
            </div>
        @endif

        @if (session('success'))
            <div class="mb-4 text-sm text-green-600" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
                x-transition>
                {{ session('success') }}
            </div>
        @endif

        @if (isset($header) && isset($description))
            <header class="max-w-screen-md mb-8">
                <h1 class="text-4xl">
                    {{ $header }}
                </h1>
                <p class="mt-2 text-sm text-zinc-600 dark:text-zinc-400">
                    {{ $description }}
                </p>
            </header>
        @endif

        {{ $slot }}
    </main>

    @include('layouts.partials.footer')
    @stack('scripts')
</body>

</html>
