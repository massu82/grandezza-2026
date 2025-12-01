<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>En construcción | Grandezza</title>
    <link rel="icon" type="image/webp" href="{{ asset('img/favicon.webp') }}">
    <style>
        :root {
            color-scheme: light;
        }
        * { box-sizing: border-box; }
        body {
            margin: 0;
            min-height: 100vh;
            display: grid;
            place-items: center;
            background: radial-gradient(circle at 20% 20%, #f6f0e4 0, #e9e1d2 35%, #d9cfbf 100%);
            font-family: 'Helvetica Neue', Arial, sans-serif;
            color: #1f1b1a;
        }
        .card {
            background: #fff;
            border: 1px solid rgba(59, 30, 31, 0.08);
            border-radius: 16px;
            padding: 32px 28px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.08);
            text-align: center;
            max-width: 420px;
            width: 90%;
        }
        img {
            max-width: 180px;
            height: auto;
        }
        h1 {
            font-size: 22px;
            margin: 18px 0 8px;
            letter-spacing: 0.04em;
        }
        p {
            margin: 0;
            color: #5b5563;
            line-height: 1.6;
            font-size: 15px;
        }
    </style>
</head>
<body>
    <div class="card">
        <img src="{{ asset('img/logo-dark.webp') }}" alt="Grandezza">
        <h1>Estamos preparando algo especial</h1>
        <p>El sitio estará disponible muy pronto. Gracias por tu paciencia.</p>
    </div>
</body>
</html>
