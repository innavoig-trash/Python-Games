<x-app-layout>
    <div class="mb-20 space-y-6">
        <div class="p-8 bg-white border rounded-lg dark:bg-zinc-800 border-zinc-200 dark:border-zinc-700">
            <div class="max-w-xl">
                @include('profile.partials.update-profile')
            </div>
        </div>

        <div class="p-8 bg-white border rounded-lg dark:bg-zinc-800 border-zinc-200 dark:border-zinc-700">
            <div class="max-w-xl">
                @include('profile.partials.update-password')
            </div>
        </div>

        <div class="p-8 bg-white border rounded-lg dark:bg-zinc-800 border-zinc-200 dark:border-zinc-700">
            <div class="max-w-xl">
                @include('profile.partials.delete-user')
            </div>
        </div>
    </div>
</x-app-layout>
