<div>
    <div class="grid grid-cols-3 gap-6">
        @foreach($locations as $l)
            <a href="{{ route('locations-detail', $l->slug) }}" 
               class="block bg-white shadow rounded p-4 hover:shadow-lg transition">
                <img src="{{ $l->image }}" alt="{{ $l->name }}" class="w-full h-40 object-cover rounded">
                <h3 class="mt-2 text-lg font-bold">{{ $l->name }}</h3>
            </a>
        @endforeach
    </div>

    <div class="mt-4">
        {{ $locations->links() }}
    </div>
</div>
