<x-app-layout>
    <div class="mb-4 flex items-center justify-between">
        <h1 class="text-2xl font-bold">Nueva locación</h1>
        <a href="{{ route('admin.locations.index') }}" class="text-gray-500 hover:underline">← Volver</a>
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

    <form action="{{ route('admin.locations.store') }}" method="POST"
          class="max-w-2xl space-y-4 rounded bg-white p-6 shadow">
        @csrf

        <div>
            <label class="mb-1 block text-sm font-medium">Nombre <span class="text-red-600">*</span></label>
            <input type="text" name="name" value="{{ old('name') }}"
                   class="w-full rounded border px-3 py-2 @error('name') border-red-500 @enderror">
            @error('name')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="mb-1 block text-sm font-medium">Slug <span class="text-red-600">*</span></label>
            <input type="text" name="slug" value="{{ old('slug') }}"
                   class="w-full rounded border px-3 py-2 @error('slug') border-red-500 @enderror">
            @error('slug')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="mb-1 block text-sm font-medium">Región</label>
                <input type="text" name="region" value="{{ old('region') }}"
                       class="w-full rounded border px-3 py-2">
            </div>
            <div>
                <label class="mb-1 block text-sm font-medium">País</label>
                <input type="text" name="country" value="{{ old('country') }}"
                       class="w-full rounded border px-3 py-2">
            </div>
        </div>

        <div>
            <label class="mb-1 block text-sm font-medium">URL de imagen</label>
            <input type="text" name="image" value="{{ old('image') }}"
                   class="w-full rounded border px-3 py-2">
        </div>

        <div>
            <label class="mb-1 block text-sm font-medium">Descripción</label>
            <textarea name="description" rows="4"
                      class="w-full rounded border px-3 py-2">{{ old('description') }}</textarea>
        </div>

        <div class="flex items-center gap-2">
            <input type="hidden" name="is_published" value="0">
            <input type="checkbox" name="is_published" id="is_published" value="1"
                   {{ old('is_published', true) ? 'checked' : '' }}>
            <label for="is_published" class="text-sm">Publicado</label>
        </div>

        <div class="flex justify-end gap-3 pt-2">
            <a href="{{ route('admin.locations.index') }}"
               class="rounded border px-4 py-2 text-gray-600 hover:bg-gray-50">Cancelar</a>
            <button type="submit"
                    class="rounded bg-red-700 px-4 py-2 text-white hover:bg-red-800">Guardar</button>
        </div>
    </form>
</x-app-layout>
