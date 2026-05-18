<div class="max-w-4xl mx-auto bg-white shadow rounded p-6">
    <!-- Imagen y datos principales -->
    <div class="flex items-center space-x-6">
        <img src="{{ $location->image }}" 
             alt="{{ $location->name }}" 
             class="w-64 h-48 object-cover rounded-lg shadow">
        <div>
            <h1 class="text-3xl font-bold mb-2">{{ $location->name }}</h1>
            <p class="text-sm text-gray-500">Región: {{ $location->region ?? 'Desconocida' }}</p>
            <p class="text-sm text-gray-500">País: {{ $location->country ?? 'Desconocido' }}</p>
        </div>
    </div>

    <!-- Descripción -->
    <div class="mt-6">
        <h2 class="text-xl font-semibold mb-2">Descripción</h2>
        <p class="text-gray-700 leading-relaxed">
            {{ $location->description ?? 'Sin descripción disponible.' }}
        </p>
    </div>

    <!-- Sublocaciones -->
    @if($location->sublocations && $location->sublocations->count() > 0)
        <div class="mt-6">
            <h2 class="text-xl font-semibold mb-2">Sublocaciones</h2>
            <ul class="list-disc list-inside text-gray-700">
                @foreach($location->sublocations as $sub)
                    <li>
                        <a href="{{ route('locations.show', $sub->slug) }}" 
                           class="text-blue-600 hover:underline">
                           {{ $sub->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Datos adicionales -->
    <div class="mt-6 text-sm text-gray-400">
        <p>Publicado: {{ $location->is_published ? 'Sí' : 'No' }}</p>
        <p>Última actualización: {{ $location->updated_at->format('d/m/Y') }}</p>
    </div>
</div>
