<div class="mx-auto max-w-4xl">
    <a href="{{ route('locations') }}" class="mb-4 inline-block text-sm text-gray-500 hover:underline">← Volver a locaciones</a>

    <div class="overflow-hidden rounded-lg bg-white shadow">
        <div class="flex flex-col items-start gap-6 p-6 sm:flex-row">
            @if (!empty($location['image']))
                <img src="{{ $location['image'] }}" alt="{{ $location['name'] }}"
                     class="h-56 w-64 flex-shrink-0 rounded-lg object-cover shadow">
            @else
                <div class="flex h-56 w-64 flex-shrink-0 items-center justify-center rounded-lg bg-gray-200 text-5xl text-gray-400">📍</div>
            @endif

            <div class="flex-1">
                <h1 class="text-3xl font-bold text-gray-900">{{ $location['name'] }}</h1>

                <div class="mt-4 grid grid-cols-2 gap-x-8 gap-y-2 text-sm text-gray-600">
                    <div><span class="font-medium">Región:</span> {{ $location['region'] ?? '—' }}</div>
                    <div><span class="font-medium">País:</span> {{ $location['country'] ?? '—' }}</div>
                    <div><span class="font-medium">Publicado:</span> {{ $location['is_published'] ? 'Sí' : 'No' }}</div>
                </div>
            </div>
        </div>

        @if (!empty($location['description']))
            <div class="border-t p-6">
                <h2 class="mb-2 text-lg font-semibold text-gray-800">Descripción</h2>
                <p class="leading-relaxed text-gray-700">{{ $location['description'] }}</p>
            </div>
        @endif
    </div>
</div>
