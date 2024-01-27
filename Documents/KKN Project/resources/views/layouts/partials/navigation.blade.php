<nav>
    <div class="container px-4 py-8 mx-auto">
        <div class="flex items-center justify-between">
            <x-app-logo></x-app-logo>

            <div class="flex items-center space-x-4">
                <x-dropdown>
                    <x-slot name="trigger">
                        <button
                            class="flex items-center px-3 py-2 text-sm font-medium bg-white border rounded-lg dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400 hover:text-zinc-700 dark:hover:text-zinc-300 focus:outline-none border-zinc-200 dark:border-zinc-700">
                            <div>{{ __('Fitur Aplikasi') }}</div>
                            <i class="w-4 h-4 ml-2" data-lucide="chevron-down"></i>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        @auth
                            <x-dropdown-link :href="route('dashboard.index')">
                                {{ __('Dashboard') }}
                            </x-dropdown-link>
                        @endauth

                        <x-dropdown-link href="{{ route('plants.index') }}">
                            {{ __('Daftar Tanaman') }}
                        </x-dropdown-link>

                        <x-dropdown-link href="{{ route('scanner') }}">
                            {{ __('Pindai Tanaman') }}
                        </x-dropdown-link>
                    </x-slot>
                </x-dropdown>

                @if (Auth::guest())
                    <a href="{{ route('login') }}"
                        class="px-3 py-2 text-sm font-medium bg-white border rounded-lg dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400 hover:text-zinc-700 dark:hover:text-zinc-300 focus:outline-none border-zinc-200 dark:border-zinc-700">
                        {{ __('Masuk') }}
                    </a>
                @else
                    <x-dropdown>
                        <x-slot name="trigger">
                            <button
                                class="flex items-center px-3 py-2 text-sm font-medium bg-white border rounded-lg dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400 hover:text-zinc-700 dark:hover:text-zinc-300 focus:outline-none border-zinc-200 dark:border-zinc-700">
                                <div>{{ Auth::user()->name }}</div>
                                <i class="w-4 h-4 ml-2" data-lucide="chevron-down"></i>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Kelola Profil') }}
                            </x-dropdown-link>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Keluar Aplikasi') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @endif
                <x-theme-toggle></x-theme-toggle>
            </div>
        </div>
    </div>
</nav>
