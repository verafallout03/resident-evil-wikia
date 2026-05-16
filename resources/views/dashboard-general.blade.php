<div>
    <div class="grid grid-cols-3 gap-6">
        @foreach($items as $item)
            <div class="bg-white shadow rounded p-4">
                <img src="{{ $item->image }}" alt="{{ $item->name }}" class="w-full h-40 object-cover rounded">
                <h3 class="mt-2 text-lg font-bold">{{ $item->name }}</h3>
                <span class="text-sm text-gray-500">{{ ucfirst($item->type) }}</span>
            </div>
        @endforeach
    </div>

    <div class="mt-4">
        {{ $items->links() }} {{-- Paginación unificada --}}
    </div>
</div>