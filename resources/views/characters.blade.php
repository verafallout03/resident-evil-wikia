<div>
    <div class="grid grid-cols-3 gap-6">
        @foreach($characters as $c)
            <div class="bg-white shadow rounded p-4">
                <img src="{{ $c->image }}" alt="{{ $c->name }}" class="w-full h-40 object-cover rounded">
                <h3 class="mt-2 text-lg font-bold">{{ $c->name }}</h3>
            </div>
        @endforeach
    </div>
    <div class="mt-4">
        {{ $characters->links() }}
    </div>
</div>