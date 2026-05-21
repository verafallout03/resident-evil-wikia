<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{ $title ?? 'Reporte' }} — Resident Evil Wikia</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
            color: #1a1a1a;
            background: #fff;
        }

        /* ── Header ──────────────────────────────── */
        .header {
            background: #7f1d1d;
            color: #fff;
            padding: 14px 20px;
            margin-bottom: 16px;
        }
        .header-inner {
            display: table;
            width: 100%;
        }
        .header-logo {
            display: table-cell;
            vertical-align: middle;
            width: 50%;
        }
        .header-logo .system-name {
            font-size: 18px;
            font-weight: bold;
            letter-spacing: 1px;
        }
        .header-logo .system-sub {
            font-size: 10px;
            opacity: 0.85;
            margin-top: 2px;
        }
        .header-meta {
            display: table-cell;
            vertical-align: middle;
            text-align: right;
            width: 50%;
            font-size: 10px;
            opacity: 0.9;
        }

        /* ── Title block ─────────────────────────── */
        .report-title {
            font-size: 14px;
            font-weight: bold;
            color: #7f1d1d;
            padding: 0 20px 6px;
            border-bottom: 2px solid #7f1d1d;
            margin: 0 20px 12px;
        }

        /* ── Filters summary ─────────────────────── */
        .filters-bar {
            background: #fef2f2;
            border: 1px solid #fecaca;
            border-radius: 4px;
            padding: 6px 12px;
            margin: 0 20px 12px;
            font-size: 10px;
            color: #7f1d1d;
        }

        /* ── Table ───────────────────────────────── */
        .content {
            padding: 0 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        thead tr {
            background: #7f1d1d;
            color: #fff;
        }
        thead th {
            padding: 7px 8px;
            text-align: left;
            font-size: 10px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        tbody tr:nth-child(even) { background: #fef2f2; }
        tbody tr:nth-child(odd)  { background: #fff; }
        tbody td {
            padding: 6px 8px;
            border-bottom: 1px solid #e5e7eb;
            vertical-align: top;
        }
        .badge {
            display: inline-block;
            padding: 2px 6px;
            border-radius: 10px;
            font-size: 9px;
            font-weight: bold;
        }
        .badge-green  { background: #d1fae5; color: #065f46; }
        .badge-red    { background: #fee2e2; color: #991b1b; }
        .badge-gray   { background: #f3f4f6; color: #4b5563; }
        .badge-yellow { background: #fef3c7; color: #92400e; }

        /* ── Summary ─────────────────────────────── */
        .summary {
            margin: 12px 20px 0;
            font-size: 10px;
            color: #6b7280;
        }

        /* ── Footer ──────────────────────────────── */
        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: #f9fafb;
            border-top: 1px solid #e5e7eb;
            padding: 6px 20px;
            font-size: 9px;
            color: #9ca3af;
        }
        .footer-inner {
            display: table;
            width: 100%;
        }
        .footer-left  { display: table-cell; text-align: left; }
        .footer-right { display: table-cell; text-align: right; }

        /* DomPDF page counter */
        .page-number:after { content: counter(page); }
        .page-total:after  { content: counter(pages); }
    </style>
</head>
<body>

    {{-- Header --}}
    <div class="header">
        <div class="header-inner">
            <div class="header-logo">
                <div class="system-name">&#9760; Resident Evil Wikia</div>
                <div class="system-sub">Sistema de Gestión de Contenido</div>
            </div>
            <div class="header-meta">
                Generado: {{ now()->format('d/m/Y H:i') }}<br>
                Reporte: {{ $title ?? '—' }}
            </div>
        </div>
    </div>

    {{-- Footer (fixed) --}}
    <div class="footer">
        <div class="footer-inner">
            <div class="footer-left">Resident Evil Wikia &mdash; Reporte confidencial</div>
            <div class="footer-right">
                Página <span class="page-number"></span> de <span class="page-total"></span>
            </div>
        </div>
    </div>

    {{-- Page content --}}
    <div class="report-title">{{ $title ?? 'Reporte' }}</div>

    @yield('content')

</body>
</html>
