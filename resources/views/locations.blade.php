<div>
    <div class="grid grid-cols-3 gap-6">
        @foreach($locations as $l)
            <div class="bg-white shadow rounded p-4">
                <img src="{{ $l->image }}" alt="{{ $l->name }}" class="w-full h-40 object-cover rounded">
                <h3 class="mt-2 text-lg font-bold">{{ $l->name }}</h3>
            </div>
        @endforeach
    </div>
    <div class="mt-4">
        {{ $locations->links() }}
    </div>
</div>
