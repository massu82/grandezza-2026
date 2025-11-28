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
            ['nombre' => 'Tintos', 'descripcion' => 'Selección de vinos tintos con cuerpo y carácter.', 'imagen' => 'https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=1200&q=80'],
            ['nombre' => 'Blancos', 'descripcion' => 'Vinos blancos frescos y aromáticos.', 'imagen' => 'https://images.unsplash.com/photo-1527169402691-feff5539e52c?auto=format&fit=crop&w=1200&q=80'],
            ['nombre' => 'Rosados', 'descripcion' => 'Etiquetas rosadas ligeras y refrescantes.', 'imagen' => 'https://images.unsplash.com/photo-1524592094714-0f0654e20314?auto=format&fit=crop&w=1200&q=80'],
            ['nombre' => 'Espumosos', 'descripcion' => 'Burbujas para celebrar cualquier ocasión.', 'imagen' => 'https://images.unsplash.com/photo-1514369118554-e20d93546b30?auto=format&fit=crop&w=1200&q=80'],
            ['nombre' => 'Reserva', 'descripcion' => 'Vinos de guarda con gran estructura.', 'imagen' => 'https://images.unsplash.com/photo-1470337458703-46ad1756a187?auto=format&fit=crop&w=1200&q=80'],
            ['nombre' => 'Gran Reserva', 'descripcion' => 'Botellas excepcionales para momentos únicos.', 'imagen' => 'https://images.unsplash.com/photo-1441974231531-c6227db76b6e?auto=format&fit=crop&w=1200&q=80'],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['slug' => Str::slug($category['nombre'])],
                [
                    'nombre' => $category['nombre'],
                    'descripcion' => $category['descripcion'],
                ]
            );
        }
    }
}
