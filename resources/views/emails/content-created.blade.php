<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo contenido creado</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { background-color: #111827; font-family: 'Segoe UI', Arial, sans-serif; color: #f3f4f6; }
        .wrapper { max-width: 600px; margin: 40px auto; background: #1f2937; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 24px rgba(0,0,0,0.5); }
        .header { background: #7f1d1d; padding: 32px 40px; text-align: center; }
        .header h1 { font-size: 24px; font-weight: 800; color: #fff; letter-spacing: 1px; }
        .header p { color: #fca5a5; font-size: 12px; margin-top: 6px; letter-spacing: 2px; text-transform: uppercase; }
        .badge { display: inline-block; background: #450a0a; color: #fca5a5; border: 1px solid #b91c1c; border-radius: 20px; padding: 4px 14px; font-size: 12px; font-weight: 600; margin-top: 10px; text-transform: uppercase; letter-spacing: 1px; }
        .body { padding: 36px 40px; }
        .body p { color: #d1d5db; line-height: 1.7; font-size: 15px; margin-bottom: 14px; }
        .divider { border: none; border-top: 1px solid #374151; margin: 24px 0; }
        .info-box { background: #111827; border-left: 4px solid #b91c1c; border-radius: 4px; padding: 16px 20px; margin: 20px 0; }
        .info-box .row { display: flex; justify-content: space-between; padding: 6px 0; border-bottom: 1px solid #1f2937; font-size: 14px; }
        .info-box .row:last-child { border-bottom: none; }
        .info-box .label { color: #9ca3af; }
        .info-box .value { color: #f87171; font-weight: 600; }
        .btn-wrap { text-align: center; margin: 28px 0; }
        .btn { display: inline-block; background: #b91c1c; color: #fff; text-decoration: none; padding: 13px 32px; border-radius: 6px; font-weight: 700; font-size: 15px; }
        .footer { background: #111827; padding: 20px 40px; text-align: center; }
        .footer p { color: #4b5563; font-size: 12px; }
        .skull { font-size: 28px; margin-bottom: 8px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <!-- Header -->
        <div class="header">
            <div class="skull">☠</div>
            <h1>Resident Evil Wikia</h1>
            <p>Notificación de Sistema</p>
            @php
                $labels = ['character' => 'Personaje', 'game' => 'Juego', 'location' => 'Locación'];
                $icons  = ['character' => '👤', 'game' => '🎮', 'location' => '📍'];
            @endphp
            <span class="badge">
                {{ $icons[$type] ?? '' }} Nuevo {{ $labels[$type] ?? $type }}
            </span>
        </div>

        <!-- Body -->
        <div class="body">
            <p>
                Se ha registrado nuevo contenido en <strong style="color:#f87171">Resident Evil Wikia</strong>.
                A continuación los detalles:
            </p>

            <div class="info-box">
                <div class="row">
                    <span class="label">Tipo</span>
                    <span class="value">{{ $labels[$type] ?? ucfirst($type) }}</span>
                </div>
                <div class="row">
                    <span class="label">Nombre</span>
                    <span class="value">{{ $name }}</span>
                </div>
                <div class="row">
                    <span class="label">Creado por</span>
                    <span class="value">{{ $createdBy }}</span>
                </div>
                <div class="row">
                    <span class="label">Fecha</span>
                    <span class="value">{{ now()->format('d/m/Y H:i') }}</span>
                </div>
            </div>

            <p>
                Puedes revisar y editar este registro desde el panel de administración.
            </p>

            <div class="btn-wrap">
                @php
                    $adminRoutes = [
                        'character' => 'admin.characters.index',
                        'game'      => 'admin.games.index',
                        'location'  => 'admin.locations.index',
                    ];
                @endphp
                <a href="{{ config('app.url') }}/admin/{{ $type === 'character' ? 'characters' : ($type === 'game' ? 'games' : 'locations') }}" class="btn">
                    Ver en Administración
                </a>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>© {{ date('Y') }} Resident Evil Wikia — Notificación automática del sistema.</p>
            <p style="margin-top:4px">Solo los administradores reciben este correo.</p>
        </div>
    </div>
</body>
</html>
