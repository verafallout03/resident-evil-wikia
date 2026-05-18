<div>
    <div class="grid grid-cols-3 gap-6">
        @foreach($characters as $c)
            <a href="{{ route('characters-detail', $c->slug) }}" 
               class="block bg-white shadow rounded p-4 hover:shadow-lg transition">
                <img src="{{ $c->image }}" alt="{{ $c->name }}" class="w-full h-40 object-cover rounded">
                <h3 class="mt-2 text-lg font-bold">{{ $c->name }}</h3>
            </a>
        @endforeach
    </div>

    <div class="mt-4">
        {{ $characters->links() }}
    </div>
</div>
