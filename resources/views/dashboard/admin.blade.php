<x-app-layout>
    <div class="mb-6">

        {{-- Header --}}
        <div class="flex items-center gap-3 mb-6">
            <span class="bg-red-700 text-white text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wide">
                Administrador
            </span>
            <h1 class="text-2xl font-bold text-gray-800">Panel de Administración</h1>
        </div>

        {{-- Stat Cards --}}
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
            <div class="bg-white rounded-lg shadow p-5 border-l-4 border-red-700">
                <p class="text-sm text-gray-500 mb-1">Juegos</p>
                <p class="text-3xl font-bold text-gray-800">{{ $stats['games'] }}</p>
            </div>
            <div class="bg-white rounded-lg shadow p-5 border-l-4 border-red-700">
                <p class="text-sm text-gray-500 mb-1">Personajes</p>
                <p class="text-3xl font-bold text-gray-800">{{ $stats['characters'] }}</p>
            </div>
            <div class="bg-white rounded-lg shadow p-5 border-l-4 border-red-700">
                <p class="text-sm text-gray-500 mb-1">Locaciones</p>
                <p class="text-3xl font-bold text-gray-800">{{ $stats['locations'] }}</p>
            </div>
            <div class="bg-white rounded-lg shadow p-5 border-l-4 border-red-700">
                <p class="text-sm text-gray-500 mb-1">Usuarios</p>
                <p class="text-3xl font-bold text-gray-800">{{ $stats['users'] }}</p>
            </div>
        </div>

        {{-- Charts --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            {{-- Donut: Personajes por Facción --}}
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-lg font-semibold text-gray-700 mb-4">Personajes por Facción</h2>
                @if($factionData->isEmpty())
                    <p class="text-gray-400 text-sm">Sin datos disponibles.</p>
                @else
                    <div class="flex justify-center">
                        <canvas id="factionChart" style="max-height:300px;"></canvas>
                    </div>
                @endif
            </div>

            {{-- Bar: Juegos por Año --}}
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-lg font-semibold text-gray-700 mb-4">Juegos por Año de Lanzamiento</h2>
                @if($gamesByYear->isEmpty())
                    <p class="text-gray-400 text-sm">Sin datos disponibles.</p>
                @else
                    <canvas id="gamesYearChart" style="max-height:300px;"></canvas>
                @endif
            </div>

        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <script>
        const FACTION_COLORS = [
            '#1e3a5f','#7f1d1d','#14532d','#1c1917',
            '#4a1d96','#92400e','#991b1b','#1e40af','#6b7280'
        ];

        @unless($factionData->isEmpty())
        new Chart(document.getElementById('factionChart'), {
            type: 'doughnut',
            data: {
                labels: @json($factionData->pluck('faction')),
                datasets: [{
                    data: @json($factionData->pluck('total')),
                    backgroundColor: FACTION_COLORS,
                    borderWidth: 2,
                    borderColor: '#ffffff',
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'right', labels: { font: { size: 12 } } },
                    tooltip: {
                        callbacks: {
                            label: ctx => ` ${ctx.label}: ${ctx.parsed} personaje(s)`
                        }
                    }
                }
            }
        });
        @endunless

        @unless($gamesByYear->isEmpty())
        new Chart(document.getElementById('gamesYearChart'), {
            type: 'bar',
            data: {
                labels: @json($gamesByYear->pluck('release_year')),
                datasets: [{
                    label: 'Juegos',
                    data: @json($gamesByYear->pluck('total')),
                    backgroundColor: '#b91c1c',
                    borderRadius: 4,
                    borderSkipped: false,
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { stepSize: 1, precision: 0 },
                        grid: { color: '#f3f4f6' }
                    },
                    x: { grid: { display: false } }
                },
                plugins: { legend: { display: false } }
            }
        });
        @endunless
    </script>
    @endpush
</x-app-layout>
