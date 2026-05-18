<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="flex min-h-screen bg-gray-100">
            <div class="flex-1 flex flex-col">
                <livewire:layout.navigation />

                <!-- Page Heading -->


                <!-- Contenedor con Sidebar + Contenido -->
                <div class="flex flex-1">
                    <!-- Sidebar -->
                    <aside class="w-64 text-gray-900 bg-white p-4">
                        <h2 class="text-xl font-bold mb-6">Resident Evil Wikia</h2>
                        <nav>
                            <ul class="space-y-2">
                                <li><a href="{{ route('dashboard-general') }}" class="block hover:bg-gray-700 p-2 rounded">General</a></li>
                                <li><a href="{{ route('characters') }}"class="block hover:bg-gray-700 p-2 rounded">Personajes</a></li>
                                <li><a href="{{ route('locations') }}"class="block hover:bg-gray-700 p-2 rounded">Locaciones</a></li>
                                <li><a href="{{ route('games') }}" class="block hover:bg-gray-700 p-2 rounded">Juegos</a></li>
                            </ul>
                        </nav>
                    </aside>

                    <!-- Contenido principal -->
                    <main class="flex-1 p-6">
                        {{ $slot }}
                    </main>
                </div>
            </div>
        </div>
    </body>
</html>