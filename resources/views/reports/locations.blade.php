@extends('reports.layout')
@php $title = 'Reporte de Locaciones'; @endphp

@section('content')
<div class="content">

    @if (array_filter($filters))
        <div class="filters-bar">
            <strong>Filtros aplicados:</strong>
            @if (!empty($filters['country'])) País/Región: {{ $filters['country'] }} &nbsp;|&nbsp; @endif
            @if (!empty($filters['region']))  Región: {{ $filters['region'] }} @endif
        </div>
    @endif

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Región</th>
                <th>País</th>
                <th>Personajes</th>
                <th>Publicado</th>
                <th>Descripción</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($locations as $i => $loc)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td><strong>{{ $loc->name }}</strong></td>
                    <td>{{ $loc->region ?? '—' }}</td>
                    <td>{{ $loc->country ?? '—' }}</td>
                    <td style="text-align:center;">{{ $loc->characters_count }}</td>
                    <td>
                        <span class="badge {{ $loc->is_published ? 'badge-green' : 'badge-gray' }}">
                            {{ $loc->is_published ? 'Sí' : 'No' }}
                        </span>
                    </td>
                    <td style="font-size:9px; color:#6b7280;">
                        {{ Str::limit($loc->description, 80) }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align:center; padding:16px; color:#9ca3af;">
                        No se encontraron locaciones con los filtros seleccionados.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="summary">
        Total de locaciones: <strong>{{ $locations->count() }}</strong>
        &nbsp;&nbsp;|&nbsp;&nbsp;
        Total de personajes asociados: <strong>{{ $locations->sum('characters_count') }}</strong>
    </div>

</div>
@endsection
