<div>
    <div class="grid grid-cols-3 gap-6">
        @forelse($characters as $c)
            <a href="{{ route('characters-detail', $c['slug']) }}" 
               class="block bg-white shadow rounded p-4 hover:shadow-lg transition">
                <img src="{{ $c['image'] }}" alt="{{ $c['name'] }}" class="w-full h-40 object-cover rounded">
                <h3 class="mt-2 text-lg font-bold">{{ $c['name'] }}</h3>
            </a>
        @empty
            <div class="col-span-3 text-center py-12">
                <p class="text-gray-500">No hay personajes disponibles</p>
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