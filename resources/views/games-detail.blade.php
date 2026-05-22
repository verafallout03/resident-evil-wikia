<div class="mx-auto max-w-4xl">
    <a href="{{ route('games') }}" class="mb-4 inline-block text-sm text-gray-500 hover:underline">← Volver a juegos</a>

    <div class="overflow-hidden rounded-lg bg-white shadow">
        <div class="flex flex-col items-start gap-6 p-6 sm:flex-row">
            @if (!empty($game['cover_image']))
                <img src="{{ $game['cover_image'] }}" alt="{{ $game['title'] }}"
                     class="h-56 w-44 flex-shrink-0 rounded-lg object-cover shadow">
            @else
                <div class="flex h-56 w-44 flex-shrink-0 items-center justify-center rounded-lg bg-gray-200 text-5xl text-gray-400">🎮</div>
            @endif

            <div class="flex-1">
                <h1 class="text-3xl font-bold text-gray-900">{{ $game['title'] }}</h1>

                <div class="mt-4 grid grid-cols-2 gap-x-8 gap-y-2 text-sm text-gray-600">
                    <div><span class="font-medium">Año:</span> {{ $game['release_year'] ?? '—' }}</div>
                    <div><span class="font-medium">Plataforma:</span> {{ $game['platform'] ?? '—' }}</div>
                    <div><span class="font-medium">Desarrollador:</span> {{ $game['developer'] ?? '—' }}</div>
                    <div>
                        <span class="font-medium">Canon:</span>
                        {{ ['main' => 'Principal', 'spin-off' => 'Spin-off', 'remake' => 'Remake'][$game['canon']] ?? ucfirst($game['canon'] ?? '—') }}
                    </div>
                    <div><span class="font-medium">Publicado:</span> {{ $game['is_published'] ? 'Sí' : 'No' }}</div>
                </div>
            </div>
        </div>

        @if (!empty($game['synopsis']))
            <div class="border-t p-6">
                <h2 class="mb-2 text-lg font-semibold text-gray-800">Sinopsis</h2>
                <p class="leading-relaxed text-gray-700">{{ $game['synopsis'] }}</p>
            </div>
        @endif
    </div>
</div>
