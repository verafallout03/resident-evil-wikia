<x-app-layout>
    <div class="mb-6">

        {{-- Header --}}
        <div class="flex items-center gap-3 mb-6">
            <span class="bg-gray-700 text-white text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wide">
                Editor
            </span>
            <h1 class="text-2xl font-bold text-gray-800">Panel de Editor</h1>
        </div>

        {{-- Stat Cards --}}
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
            <div class="bg-white rounded-lg shadow p-5 border-l-4 border-gray-700">
                <p class="text-sm text-gray-500 mb-1">Personajes publicados</p>
                <p class="text-3xl font-bold text-gray-800">{{ $stats['published_characters'] }}</p>
            </div>
            <div class="bg-white rounded-lg shadow p-5 border-l-4 border-gray-700">
                <p class="text-sm text-gray-500 mb-1">Juegos publicados</p>
                <p class="text-3xl font-bold text-gray-800">{{ $stats['published_games'] }}</p>
            </div>
            <div class="bg-white rounded-lg shadow p-5 border-l-4 border-gray-700">
                <p class="text-sm text-gray-500 mb-1">Locaciones publicadas</p>
                <p class="text-3xl font-bold text-gray-800">{{ $stats['published_locations'] }}</p>
            </div>
            <div class="bg-white rounded-lg shadow p-5 border-l-4 border-gray-700">
                <p class="text-sm text-gray-500 mb-1">Personajes jugables</p>
                <p class="text-3xl font-bold text-gray-800">{{ $stats['playable_characters'] }}</p>
            </div>
        </div>

        {{-- Charts --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            {{-- Donut: Personajes por Estado --}}
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-lg font-semibold text-gray-700 mb-4">Personajes por Estado</h2>
                @if($statusData->isEmpty())
                    <p class="text-gray-400 text-sm">Sin datos disponibles.</p>
                @else
                    <div class="flex justify-center">
                        <canvas id="statusChart" style="max-height:300px;"></canvas>
                    </div>
                @endif
            </div>

            {{-- Horizontal Bar: Locaciones por País --}}
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-lg font-semibold text-gray-700 mb-4">Locaciones por País (Top 8)</h2>
                @if($locationsByCountry->isEmpty())
                    <p class="text-gray-400 text-sm">Sin datos disponibles.</p>
                @else
                    <canvas id="locationsChart" style="max-height:300px;"></canvas>
                @endif
            </div>

        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <script>
        const STATUS_COLORS = {
            alive:    '#15803d',
            deceased: '#991b1b',
            unknown:  '#6b7280',
            mutated:  '#7c3aed',
        };

        @unless($statusData->isEmpty())
        const statusLabels = @json($statusData->pluck('status'));
        new Chart(document.getElementById('statusChart'), {
            type: 'doughnut',
            data: {
                labels: statusLabels,
                datasets: [{
                    data: @json($statusData->pluck('total')),
                    backgroundColor: statusLabels.map(s => STATUS_COLORS[s] ?? '#9ca3af'),
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

        @unless($locationsByCountry->isEmpty())
        new Chart(document.getElementById('locationsChart'), {
            type: 'bar',
            data: {
                labels: @json($locationsByCountry->pluck('country')),
                datasets: [{
                    label: 'Locaciones',
                    data: @json($locationsByCountry->pluck('total')),
                    backgroundColor: '#374151',
                    borderRadius: 4,
                    borderSkipped: false,
                }]
            },
            options: {
                indexAxis: 'y',
                responsive: true,
                scales: {
                    x: {
                        beginAtZero: true,
                        ticks: { stepSize: 1, precision: 0 },
                        grid: { color: '#f3f4f6' }
                    },
                    y: { grid: { display: false } }
                },
                plugins: { legend: { display: false } }
            }
        });
        @endunless
    </script>
    @endpush
</x-app-layout>
