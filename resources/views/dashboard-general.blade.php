<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <h1 class="col-span-full text-2xl font-bold mb-6">Dashboard General</h1>

    @foreach($items as $item)
        <div class="bg-white shadow-md rounded-lg p-6 hover:shadow-lg transition">
            {{-- Imagen --}}
            @if($item['image'])
                <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" 
                     class="w-full h-40 object-cover rounded mb-4">
            @endif

            {{-- Nombre --}}
            <h2 class="text-xl font-bold mb-2">{{ $item['name'] }}</h2>

            {{-- Etiqueta tipo --}}
            <span class="inline-block px-2 py-1 text-xs rounded bg-gray-200 text-gray-700 mb-3">
                {{ ucfirst($item['type']) }}
            </span>

            {{-- Botón placeholder sin ruta --}}
            <button class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Ver más
            </button>
        </div>
    @endforeach
</div>
