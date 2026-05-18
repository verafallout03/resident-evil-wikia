<div class="max-w-4xl mx-auto bg-white shadow rounded p-6">
    <!-- Portada y datos principales -->
    <div class="flex items-center space-x-6">
        <img src="{{ $game->cover_image }}" 
             alt="{{ $game->title }}" 
             class="w-64 h-48 object-cover rounded-lg shadow">
        <div>
            <h1 class="text-3xl font-bold mb-2">{{ $game->title }}</h1>
            <p class="text-sm text-gray-500">Año de lanzamiento: {{ $game->release_year }}</p>
            <p class="text-sm text-gray-500">Plataforma: {{ $game->platform }}</p>
            <p class="text-sm text-gray-500">Desarrollador: {{ $game->developer }}</p>
        </div>
    </div>

    <!-- Sinopsis -->
    <div class="mt-6">
        <h2 class="text-xl font-semibold mb-2">Sinopsis</h2>
        <p class="text-gray-700 leading-relaxed">
            {{ $game->synopsis ?? 'Sin sinopsis disponible.' }}
        </p>
    </div>

    <!-- Tipo de canon -->
    <div class="mt-6">
        <h2 class="text-xl font-semibold mb-2">Canon</h2>
        <p class="text-gray-700">
            {{ ucfirst($game->canon) }}
        </p>
    </div>

    <!-- Estado de publicación -->
    <div class="mt-6 text-sm text-gray-400">
        <p>Publicado: {{ $game->is_published ? 'Sí' : 'No' }}</p>
        <p>Última actualización: {{ $game->updated_at->format('d/m/Y') }}</p>
    </div>
</div>
