# Grandezza 2026

Sitio de vinatería boutique construido con Laravel 11, Tailwind y Alpine. Incluye catálogo de productos con presentaciones independientes, promociones, sliders y drawer de carrito.

## Requerimientos
- PHP 8.3+
- Composer
- Node.js 18+ y npm
- MySQL 8+ o MariaDB equivalente

## Instalación y configuración
```bash
cp .env.example .env
composer install
npm install
php artisan key:generate
```
Configura credenciales de base de datos y storage en `.env`.

## Migraciones y seeds
```bash
php artisan migrate
php artisan db:seed --class=RealisticProductSeeder
```
`DatabaseSeeder` incluye el seeder realista de productos con imágenes de botella (`public/img/botella-fake.webp`).

## Build de assets
- Desarrollo: `npm run dev`
- Producción: `npm run build`

## Servir la app
```bash
php artisan serve
```

## Notas de frontend
- Paleta base en gama zinc con acento dorado.
- Íconos via Heroicons (blade-ui-kit) y SVG locales en `public/icons`.
- Botones primarios en zinc (`.btn-primary` en `resources/css/app.css`).
- Swiper estilos globales definidos en `resources/css/app.css`.

## Minificación en producción
El middleware `App\Http\Middleware\MinifyHtml` se aplica al grupo `web` solo en entorno `production` para compactar el HTML.

## Tests
```bash
php artisan test
```
