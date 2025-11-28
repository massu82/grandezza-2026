@php
    $title = $isAdmin ? 'Nuevo pedido' : 'Gracias por tu pedido';
@endphp

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>
</head>
<body style="font-family: Arial, sans-serif; color:#111; background:#f6f6f6; padding:20px;">
    <table width="100%" cellpadding="0" cellspacing="0" style="max-width:640px; margin:0 auto; background:#ffffff; border:1px solid #e5e5e5;">
        <tr>
            <td style="padding:20px;">
                <h2 style="margin:0 0 10px 0; color:#7f1d1d;">{{ $title }}</h2>
                <p style="margin:0 0 6px 0;">Código: <strong>{{ $order->codigo }}</strong></p>
                <p style="margin:0 0 6px 0;">Nombre: {{ $order->nombre_cliente }}</p>
                <p style="margin:0 0 6px 0;">Email: {{ $order->email_cliente }}</p>
                <p style="margin:0 0 6px 0;">Teléfono: {{ $order->telefono_cliente }}</p>
                <p style="margin:0 0 6px 0;">Total: <strong>${{ number_format($order->total,2) }}</strong></p>

                <h4 style="margin:16px 0 8px 0;">Productos:</h4>
                <ul style="padding-left:18px; margin:0;">
                    @foreach($order->items as $item)
                        <li style="margin-bottom:4px;">
                            {{ $item->nombre_producto }} (x{{ $item->cantidad }}) - ${{ number_format($item->subtotal,2) }}
                        </li>
                    @endforeach
                </ul>

                <p style="margin:16px 0 0 0; font-size:13px; color:#444;">
                    Método de entrega: {{ $order->metodo_entrega }}<br>
                    Notas cliente: {{ $order->notas_cliente ?? 'N/A' }}
                </p>
            </td>
        </tr>
    </table>
</body>
</html>
