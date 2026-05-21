<x-app-layout>
    <div class="mb-4 flex items-center justify-between">
        <h1 class="text-2xl font-bold">Nuevo juego</h1>
        <a href="{{ route('admin.games.index') }}" class="text-gray-500 hover:underline">← Volver</a>
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

    <form action="{{ route('admin.games.store') }}" method="POST"
          class="max-w-2xl space-y-4 rounded bg-white p-6 shadow">
        @csrf

        <div>
            <label class="mb-1 block text-sm font-medium">Título <span class="text-red-600">*</span></label>
            <input type="text" name="title" value="{{ old('title') }}"
                   class="w-full rounded border px-3 py-2 @error('title') border-red-500 @enderror">
            @error('title')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="mb-1 block text-sm font-medium">Slug <span class="text-red-600">*</span></label>
            <input type="text" name="slug" value="{{ old('slug') }}"
                   class="w-full rounded border px-3 py-2 @error('slug') border-red-500 @enderror">
            @error('slug')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="mb-1 block text-sm font-medium">Año de lanzamiento <span class="text-red-600">*</span></label>
                <input type="number" name="release_year" value="{{ old('release_year') }}"
                       min="1996" max="2100"
                       class="w-full rounded border px-3 py-2 @error('release_year') border-red-500 @enderror">
                @error('release_year')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="mb-1 block text-sm font-medium">Plataforma <span class="text-red-600">*</span></label>
                <input type="text" name="platform" value="{{ old('platform') }}"
                       class="w-full rounded border px-3 py-2 @error('platform') border-red-500 @enderror">
                @error('platform')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="mb-1 block text-sm font-medium">Desarrollador</label>
                <input type="text" name="developer" value="{{ old('developer', 'Capcom') }}"
                       class="w-full rounded border px-3 py-2">
            </div>
            <div>
                <label class="mb-1 block text-sm font-medium">Canon <span class="text-red-600">*</span></label>
                <select name="canon" class="w-full rounded border px-3 py-2 @error('canon') border-red-500 @enderror">
                    @foreach (['main' => 'Principal', 'spin-off' => 'Spin-off', 'remake' => 'Remake'] as $val => $label)
                        <option value="{{ $val }}" {{ old('canon') === $val ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @error('canon')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
            </div>
        </div>

        <div>
            <label class="mb-1 block text-sm font-medium">URL de portada</label>
            <input type="text" name="cover_image" value="{{ old('cover_image') }}"
                   class="w-full rounded border px-3 py-2">
        </div>

        <div>
            <label class="mb-1 block text-sm font-medium">Sinopsis</label>
            <textarea name="synopsis" rows="4"
                      class="w-full rounded border px-3 py-2">{{ old('synopsis') }}</textarea>
        </div>

        <div class="flex items-center gap-2">
            <input type="hidden" name="is_published" value="0">
            <input type="checkbox" name="is_published" id="is_published" value="1"
                   {{ old('is_published', true) ? 'checked' : '' }}>
            <label for="is_published" class="text-sm">Publicado</label>
        </div>

        <div class="flex justify-end gap-3 pt-2">
            <a href="{{ route('admin.games.index') }}"
               class="rounded border px-4 py-2 text-gray-600 hover:bg-gray-50">Cancelar</a>
            <button type="submit"
                    class="rounded bg-red-700 px-4 py-2 text-white hover:bg-red-800">Guardar</button>
        </div>
    </form>
</x-app-layout>
