<div>
    <h1 class="text-3xl font-bold mb-6">Dashboard General</h1>
    
    <div class="grid grid-cols-3 gap-6">
        @forelse($items as $item)
            <div class="bg-white shadow rounded p-4 hover:shadow-lg transition cursor-pointer"
                 onclick="window.location.href='{{ 
                    $item['type'] === 'character' ? route('characters-detail', $item['slug']) :
                    ($item['type'] === 'game' ? route('games-detail', $item['slug']) :
                    route('locations-detail', $item['slug']))
                 }}'">
                <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" class="w-full h-40 object-cover rounded">
                <h3 class="mt-2 text-lg font-bold">{{ $item['name'] }}</h3>
                <span class="text-sm text-gray-500">
                    @if($item['type'] === 'character')
                        👤 Personaje
                    @elseif($item['type'] === 'game')
                        🎮 Juego
                    @else
                        📍 Locación
                    @endif
                </span>
            </div>
        @empty
            <div class="col-span-3 text-center py-12">
                <p class="text-gray-500 text-lg">No hay elementos disponibles</p>
            </div>
        @endforelse
    </div>
 
    <!-- Paginación manual -->
    <div class="mt-8 flex items-center justify-center gap-4">
        <button 
            wire:click="prevPage" 
            @disabled($pagination['current_page'] <= 1)
            class="px-4 py-2 bg-blue-600 text-white rounded disabled:bg-gray-400 disabled:cursor-not-allowed hover:bg-blue-700 transition">
            ← Anterior
        </button>
 
        <span class="text-gray-600">
            Página <strong>{{ $pagination['current_page'] }}</strong> de <strong>{{ $pagination['last_page'] }}</strong>
        </span>
 
        <button 
            wire:click="nextPage" 
            @disabled($pagination['current_page'] >= $pagination['last_page'])
            class="px-4 py-2 bg-blue-600 text-white rounded disabled:bg-gray-400 disabled:cursor-not-allowed hover:bg-blue-700 transition">
            Siguiente →
        </button>
    </div>
</div>