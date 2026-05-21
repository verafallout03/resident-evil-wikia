<div class="max-w-6xl mx-auto p-6">
    <div class="mb-6 flex justify-between items-center">
        <h1 class="text-4xl font-bold">Gestionar Juegos</h1>
        <button 
            wire:click="openCreateForm"
            class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
            ➕ Nuevo Juego
        </button>
    </div>
 
    <!-- Mensajes -->
    @if($successMessage)
        <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
            {{ $successMessage }}
        </div>
    @endif
 
    @if($errors && isset($errors['general']))
        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
            {{ $errors['general'] }}
        </div>
    @endif
 
    <!-- Formulario Modal -->
    @if($showForm)
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white rounded-lg p-8 w-full max-w-2xl max-h-[90vh] overflow-y-auto">
                <h2 class="text-2xl font-bold mb-6">
                    {{ $formMode === 'create' ? 'Crear Juego' : 'Editar Juego' }}
                </h2>
 
                <form wire:submit.prevent="save" class="space-y-4">
                    <!-- Title -->
                    <div>
                        <label class="block text-sm font-semibold mb-2">Título *</label>
                        <input 
                            type="text" 
                            wire:model="title"
                            class="w-full px-4 py-2 border rounded"
                            placeholder="Ej: Resident Evil 7">
                    </div>
 
                    <!-- Slug -->
                    <div>
                        <label class="block text-sm font-semibold mb-2">Slug *</label>
                        <input 
                            type="text" 
                            wire:model="slug"
                            class="w-full px-4 py-2 border rounded"
                            placeholder="Ej: resident-evil-7">
                    </div>
 
                    <!-- Cover Image -->
                    <div>
                        <label class="block text-sm font-semibold mb-2">URL Portada *</label>
                        <input 
                            type="url" 
                            wire:model="cover_image"
                            class="w-full px-4 py-2 border rounded"
                            placeholder="https://...">
                        @if($cover_image)
                            <img src="{{ $cover_image }}" alt="Preview" class="mt-2 h-40 rounded">
                        @endif
                    </div>
 
                    <div class="grid grid-cols-2 gap-4">
                        <!-- Release Year -->
                        <div>
                            <label class="block text-sm font-semibold mb-2">Año de Lanzamiento *</label>
                            <input 
                                type="number" 
                                wire:model="release_year"
                                class="w-full px-4 py-2 border rounded"
                                min="1996"
                                :max="new Date().getFullYear()">
                        </div>
 
                        <!-- Platform -->
                        <div>
                            <label class="block text-sm font-semibold mb-2">Plataforma *</label>
                            <select wire:model="platform" class="w-full px-4 py-2 border rounded">
                                <option value="PC">PC</option>
                                <option value="PlayStation">PlayStation</option>
                                <option value="Xbox">Xbox</option>
                                <option value="Nintendo">Nintendo</option>
                                <option value="Mobile">Mobile</option>
                            </select>
                        </div>
                    </div>
 
                    <div class="grid grid-cols-2 gap-4">
                        <!-- Developer -->
                        <div>
                            <label class="block text-sm font-semibold mb-2">Desarrollador *</label>
                            <input 
                                type="text" 
                                wire:model="developer"
                                class="w-full px-4 py-2 border rounded"
                                placeholder="Capcom">
                        </div>
 
                        <!-- Canon -->
                        <div>
                            <label class="block text-sm font-semibold mb-2">Tipo de Canon *</label>
                            <select wire:model="canon" class="w-full px-4 py-2 border rounded">
                                <option value="mainline">Principal</option>
                                <option value="spinoff">Spin-off</option>
                                <option value="remake">Remake</option>
                            </select>
                        </div>
                    </div>
 
                    <!-- Synopsis -->
                    <div>
                        <label class="block text-sm font-semibold mb-2">Sinopsis</label>
                        <textarea 
                            wire:model="synopsis"
                            class="w-full px-4 py-2 border rounded"
                            rows="4"
                            placeholder="Descripción del juego"
                            maxlength="2000"></textarea>
                        <p class="text-xs text-gray-500 mt-1">{{ strlen($synopsis) }}/2000</p>
                    </div>
 
                    <!-- Published -->
                    <div class="flex items-center gap-2">
                        <input 
                            type="checkbox" 
                            wire:model="is_published"
                            id="is_published"
                            class="w-4 h-4">
                        <label for="is_published" class="text-sm font-semibold">Publicado</label>
                    </div>
 
                    <!-- Botones -->
                    <div class="flex justify-end gap-4 mt-6">
                        <button 
                            type="button"
                            wire:click="closeForm"
                            class="px-6 py-2 bg-gray-400 text-white rounded hover:bg-gray-500 transition">
                            Cancelar
                        </button>
                        <button 
                            type="submit"
                            class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                            {{ $formMode === 'create' ? 'Crear' : 'Actualizar' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
 
    <!-- Tabla de Juegos -->
    <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-semibold">Título</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold">Año</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold">Plataforma</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold">Canon</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold">Estado</th>
                    <th class="px-6 py-3 text-center text-sm font-semibold">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($games as $game)
                    <tr class="border-t hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <img src="{{ $game['image'] }}" alt="{{ $game['name'] }}" class="w-10 h-10 rounded">
                                <span class="font-medium">{{ $game['name'] }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-gray-600">{{ $game['release_year'] ?? '-' }}</td>
                        <td class="px-6 py-4 text-gray-600">{{ $game['platform'] ?? '-' }}</td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 rounded text-sm bg-blue-100 text-blue-700">
                                {{ ucfirst($game['canon'] ?? '-') }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 rounded-full text-sm font-semibold
                                {{ $game['is_published'] ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                {{ $game['is_published'] ? '✓ Publicado' : '⏳ Borrador' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <button 
                                wire:click="openEditForm({{ json_encode($game) }})"
                                class="px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700 transition text-sm">
                                ✏️ Editar
                            </button>
                            <button 
                                wire:click="confirmDelete({{ json_encode($game) }})"
                                class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700 transition text-sm ml-2">
                                🗑️ Eliminar
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                            No hay juegos disponibles
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
 
    <!-- Paginación -->
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