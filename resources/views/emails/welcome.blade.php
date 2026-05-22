<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>¡Bienvenido a Resident Evil Wikia!</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { background-color: #111827; font-family: 'Segoe UI', Arial, sans-serif; color: #f3f4f6; }
        .wrapper { max-width: 600px; margin: 40px auto; background: #1f2937; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 24px rgba(0,0,0,0.5); }
        .header { background: #7f1d1d; padding: 32px 40px; text-align: center; }
        .header h1 { font-size: 26px; font-weight: 800; color: #fff; letter-spacing: 1px; }
        .header p { color: #fca5a5; font-size: 13px; margin-top: 6px; letter-spacing: 2px; text-transform: uppercase; }
        .body { padding: 36px 40px; }
        .greeting { font-size: 20px; font-weight: 700; color: #f87171; margin-bottom: 16px; }
        .body p { color: #d1d5db; line-height: 1.7; font-size: 15px; margin-bottom: 14px; }
        .divider { border: none; border-top: 1px solid #374151; margin: 24px 0; }
        .info-box { background: #111827; border-left: 4px solid #b91c1c; border-radius: 4px; padding: 16px 20px; margin: 20px 0; }
        .info-box p { margin: 0; color: #9ca3af; font-size: 14px; }
        .info-box strong { color: #f87171; }
        .btn-wrap { text-align: center; margin: 28px 0; }
        .btn { display: inline-block; background: #b91c1c; color: #fff; text-decoration: none; padding: 13px 32px; border-radius: 6px; font-weight: 700; font-size: 15px; letter-spacing: 0.5px; }
        .btn:hover { background: #991b1b; }
        .footer { background: #111827; padding: 20px 40px; text-align: center; }
        .footer p { color: #4b5563; font-size: 12px; }
        .skull { font-size: 32px; margin-bottom: 8px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <!-- Header -->
        <div class="header">
            <div class="skull">☠</div>
            <h1>Resident Evil Wikia</h1>
            <p>Sistema de Gestión de Contenido</p>
        </div>

        <!-- Body -->
        <div class="body">
            <p class="greeting">¡Bienvenido, {{ $user->name }}!</p>

            <p>
                Tu cuenta ha sido creada exitosamente en <strong style="color:#f87171">Resident Evil Wikia</strong>.
                Ya puedes explorar personajes, juegos y locaciones del universo de Resident Evil.
            </p>

            <hr class="divider">

            <div class="info-box">
                <p><strong>Nombre:</strong> {{ $user->name }}</p>
                <p style="margin-top:8px"><strong>Correo:</strong> {{ $user->email }}</p>
                <p style="margin-top:8px"><strong>Rol:</strong> {{ ucfirst($user->role ?? 'editor') }}</p>
                <p style="margin-top:8px"><strong>Fecha de registro:</strong> {{ $user->created_at->format('d/m/Y H:i') }}</p>
            </div>

            <p>
                Accede a la plataforma para comenzar a explorar el contenido o, si tienes permisos de administrador,
                gestiona los registros desde el panel de administración.
            </p>

            <div class="btn-wrap">
                <a href="{{ config('app.url') }}/dashboard" class="btn">Ir al Dashboard</a>
            </div>

            <p style="font-size:13px; color:#6b7280;">
                Si no creaste esta cuenta, puedes ignorar este correo.
            </p>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>© {{ date('Y') }} Resident Evil Wikia — Este correo fue generado automáticamente.</p>
            <p style="margin-top:4px">No respondas a este mensaje.</p>
        </div>
    </div>
</body>
</html>
