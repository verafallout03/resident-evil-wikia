<x-app-layout>
    <div class="mb-4 flex items-center justify-between">
        <h1 class="text-2xl font-bold">Editar: {{ $character->name }}</h1>
        <a href="{{ route('admin.characters.index') }}" class="text-gray-500 hover:underline">← Volver</a>
    </div>

    @if ($errors->any())
        <div class="mb-4 rounded border border-red-400 bg-red-50 px-4 py-3 text-red-700">
            <ul class="list-disc pl-4 text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.characters.update', $character) }}" method="POST"
          class="max-w-2xl space-y-4 rounded bg-white p-6 shadow">
        @csrf @method('PUT')

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="mb-1 block text-sm font-medium">Nombre <span class="text-red-600">*</span></label>
                <input type="text" name="name" value="{{ old('name', $character->name) }}"
                       class="w-full rounded border px-3 py-2 @error('name') border-red-500 @enderror">
                @error('name')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="mb-1 block text-sm font-medium">Slug <span class="text-red-600">*</span></label>
                <input type="text" name="slug" value="{{ old('slug', $character->slug) }}"
                       class="w-full rounded border px-3 py-2 @error('slug') border-red-500 @enderror">
                @error('slug')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="mb-1 block text-sm font-medium">Alias</label>
                <input type="text" name="alias" value="{{ old('alias', $character->alias) }}"
                       class="w-full rounded border px-3 py-2">
            </div>
            <div>
                <label class="mb-1 block text-sm font-medium">Nacionalidad</label>
                <input type="text" name="nationality" value="{{ old('nationality', $character->nationality) }}"
                       class="w-full rounded border px-3 py-2">
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="mb-1 block text-sm font-medium">Facción</label>
                <select name="faction" class="w-full rounded border px-3 py-2">
                    <option value="">— Seleccionar —</option>
                    @foreach (['S.T.A.R.S.','B.S.A.A.','Umbrella','Neo-Umbrella','The Connections','Independent','Villain','Infected','Unknown'] as $f)
                        <option value="{{ $f }}"
                            {{ old('faction', $character->faction) === $f ? 'selected' : '' }}>{{ $f }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="mb-1 block text-sm font-medium">Estado</label>
                <select name="status" class="w-full rounded border px-3 py-2">
                    @foreach (['alive' => 'Vivo', 'deceased' => 'Fallecido', 'unknown' => 'Desconocido', 'mutated' => 'Mutado'] as $val => $label)
                        <option value="{{ $val }}"
                            {{ old('status', $character->status) === $val ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="grid grid-cols-3 gap-4">
            <div>
                <label class="mb-1 block text-sm font-medium">Tipo de sangre</label>
                <input type="text" name="blood_type" value="{{ old('blood_type', $character->blood_type) }}" maxlength="5"
                       class="w-full rounded border px-3 py-2">
            </div>
            <div>
                <label class="mb-1 block text-sm font-medium">Altura (cm)</label>
                <input type="number" name="height_cm" value="{{ old('height_cm', $character->height_cm) }}"
                       min="50" max="300"
                       class="w-full rounded border px-3 py-2 @error('height_cm') border-red-500 @enderror">
                @error('height_cm')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="mb-1 block text-sm font-medium">Fecha de nacimiento</label>
                <input type="date" name="birth_date" value="{{ old('birth_date', $character->birth_date?->format('Y-m-d')) }}"
                       class="w-full rounded border px-3 py-2 @error('birth_date') border-red-500 @enderror">
                @error('birth_date')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="mb-1 block text-sm font-medium">Juego</label>
                <select name="game_id" class="w-full rounded border px-3 py-2 @error('game_id') border-red-500 @enderror">
                    <option value="">— Ninguno —</option>
                    @foreach ($games as $game)
                        <option value="{{ $game->id }}"
                            {{ old('game_id', $character->game_id) == $game->id ? 'selected' : '' }}>
                            {{ $game->title }}
                        </option>
                    @endforeach
                </select>
                @error('game_id')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="mb-1 block text-sm font-medium">Locación</label>
                <select name="location_id" class="w-full rounded border px-3 py-2 @error('location_id') border-red-500 @enderror">
                    <option value="">— Ninguna —</option>
                    @foreach ($locations as $location)
                        <option value="{{ $location->id }}"
                            {{ old('location_id', $character->location_id) == $location->id ? 'selected' : '' }}>
                            {{ $location->name }}
                        </option>
                    @endforeach
                </select>
                @error('location_id')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
            </div>
        </div>

        <div>
            <label class="mb-1 block text-sm font-medium">URL de imagen</label>
            <input type="text" name="image" value="{{ old('image', $character->image) }}"
                   class="w-full rounded border px-3 py-2">
        </div>

        <div>
            <label class="mb-1 block text-sm font-medium">Descripción</label>
            <textarea name="description" rows="3"
                      class="w-full rounded border px-3 py-2">{{ old('description', $character->description) }}</textarea>
        </div>

        <div>
            <label class="mb-1 block text-sm font-medium">Lore</label>
            <textarea name="lore" rows="4"
                      class="w-full rounded border px-3 py-2">{{ old('lore', $character->lore) }}</textarea>
        </div>

        <div class="flex gap-6">
            <div class="flex items-center gap-2">
                <input type="hidden" name="is_playable" value="0">
                <input type="checkbox" name="is_playable" id="is_playable" value="1"
                       {{ old('is_playable', $character->is_playable) ? 'checked' : '' }}>
                <label for="is_playable" class="text-sm">Jugable</label>
            </div>
            <div class="flex items-center gap-2">
                <input type="hidden" name="is_published" value="0">
                <input type="checkbox" name="is_published" id="is_published" value="1"
                       {{ old('is_published', $character->is_published) ? 'checked' : '' }}>
                <label for="is_published" class="text-sm">Publicado</label>
            </div>
        </div>

        <div class="flex justify-end gap-3 pt-2">
            <a href="{{ route('admin.characters.index') }}"
               class="rounded border px-4 py-2 text-gray-600 hover:bg-gray-50">Cancelar</a>
            <button type="submit"
                    class="rounded bg-red-700 px-4 py-2 text-white hover:bg-red-800">Actualizar</button>
        </div>
    </form>
</x-app-layout>
