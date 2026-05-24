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

                <!-- Contenedor con Sidebar + Contenido -->
                <div class="flex flex-1">
                    <!-- Sidebar -->
                    <aside class="w-64 text-gray-900 bg-white p-4 flex flex-col">
                        <h2 class="text-xl font-bold mb-2">Resident Evil Wikia</h2>

                        {{-- Role badge --}}
                        @auth
                            @if(auth()->user()->role === 'admin')
                                <span class="inline-block mb-4 text-xs font-bold bg-red-700 text-white px-2 py-0.5 rounded-full uppercase">
                                    Administrador
                                </span>
                            @else
                                <span class="inline-block mb-4 text-xs font-bold bg-gray-600 text-white px-2 py-0.5 rounded-full uppercase">
                                    Editor
                                </span>
                            @endif
                        @endauth

                        <nav class="flex-1">
                            <ul class="space-y-1">
                                {{-- Dashboard (redirects by role) --}}
                                <li>
                                    <a href="{{ route('dashboard') }}"
                                       class="flex items-center gap-2 hover:bg-red-50 hover:text-red-700 p-2 rounded font-medium transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                        </svg>
                                        Mi Dashboard
                                    </a>
                                </li>

                                <li>
                                    <a href="{{ route('dashboard-general') }}"
                                       class="block hover:bg-gray-100 p-2 rounded transition-colors">
                                        General
                                    </a>
                                </li>

                                <li class="pt-3 text-xs font-semibold uppercase text-gray-400 px-2">Wikia</li>
                                <li><a href="{{ route('characters') }}" class="block hover:bg-gray-100 p-2 rounded transition-colors">Personajes</a></li>
                                <li><a href="{{ route('locations') }}" class="block hover:bg-gray-100 p-2 rounded transition-colors">Locaciones</a></li>
                                <li><a href="{{ route('games') }}" class="block hover:bg-gray-100 p-2 rounded transition-colors">Juegos</a></li>

                                <li class="pt-3 text-xs font-semibold uppercase text-gray-400 px-2">Administrar</li>
                                <li><a href="{{ route('admin.characters.index') }}" class="block hover:bg-gray-100 p-2 rounded transition-colors">Personajes</a></li>
                                <li><a href="{{ route('admin.locations.index') }}" class="block hover:bg-gray-100 p-2 rounded transition-colors">Locaciones</a></li>
                                <li><a href="{{ route('admin.games.index') }}" class="block hover:bg-gray-100 p-2 rounded transition-colors">Juegos</a></li>

                                @if(auth()->user()?->role === 'admin')
                                    <li class="pt-3 text-xs font-semibold uppercase text-gray-400 px-2">Reportes</li>
                                    <li>
                                        <a href="{{ route('admin.reports.index') }}"
                                           class="block hover:bg-gray-100 p-2 rounded transition-colors">
                                            Generar PDF
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </nav>
                    </aside>

                    <!-- Contenido principal -->
                    <main class="flex-1 p-6">
                        @yield('content')
                        {{ $slot ?? '' }}
                    </main>
                </div>
            </div>
        </div>

        @stack('scripts')
    </body>
</html>
