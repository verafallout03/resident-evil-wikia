@extends('reports.layout')
@php $title = 'Reporte de Personajes'; @endphp

@section('content')
<div class="content">

    @if (array_filter($filters))
        <div class="filters-bar">
            <strong>Filtros aplicados:</strong>
            @if (!empty($filters['faction']))   Facción: {{ $filters['faction'] }} &nbsp;|&nbsp; @endif
            @if (!empty($filters['status']))    Estado: {{ ucfirst($filters['status']) }} &nbsp;|&nbsp; @endif
            @if (!empty($filters['game_id']))   Juego: {{ $games->firstWhere('id', $filters['game_id'])?->title }} &nbsp;|&nbsp; @endif
            @if (isset($filters['is_playable'])) Jugable: {{ $filters['is_playable'] ? 'Sí' : 'No' }} @endif
        </div>
    @endif

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Alias</th>
                <th>Facción</th>
                <th>Estado</th>
                <th>Juego</th>
                <th>Locación</th>
                <th>Jugable</th>
                <th>Publicado</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($characters as $i => $c)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td><strong>{{ $c->name }}</strong></td>
                    <td>{{ $c->alias ?? '—' }}</td>
                    <td>{{ $c->faction ?? '—' }}</td>
                    <td>
                        @php
                            $statusMap = [
                                'alive'    => ['label' => 'Vivo',        'class' => 'badge-green'],
                                'deceased' => ['label' => 'Fallecido',   'class' => 'badge-red'],
                                'mutated'  => ['label' => 'Mutado',      'class' => 'badge-yellow'],
                                'unknown'  => ['label' => 'Desconocido', 'class' => 'badge-gray'],
                            ];
                            $s = $statusMap[$c->status] ?? ['label' => $c->status, 'class' => 'badge-gray'];
                        @endphp
                        <span class="badge {{ $s['class'] }}">{{ $s['label'] }}</span>
                    </td>
                    <td>{{ $c->game?->title ?? '—' }}</td>
                    <td>{{ $c->location?->name ?? '—' }}</td>
                    <td>{{ $c->is_playable ? 'Sí' : 'No' }}</td>
                    <td>
                        <span class="badge {{ $c->is_published ? 'badge-green' : 'badge-gray' }}">
                            {{ $c->is_published ? 'Sí' : 'No' }}
                        </span>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" style="text-align:center; padding:16px; color:#9ca3af;">
                        No se encontraron personajes con los filtros seleccionados.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="summary">
        Total de personajes: <strong>{{ $characters->count() }}</strong>
    </div>

</div>
@endsection
