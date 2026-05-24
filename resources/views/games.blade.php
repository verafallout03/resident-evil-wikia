<div>
    <div class="mb-6 flex items-center justify-between">
        <h1 class="text-2xl font-bold text-gray-800">Juegos</h1>
        <span class="text-sm text-gray-500">Página {{ $pagination['current_page'] }} de {{ $pagination['last_page'] }}</span>
    </div>

    <div class="grid grid-cols-2 gap-6 sm:grid-cols-3 lg:grid-cols-4">
        @forelse ($games as $g)
            <a href="{{ route('games-detail', $g['slug']) }}"
               class="group block overflow-hidden rounded-lg bg-white shadow hover:shadow-lg transition">
                @if (!empty($g['cover_image']))
                    <img src="{{ $g['cover_image'] }}" alt="{{ $g['title'] }}"
                         class="h-48 w-full object-cover group-hover:opacity-90 transition">
                @else
                    <div class="flex h-48 w-full items-center justify-center bg-gray-200 text-gray-400 text-4xl">🎮</div>
                @endif
                <div class="p-3">
                    <h3 class="font-semibold text-gray-800 truncate">{{ $g['title'] }}</h3>
                </div>
            </a>
        @empty
            <div class="col-span-4 py-16 text-center text-gray-400">
                <p class="text-lg">No hay juegos disponibles.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-8 flex items-center justify-center gap-4">
        <button wire:click="prevPage"
                @disabled($pagination['current_page'] <= 1)
                class="rounded bg-red-700 px-4 py-2 text-sm text-white hover:bg-red-800 disabled:cursor-not-allowed disabled:bg-gray-300 transition">
            ← Anterior
        </button>
        <span class="text-sm text-gray-600">
            Página <strong>{{ $pagination['current_page'] }}</strong> de <strong>{{ $pagination['last_page'] }}</strong>
        </span>
        <button wire:click="nextPage"
                @disabled($pagination['current_page'] >= $pagination['last_page'])
                class="rounded bg-red-700 px-4 py-2 text-sm text-white hover:bg-red-800 disabled:cursor-not-allowed disabled:bg-gray-300 transition">
            Siguiente →
        </button>
    </div>
</div>
