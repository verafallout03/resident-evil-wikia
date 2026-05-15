<x-app-layout>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach($items as $item)
            <div class="bg-white shadow-md rounded-lg p-6 hover:shadow-lg transition">
                @if($item['image'])
                    <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" 
                         class="w-full h-40 object-cover rounded mb-4">
                @endif

                <h2 class="text-xl font-bold mb-2">{{ $item['name'] }}</h2>

                {{-- Mostrar etiqueta según tipo --}}
                <span class="inline-block px-2 py-1 text-xs rounded bg-gray-200 text-gray-700 mb-3">
                    {{ ucfirst($item['type']) }}
                </span>

                {{-- Botón dinámico según tipo --}}
                @if($item['type'] === 'character')
                    <a href="{{ route('characters.show', $item['slug']) }}" 
                       class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                       Ver personaje
                    </a>
                @elseif($item['type'] === 'location')
                    <a href="{{ route('locations.show', $item['slug']) }}" 
                       class="inline-block bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                       Ver locación
                    </a>
                @elseif($item['type'] === 'game')
                    <a href="{{ route('games.show', $item['slug']) }}" 
                       class="inline-block bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700">
                       Ver juego
                    </a>
                @endif
            </div>
        @endforeach
    </div>
</x-app-layout>
