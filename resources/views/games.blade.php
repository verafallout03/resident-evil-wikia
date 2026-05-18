<div>
    <div class="grid grid-cols-3 gap-6">
        @foreach($games as $g)
            <a href="{{ route('games-detail', $g->slug) }}" 
               class="block bg-white shadow rounded p-4 hover:shadow-lg transition">
                <img src="{{ $g->image }}" alt="{{ $g->name }}" class="w-full h-40 object-cover rounded">
                <h3 class="mt-2 text-lg font-bold">{{ $g->name }}</h3>
            </a>
        @endforeach
    </div>

    <div class="mt-4">
        {{ $games->links() }}
    </div>
</div>
