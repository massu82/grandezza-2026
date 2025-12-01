<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['nombre' => 'Vinos Tintos', 'descripcion' => 'Selección de tintos con cuerpo, crianza y reserva.', 'imagen' => 'https://images.unsplash.com/photo-1470337458703-46ad1756a187?auto=format&fit=crop&w=1200&q=80'],
            ['nombre' => 'Vinos Blancos', 'descripcion' => 'Blancos frescos, jóvenes y con barrica.', 'imagen' => 'https://images.unsplash.com/photo-1527169402691-feff5539e52c?auto=format&fit=crop&w=1200&q=80'],
            ['nombre' => 'Vinos Rosados', 'descripcion' => 'Rosados ligeros y afrutados para cualquier ocasión.', 'imagen' => 'https://images.unsplash.com/photo-1524592094714-0f0654e20314?auto=format&fit=crop&w=1200&q=80'],
            ['nombre' => 'Vinos Espumosos', 'descripcion' => 'Champagne, cava y espumosos para celebrar.', 'imagen' => 'https://images.unsplash.com/photo-1514369118554-e20d93546b30?auto=format&fit=crop&w=1200&q=80'],
            ['nombre' => 'Vinos Naranjas', 'descripcion' => 'Blancos macerados con piel, estilo ámbar.', 'imagen' => 'https://images.unsplash.com/photo-1441974231531-c6227db76b6e?auto=format&fit=crop&w=1200&q=80'],
            ['nombre' => 'Vinos de Postre', 'descripcion' => 'Late harvest, oportos y etiquetas dulces.', 'imagen' => 'https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=1200&q=80'],
            ['nombre' => 'Tequila', 'descripcion' => 'Blanco, reposado y añejo de agave azul.', 'imagen' => 'https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=1200&q=80'],
            ['nombre' => 'Mezcal', 'descripcion' => 'Destilados de agave artesanales y ancestrales.', 'imagen' => 'https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=1200&q=80'],
            ['nombre' => 'Sotol', 'descripcion' => 'Destilado del desierto chihuahuense.', 'imagen' => 'https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=1200&q=80'],
            ['nombre' => 'Whisky', 'descripcion' => 'Scotch, bourbon e irlandés para toda ocasión.', 'imagen' => 'https://images.unsplash.com/photo-1441974231531-c6227db76b6e?auto=format&fit=crop&w=1200&q=80'],
            ['nombre' => 'Ron', 'descripcion' => 'Añejo, dorado y especiado del Caribe y Latinoamérica.', 'imagen' => 'https://images.unsplash.com/photo-1527169402691-feff5539e52c?auto=format&fit=crop&w=1200&q=80'],
            ['nombre' => 'Vodka', 'descripcion' => 'Vodkas clásicos y premium.', 'imagen' => 'https://images.unsplash.com/photo-1524592094714-0f0654e20314?auto=format&fit=crop&w=1200&q=80'],
            ['nombre' => 'Gin', 'descripcion' => 'Ginebras clásicas y contemporáneas.', 'imagen' => 'https://images.unsplash.com/photo-1514369118554-e20d93546b30?auto=format&fit=crop&w=1200&q=80'],
            ['nombre' => 'Brandy y Coñac', 'descripcion' => 'Destilados de vino con crianza y elegancia.', 'imagen' => 'https://images.unsplash.com/photo-1441974231531-c6227db76b6e?auto=format&fit=crop&w=1200&q=80'],
            ['nombre' => 'Licores y Aperitivos', 'descripcion' => 'Amargos, vermuts y licores digestivos.', 'imagen' => 'https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=1200&q=80'],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['slug' => Str::slug($category['nombre'])],
                [
                    'nombre' => $category['nombre'],
                    'descripcion' => $category['descripcion'],
                    'imagen' => $category['imagen'] ?? null,
                ]
            );
        }
    }
}
