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
            
            <!-- Sidebar -->
            <aside class="w-64 bg-gray-900 text-white p-4">
                <h2 class="text-xl font-bold mb-6">Resident Evil Wikia</h2>
                <nav>
                    <ul class="space-y-2">
                        <li><a " class="block hover:bg-gray-700 p-2 rounded">General</a></li>
                        <li><a  class="block hover:bg-gray-700 p-2 rounded">Personajes</a></li>
                        <li><a  class="block hover:bg-gray-700 p-2 rounded">Locaciones</a></li>
                        <li><a  class="block hover:bg-gray-700 p-2 rounded">Juegos</a></li>
                    </ul>
                </nav>
            </aside>

            <!-- Contenido principal -->
            <div class="flex-1 flex flex-col">
                <livewire:layout.navigation />

                <!-- Page Heading -->
                @if (isset($header))
                    <header class="bg-white shadow">
                        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endif

                <!-- Page Content -->
                <main class="flex-1 p-6">
                    {{ $slot }}
                </main>
            </div>
        </div>
    </body>
</html>
