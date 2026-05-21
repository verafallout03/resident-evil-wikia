<x-app-layout>
    <div class="mb-4 flex items-center justify-between">
        <h1 class="text-2xl font-bold">Locaciones</h1>
        <a href="{{ route('admin.locations.create') }}"
           class="rounded bg-red-700 px-4 py-2 text-white hover:bg-red-800">
            + Nueva locación
        </a>
    </div>

    @if (session('success'))
        <div class="mb-4 rounded border border-green-400 bg-green-100 px-4 py-3 text-green-800">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="mb-4 rounded border border-red-400 bg-red-100 px-4 py-3 text-red-800">
            {{ session('error') }}
        </div>
    @endif

    <div class="overflow-x-auto rounded shadow">
        <table class="w-full bg-white text-sm">
            <thead class="bg-gray-100 text-left">
                <tr>
                    <th class="px-4 py-3">Nombre</th>
                    <th class="px-4 py-3">Región</th>
                    <th class="px-4 py-3">País</th>
                    <th class="px-4 py-3">Personajes</th>
                    <th class="px-4 py-3">Publicado</th>
                    <th class="px-4 py-3">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse ($locations as $location)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 font-medium">{{ $location->name }}</td>
                        <td class="px-4 py-3">{{ $location->region ?? '—' }}</td>
                        <td class="px-4 py-3">{{ $location->country ?? '—' }}</td>
                        <td class="px-4 py-3">{{ $location->characters_count }}</td>
                        <td class="px-4 py-3">
                            @if ($location->is_published)
                                <span class="rounded-full bg-green-100 px-2 py-0.5 text-xs text-green-700">Sí</span>
                            @else
                                <span class="rounded-full bg-gray-100 px-2 py-0.5 text-xs text-gray-500">No</span>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            <a href="{{ route('admin.locations.edit', $location) }}"
                               class="mr-2 text-blue-600 hover:underline">Editar</a>
                            <form action="{{ route('admin.locations.destroy', $location) }}"
                                  method="POST" class="inline"
                                  onsubmit="return confirm('¿Eliminar {{ addslashes($location->name) }}?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-6 text-center text-gray-500">No hay locaciones registradas.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $locations->links() }}
    </div>
</x-app-layout>
