<div class="max-w-4xl mx-auto bg-white shadow rounded p-6">
    <!-- Imagen y datos principales -->
    <div class="flex items-center space-x-6">
        <img src="{{ $character['image'] }}" 
             alt="{{ $character['name'] }}" 
             class="w-48 h-48 object-cover rounded-lg shadow">
        <div>
            <h1 class="text-3xl font-bold mb-2">{{ $character['name'] }}</h1>
            
            @if($character['alias'] ?? false)
                <p class="text-gray-600 italic">Alias: {{ $character['alias'] }}</p>
            @endif
            
            <p class="text-sm text-gray-500">Nacionalidad: {{ $character['nationality'] ?? 'Desconocida' }}</p>
            <p class="text-sm text-gray-500">Estado: {{ $character['status'] ?? 'Desconocido' }}</p>
        </div>
    </div>
 
    <!-- Descripción -->
    <div class="mt-6">
        <h2 class="text-xl font-semibold mb-2">Descripción</h2>
        <p class="text-gray-700 leading-relaxed">
            {{ $character['description'] ?? 'Sin descripción disponible.' }}
        </p>
    </div>
 
    <!-- Lore -->
    <div class="mt-6">
        <h2 class="text-xl font-semibold mb-2">Lore</h2>
        <p class="text-gray-700 leading-relaxed">
            {{ $character['lore'] ?? 'Sin lore disponible.' }}
        </p>
    </div>
 
    <!-- Datos adicionales -->
    <div class="mt-6 text-sm text-gray-400">
        <p>Fecha de nacimiento: {{ $character['birth_date'] ?? 'N/A' }}</p>
        <p>Altura: {{ $character['height_cm'] ? $character['height_cm'] . ' cm' : 'N/A' }}</p>
        <p>Tipo de sangre: {{ $character['blood_type'] ?? 'N/A' }}</p>
    </div>
 
    <!-- Botón volver -->
    <div class="mt-8">
        <a href="{{ route('characters') }}" class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700 transition">
            ← Volver a personajes
        </a>
    </div>
</div>