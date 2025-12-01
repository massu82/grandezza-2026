@php
    $title = $isAdmin ? 'Nuevo pedido recibido' : 'Gracias por tu pedido';
    $logo = asset('img/logo-white.webp');
    $accent = '#b8a06a';
    $dark = '#1e1b1a';
    $muted = '#5b5563';
@endphp

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>
</head>
<body style="margin:0; padding:0; background:#f7f4ef; font-family: 'Helvetica Neue', Arial, sans-serif; color: {{ $dark }};">
    <table role="presentation" cellpadding="0" cellspacing="0" width="100%" style="background:#f7f4ef; padding:24px 0;">
        <tr>
            <td align="center">
                <table role="presentation" cellpadding="0" cellspacing="0" width="640" style="max-width:640px; background:#ffffff; border-radius:12px; overflow:hidden; box-shadow:0 12px 28px rgba(0,0,0,0.08);">
                    <tr>
                        <td style="padding:24px 24px 12px 24px; background:linear-gradient(135deg, #1f1c2c 0%, #928dab 100%); color:#fff;">
                            <table width="100%" role="presentation">
                                <tr>
                                    <td align="left" style="vertical-align:middle;">
                                        <img src="{{ $logo }}" alt="Grandezza" width="130" style="display:block; max-width:160px;">
                                    </td>
                                    <td align="right" style="vertical-align:middle; font-size:13px; letter-spacing:0.08em; text-transform:uppercase; color:rgba(255,255,255,0.85);">
                                        {{ $order->codigo }}
                                    </td>
                                </tr>
                            </table>
                            <h1 style="margin:18px 0 6px 0; font-size:26px; font-weight:700; color:#fff;">{{ $title }}</h1>
                            <p style="margin:0; font-size:15px; color:rgba(255,255,255,0.92);">
                                @if($isAdmin)
                                    Se ha generado un nuevo pedido en la tienda.
                                @else
                                    Confirmamos tu compra. Te compartimos el detalle de tu pedido.
                                @endif
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:24px;">
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="border-collapse:collapse;">
                                <tr>
                                    <td style="padding:12px 0; border-bottom:1px solid #ece8df;">
                                        <strong style="color:{{ $dark }};">Resumen</strong><br>
                                        <span style="color:{{ $muted }}; font-size:14px;">Total: <strong style="color:{{ $dark }};">${{ number_format($order->total, 2) }}</strong></span><br>
                                        <span style="color:{{ $muted }}; font-size:14px;">Método de entrega: {{ $order->metodo_entrega }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:12px 0; border-bottom:1px solid #ece8df;">
                                        <strong style="color:{{ $dark }};">Datos de contacto</strong><br>
                                        <span style="color:{{ $muted }}; font-size:14px;">{{ $order->nombre_cliente }}</span><br>
                                        <span style="color:{{ $muted }}; font-size:14px;">{{ $order->email_cliente }}</span><br>
                                        <span style="color:{{ $muted }}; font-size:14px;">{{ $order->telefono_cliente }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:12px 0;">
                                        <strong style="color:{{ $dark }};">Productos</strong>
                                        <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="margin-top:10px; border-collapse:collapse;">
                                            @foreach($order->items as $item)
                                                <tr>
                                                    <td style="padding:8px 0; color:{{ $dark }}; font-size:14px; border-bottom:1px solid #f1ece3;">
                                                        {{ $item->nombre_producto }}<br>
                                                        <span style="color:{{ $muted }};">Cantidad: {{ $item->cantidad }}</span>
                                                    </td>
                                                    <td align="right" style="padding:8px 0; color:{{ $dark }}; font-size:14px; border-bottom:1px solid #f1ece3;">
                                                        ${{ number_format($item->subtotal, 2) }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <td style="padding:10px 0; color:{{ $muted }}; font-size:14px;">
                                                    Notas del cliente:
                                                    <div style="margin-top:6px; color:{{ $dark }};">{{ $order->notas_cliente ?? 'Sin notas adicionales.' }}</div>
                                                </td>
                                                <td></td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="background:#111; color:#f3f0ea; padding:16px 24px; text-align:center; font-size:12px;">
                            Grandezza · {{ config('app.url') }}
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
