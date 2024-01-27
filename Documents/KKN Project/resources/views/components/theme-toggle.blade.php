<button
    class="relative bg-white border rounded-lg w-9 h-9 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400 hover:text-zinc-700 dark:hover:text-zinc-300 focus:outline-none border-zinc-200 dark:border-zinc-700"
    x-data="theme" x-on:click="toggle">
    <i class="absolute w-5 h-5 transform -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" data-lucide="moon"
        x-show="mode === 'dark'"></i>
    <i class="absolute w-5 h-5 transform -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" data-lucide="sun"
        x-show="mode === 'light'"></i>
    <span class="sr-only">Toggle theme</span>
</button>
