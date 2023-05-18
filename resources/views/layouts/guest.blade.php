<x-layouts.base>

    <x-layouts.guest.navigation />

    <!-- Page Content -->
    <main class="mx-auto max-w-7xl container mt-8 min-h-screen px-2 md:px-4 lg:px-6">
        {{ $slot }}
    </main>
</x-layouts.base>
