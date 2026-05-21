<x-app-layout>
    <div class="mb-4 flex items-center justify-between">
        <h1 class="text-2xl font-bold">Juegos</h1>
        <a href="{{ route('admin.games.create') }}"
           class="rounded bg-red-700 px-4 py-2 text-white hover:bg-red-800">
            + Nuevo juego
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
                    <th class="px-4 py-3">Título</th>
                    <th class="px-4 py-3">Año</th>
                    <th class="px-4 py-3">Plataforma</th>
                    <th class="px-4 py-3">Canon</th>
                    <th class="px-4 py-3">Publicado</th>
                    <th class="px-4 py-3">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse ($games as $game)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 font-medium">{{ $game->title }}</td>
                        <td class="px-4 py-3">{{ $game->release_year }}</td>
                        <td class="px-4 py-3">{{ $game->platform }}</td>
                        <td class="px-4 py-3 capitalize">{{ $game->canon }}</td>
                        <td class="px-4 py-3">
                            @if ($game->is_published)
                                <span class="rounded-full bg-green-100 px-2 py-0.5 text-xs text-green-700">Sí</span>
                            @else
                                <span class="rounded-full bg-gray-100 px-2 py-0.5 text-xs text-gray-500">No</span>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            <a href="{{ route('admin.games.edit', $game) }}"
                               class="mr-2 text-blue-600 hover:underline">Editar</a>
                            <form action="{{ route('admin.games.destroy', $game) }}"
                                  method="POST" class="inline"
                                  onsubmit="return confirm('¿Eliminar {{ addslashes($game->title) }}?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-6 text-center text-gray-500">No hay juegos registrados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $games->links() }}
    </div>
</x-app-layout>
