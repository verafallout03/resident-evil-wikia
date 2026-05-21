@extends('reports.layout')
@php $title = 'Reporte de Juegos'; @endphp

@section('content')
<div class="content">

    @if (array_filter($filters))
        <div class="filters-bar">
            <strong>Filtros aplicados:</strong>
            @if (!empty($filters['canon']))     Canon: {{ ucfirst($filters['canon']) }} &nbsp;|&nbsp; @endif
            @if (!empty($filters['year_from'])) Desde: {{ $filters['year_from'] }} &nbsp;|&nbsp; @endif
            @if (!empty($filters['year_to']))   Hasta: {{ $filters['year_to'] }} @endif
        </div>
    @endif

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Título</th>
                <th>Año</th>
                <th>Plataforma</th>
                <th>Desarrollador</th>
                <th>Canon</th>
                <th>Personajes</th>
                <th>Publicado</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($games as $i => $game)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td><strong>{{ $game->title }}</strong></td>
                    <td>{{ $game->release_year }}</td>
                    <td>{{ $game->platform }}</td>
                    <td>{{ $game->developer }}</td>
                    <td>
                        @php
                            $canonMap = [
                                'main'     => ['label' => 'Principal', 'class' => 'badge-green'],
                                'spin-off' => ['label' => 'Spin-off',  'class' => 'badge-yellow'],
                                'remake'   => ['label' => 'Remake',    'class' => 'badge-gray'],
                            ];
                            $cm = $canonMap[$game->canon] ?? ['label' => $game->canon, 'class' => 'badge-gray'];
                        @endphp
                        <span class="badge {{ $cm['class'] }}">{{ $cm['label'] }}</span>
                    </td>
                    <td style="text-align:center;">{{ $game->characters_count }}</td>
                    <td>
                        <span class="badge {{ $game->is_published ? 'badge-green' : 'badge-gray' }}">
                            {{ $game->is_published ? 'Sí' : 'No' }}
                        </span>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" style="text-align:center; padding:16px; color:#9ca3af;">
                        No se encontraron juegos con los filtros seleccionados.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="summary">
        Total de juegos: <strong>{{ $games->count() }}</strong>
        &nbsp;&nbsp;|&nbsp;&nbsp;
        Total de personajes asociados: <strong>{{ $games->sum('characters_count') }}</strong>
    </div>

</div>
@endsection
