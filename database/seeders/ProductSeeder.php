<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        if (Category::count() === 0) {
            $this->call(CategorySeeder::class);
        }

        $faker = \Faker\Factory::create('es_ES');
        $categories = Category::all();

        $adjectives = ['Reserva', 'Gran Reserva', 'Clásico', 'Edición Especial', 'Colección', 'Roble', 'Signature', 'Estate'];
        $varieties = ['Malbec', 'Cabernet Sauvignon', 'Merlot', 'Pinot Noir', 'Syrah', 'Chardonnay', 'Sauvignon Blanc', 'Tempranillo', 'Garnacha', 'Rosé', 'Cava', 'Brut Nature'];
        $countries = ['Argentina', 'Chile', 'España', 'Francia', 'Italia', 'México', 'Estados Unidos', 'Australia'];
        $regions = ['Mendoza', 'Valle de Colchagua', 'Rioja', 'Bordeaux', 'Toscana', 'Valle de Guadalupe', 'Napa', 'Barossa'];
        $types = ['tinto', 'blanco', 'rosado', 'espumoso'];
        $presentations = ['375 ml', '500 ml', '750 ml', '1 L', '1.5 L'];
        $images = [
            'https://images.unsplash.com/photo-1527169402691-feff5539e52c?auto=format&fit=crop&w=900&q=80',
            'https://images.unsplash.com/photo-1514369118554-e20d93546b30?auto=format&fit=crop&w=900&q=80',
            'https://images.unsplash.com/photo-1524592094714-0f0654e20314?auto=format&fit=crop&w=900&q=80',
            'https://images.unsplash.com/photo-1527169402691-feff5539e52c?auto=format&fit=crop&w=1200&q=80',
        ];

        $productsToCreate = 50;

        for ($i = 1; $i <= $productsToCreate; $i++) {
            $variety = Arr::random($varieties);
            $adj = Arr::random($adjectives);
            $name = "{$adj} {$variety}";
            $presentation = Arr::random($presentations);
            $slug = Product::generateSlug($name, $presentation);
            $category = $categories->random();
            $price = $faker->numberBetween(300, 2500);
            $promo = $faker->boolean(30);
            $promoPrice = $promo ? max(250, $price - $faker->numberBetween(50, 300)) : null;

            Product::updateOrCreate(
                ['slug' => $slug],
                [
                    'nombre' => $name,
                    'presentation' => $presentation,
                    'descripcion_corta' => 'Vino '.$variety.' con notas elegantes y final persistente.',
                    'descripcion_larga' => 'Notas de cata: frutas maduras, especias suaves y taninos redondos. Ideal para maridar con carnes, pastas y quesos curados.',
                    'precio' => $price,
                    'precio_promocion' => $promoPrice,
                    'porcentaje_descuento' => $promoPrice ? (int) round((1 - ($promoPrice / $price)) * 100) : null,
                    'categoria_id' => $category->id,
                    'tipo' => Arr::random($types),
                    'pais' => Arr::random($countries),
                    'region' => Arr::random($regions),
                    'uva' => $variety,
                    'anada' => $faker->numberBetween(2015, 2023),
                    'stock' => $faker->numberBetween(5, 80),
                    'sku' => 'SKU-'.$i.'-'.$faker->unique()->numerify('#####'),
                    'estado' => 1,
                    'tags' => [$variety, $category->nombre, 'premium'],
                    'imagen_principal' => Arr::random($images),
                    'galeria' => [
                        Arr::random($images),
                        Arr::random($images),
                    ],
                    'destacado' => $faker->boolean(25),
                ]
            );
        }
    }
}
