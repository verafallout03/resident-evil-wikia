<x-app-layout>
    <div class="mb-6">
        <h1 class="text-2xl font-bold">Generación de Reportes PDF</h1>
        <p class="text-sm text-gray-500 mt-1">Selecciona un tipo de reporte, aplica filtros y descarga el PDF.</p>
    </div>

    {{-- Tab navigation --}}
    <div x-data="{ tab: 'characters' }" class="space-y-4">
        <div class="flex gap-1 border-b border-gray-200">
            <button @click="tab = 'characters'"
                    :class="tab === 'characters' ? 'border-red-700 text-red-700 font-semibold' : 'border-transparent text-gray-500 hover:text-gray-700'"
                    class="px-4 py-2 border-b-2 text-sm transition-colors">
                Personajes
            </button>
            <button @click="tab = 'games'"
                    :class="tab === 'games' ? 'border-red-700 text-red-700 font-semibold' : 'border-transparent text-gray-500 hover:text-gray-700'"
                    class="px-4 py-2 border-b-2 text-sm transition-colors">
                Juegos
            </button>
            <button @click="tab = 'locations'"
                    :class="tab === 'locations' ? 'border-red-700 text-red-700 font-semibold' : 'border-transparent text-gray-500 hover:text-gray-700'"
                    class="px-4 py-2 border-b-2 text-sm transition-colors">
                Locaciones
            </button>
        </div>

        {{-- ── Characters report ──────────────────────────────── --}}
        <div x-show="tab === 'characters'" class="rounded bg-white p-6 shadow">
            <h2 class="text-lg font-semibold mb-4 text-red-800">Reporte de Personajes</h2>
            <form action="{{ route('admin.reports.characters') }}" method="GET" target="_blank">
                <div class="grid grid-cols-2 gap-4 mb-4 md:grid-cols-4">
                    <div>
                        <label class="mb-1 block text-sm font-medium">Facción</label>
                        <select name="faction" class="w-full rounded border px-3 py-2 text-sm">
                            <option value="">Todas</option>
                            @foreach (['S.T.A.R.S.','B.S.A.A.','Umbrella','Neo-Umbrella','The Connections','Independent','Villain','Infected','Unknown'] as $f)
                                <option value="{{ $f }}">{{ $f }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="mb-1 block text-sm font-medium">Estado</label>
                        <select name="status" class="w-full rounded border px-3 py-2 text-sm">
                            <option value="">Todos</option>
                            <option value="alive">Vivo</option>
                            <option value="deceased">Fallecido</option>
                            <option value="unknown">Desconocido</option>
                            <option value="mutated">Mutado</option>
                        </select>
                    </div>
                    <div>
                        <label class="mb-1 block text-sm font-medium">Juego</label>
                        <select name="game_id" class="w-full rounded border px-3 py-2 text-sm">
                            <option value="">Todos</option>
                            @foreach ($games as $game)
                                <option value="{{ $game->id }}">{{ $game->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="mb-1 block text-sm font-medium">¿Jugable?</label>
                        <select name="is_playable" class="w-full rounded border px-3 py-2 text-sm">
                            <option value="">Todos</option>
                            <option value="1">Solo jugables</option>
                            <option value="0">Solo no jugables</option>
                        </select>
                    </div>
                </div>
                <button type="submit"
                        class="inline-flex items-center gap-2 rounded bg-red-700 px-5 py-2 text-sm text-white hover:bg-red-800">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 10v6m0 0l-3-3m3 3l3-3M3 17V7a2 2 0 012-2h6l2 2h4a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z"/>
                    </svg>
                    Generar y Descargar PDF
                </button>
            </form>
        </div>

        {{-- ── Games report ──────────────────────────────────── --}}
        <div x-show="tab === 'games'" class="rounded bg-white p-6 shadow">
            <h2 class="text-lg font-semibold mb-4 text-red-800">Reporte de Juegos</h2>
            <form action="{{ route('admin.reports.games') }}" method="GET" target="_blank">
                <div class="grid grid-cols-2 gap-4 mb-4 md:grid-cols-3">
                    <div>
                        <label class="mb-1 block text-sm font-medium">Tipo de Canon</label>
                        <select name="canon" class="w-full rounded border px-3 py-2 text-sm">
                            <option value="">Todos</option>
                            <option value="main">Principal</option>
                            <option value="spin-off">Spin-off</option>
                            <option value="remake">Remake</option>
                        </select>
                    </div>
                    <div>
                        <label class="mb-1 block text-sm font-medium">Año desde</label>
                        <input type="number" name="year_from" placeholder="1996" min="1996" max="2100"
                               class="w-full rounded border px-3 py-2 text-sm">
                    </div>
                    <div>
                        <label class="mb-1 block text-sm font-medium">Año hasta</label>
                        <input type="number" name="year_to" placeholder="{{ date('Y') }}" min="1996" max="2100"
                               class="w-full rounded border px-3 py-2 text-sm">
                    </div>
                </div>
                <button type="submit"
                        class="inline-flex items-center gap-2 rounded bg-red-700 px-5 py-2 text-sm text-white hover:bg-red-800">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 10v6m0 0l-3-3m3 3l3-3M3 17V7a2 2 0 012-2h6l2 2h4a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z"/>
                    </svg>
                    Generar y Descargar PDF
                </button>
            </form>
        </div>

        {{-- ── Locations report ────────────────────────────────── --}}
        <div x-show="tab === 'locations'" class="rounded bg-white p-6 shadow">
            <h2 class="text-lg font-semibold mb-4 text-red-800">Reporte de Locaciones</h2>
            <form action="{{ route('admin.reports.locations') }}" method="GET" target="_blank">
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="mb-1 block text-sm font-medium">País</label>
                        <input type="text" name="country" placeholder="Ej: USA, España..."
                               class="w-full rounded border px-3 py-2 text-sm">
                    </div>
                    <div>
                        <label class="mb-1 block text-sm font-medium">Región</label>
                        <input type="text" name="region" placeholder="Ej: Raccoon City..."
                               class="w-full rounded border px-3 py-2 text-sm">
                    </div>
                </div>
                <button type="submit"
                        class="inline-flex items-center gap-2 rounded bg-red-700 px-5 py-2 text-sm text-white hover:bg-red-800">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 10v6m0 0l-3-3m3 3l3-3M3 17V7a2 2 0 012-2h6l2 2h4a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z"/>
                    </svg>
                    Generar y Descargar PDF
                </button>
            </form>
        </div>

    </div>
</x-app-layout>
