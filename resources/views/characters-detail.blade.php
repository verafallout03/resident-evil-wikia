<div class="mx-auto max-w-4xl">
    <a href="{{ route('characters') }}" class="mb-4 inline-block text-sm text-gray-500 hover:underline">← Volver a personajes</a>

    <div class="overflow-hidden rounded-lg bg-white shadow">
        <div class="flex flex-col items-start gap-6 p-6 sm:flex-row">
            @if (!empty($character['image']))
                <img src="{{ $character['image'] }}" alt="{{ $character['name'] }}"
                     class="h-56 w-44 flex-shrink-0 rounded-lg object-cover shadow">
            @else
                <div class="flex h-56 w-44 flex-shrink-0 items-center justify-center rounded-lg bg-gray-200 text-5xl text-gray-400">?</div>
            @endif

            <div class="flex-1">
                <h1 class="text-3xl font-bold text-gray-900">{{ $character['name'] }}</h1>

                @if (!empty($character['alias']))
                    <p class="mt-1 italic text-gray-500">"{{ $character['alias'] }}"</p>
                @endif

                <div class="mt-4 grid grid-cols-2 gap-x-8 gap-y-2 text-sm text-gray-600">
                    <div><span class="font-medium">Estado:</span> {{ ucfirst($character['status'] ?? 'Desconocido') }}</div>
                    <div><span class="font-medium">Facción:</span> {{ $character['faction'] ?? '—' }}</div>
                    <div><span class="font-medium">Nacionalidad:</span> {{ $character['nationality'] ?? '—' }}</div>
                    <div><span class="font-medium">Tipo de sangre:</span> {{ $character['blood_type'] ?? '—' }}</div>
                    <div><span class="font-medium">Altura:</span> {{ $character['height_cm'] ? $character['height_cm'] . ' cm' : '—' }}</div>
                    <div><span class="font-medium">Nacimiento:</span> {{ $character['birth_date'] ?? '—' }}</div>
                    <div><span class="font-medium">Jugable:</span> {{ $character['is_playable'] ? 'Sí' : 'No' }}</div>
                </div>
            </div>
        </div>

        @if (!empty($character['description']))
            <div class="border-t p-6">
                <h2 class="mb-2 text-lg font-semibold text-gray-800">Descripción</h2>
                <p class="leading-relaxed text-gray-700">{{ $character['description'] }}</p>
            </div>
        @endif

        @if (!empty($character['lore']))
            <div class="border-t p-6">
                <h2 class="mb-2 text-lg font-semibold text-gray-800">Lore</h2>
                <p class="leading-relaxed text-gray-700">{{ $character['lore'] }}</p>
            </div>
        @endif
    </div>
</div>
