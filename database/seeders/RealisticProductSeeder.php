<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class RealisticProductSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'nombre' => 'Marqués de Cáceres Crianza',
                'categoria' => 'Tintos',
                'tipo' => 'tinto',
                'pais' => 'España',
                'region' => 'Rioja',
                'uva' => 'Tempranillo',
                'anada' => 2019,
                'presentations' => ['750ml', '375ml'],
                'precio' => 420,
                'precio_promocion' => 380,
                'descripcion_corta' => 'Rioja clásico con notas de ciruela madura y vainilla.',
                'descripcion_larga' => 'Crianza con 12 meses en barrica de roble francés y americano. En boca es redondo, con taninos suaves y final especiado.',
                'destacado' => true,
                'imagen' => 'img/botella-fake.webp',
            ],
            [
                'nombre' => 'Catena Malbec',
                'categoria' => 'Tintos',
                'tipo' => 'tinto',
                'pais' => 'Argentina',
                'region' => 'Mendoza',
                'uva' => 'Malbec',
                'anada' => 2020,
                'presentations' => ['750ml'],
                'precio' => 520,
                'precio_promocion' => null,
                'descripcion_corta' => 'Malbec de altura con aromas a violetas y frutos negros.',
                'descripcion_larga' => 'Fermentado en pequeños tanques para preservar fruta. Notas de mora, grafito y taninos firmes.',
                'destacado' => true,
                'imagen' => 'img/botella-fake.webp',
            ],
            [
                'nombre' => 'Antinori Tignanello',
                'categoria' => 'Gran Reserva',
                'tipo' => 'tinto',
                'pais' => 'Italia',
                'region' => 'Toscana',
                'uva' => 'Sangiovese, Cabernet Sauvignon',
                'anada' => 2018,
                'presentations' => ['750ml'],
                'precio' => 2650,
                'precio_promocion' => null,
                'descripcion_corta' => 'Super Tuscan icónico con complejidad y elegancia.',
                'descripcion_larga' => 'Notas de cereza negra, tabaco y balsámicos. Estructura firme y final persistente.',
                'destacado' => true,
                'imagen' => 'img/botella-fake.webp',
            ],
            [
                'nombre' => 'Cloudy Bay Sauvignon Blanc',
                'categoria' => 'Blancos',
                'tipo' => 'blanco',
                'pais' => 'Nueva Zelanda',
                'region' => 'Marlborough',
                'uva' => 'Sauvignon Blanc',
                'anada' => 2022,
                'presentations' => ['750ml'],
                'precio' => 780,
                'precio_promocion' => 720,
                'descripcion_corta' => 'Blanco vibrante con maracuyá, lima y hierbas frescas.',
                'descripcion_larga' => 'Acidez punzante, textura jugosa y final mineral. Ideal para mariscos y ensaladas.',
                'destacado' => false,
                'imagen' => 'img/botella-fake.webp',
            ],
            [
                'nombre' => 'Albariño Pazo de Señoráns',
                'categoria' => 'Blancos',
                'tipo' => 'blanco',
                'pais' => 'España',
                'region' => 'Rías Baixas',
                'uva' => 'Albariño',
                'anada' => 2021,
                'presentations' => ['750ml'],
                'precio' => 690,
                'precio_promocion' => null,
                'descripcion_corta' => 'Albariño salino y floral con final refrescante.',
                'descripcion_larga' => 'Notas de cítricos, melocotón blanco y flor de azahar. Final largo y mineral.',
                'destacado' => false,
                'imagen' => 'img/botella-fake.webp',
            ],
            [
                'nombre' => 'Chandon Brut Rosé',
                'categoria' => 'Espumosos',
                'tipo' => 'espumoso',
                'pais' => 'Argentina',
                'region' => 'Mendoza',
                'uva' => 'Pinot Noir, Chardonnay',
                'anada' => null,
                'presentations' => ['750ml'],
                'precio' => 480,
                'precio_promocion' => 430,
                'descripcion_corta' => 'Espumoso fresco con frutos rojos y burbuja fina.',
                'descripcion_larga' => 'Método tradicional. Notas de frambuesa, crema y final cítrico.',
                'destacado' => false,
                'imagen' => 'img/botella-fake.webp',
            ],
            [
                'nombre' => 'Moët & Chandon Impérial Brut',
                'categoria' => 'Espumosos',
                'tipo' => 'espumoso',
                'pais' => 'Francia',
                'region' => 'Champagne',
                'uva' => 'Pinot Noir, Pinot Meunier, Chardonnay',
                'anada' => null,
                'presentations' => ['750ml', '375ml'],
                'precio' => 1450,
                'precio_promocion' => null,
                'descripcion_corta' => 'Champagne icónico con manzana verde, brioche y burbuja cremosa.',
                'descripcion_larga' => 'Ensamblaje clásico. Equilibrio entre frescura, estructura y madurez.',
                'destacado' => true,
                'imagen' => 'img/botella-fake.webp',
            ],
            [
                'nombre' => 'Prado Rey Rosado',
                'categoria' => 'Rosados',
                'tipo' => 'rosado',
                'pais' => 'España',
                'region' => 'Ribera del Duero',
                'uva' => 'Tempranillo',
                'anada' => 2022,
                'presentations' => ['750ml'],
                'precio' => 360,
                'precio_promocion' => null,
                'descripcion_corta' => 'Rosado seco con fresa fresca y toque floral.',
                'descripcion_larga' => 'Cuerpo ligero-medio, acidez crujiente y final limpio. Ideal para tapas.',
                'destacado' => false,
                'imagen' => 'img/botella-fake.webp',
            ],
            [
                'nombre' => 'Whispering Angel Rosé',
                'categoria' => 'Rosados',
                'tipo' => 'rosado',
                'pais' => 'Francia',
                'region' => 'Provenza',
                'uva' => 'Grenache, Cinsault',
                'anada' => 2022,
                'presentations' => ['750ml'],
                'precio' => 890,
                'precio_promocion' => null,
                'descripcion_corta' => 'Rosé provenzal elegante con notas de melón y pétalo de rosa.',
                'descripcion_larga' => 'Seco, con acidez equilibrada y final salino. Perfecto como aperitivo.',
                'destacado' => true,
                'imagen' => 'img/botella-fake.webp',
            ],
            [
                'nombre' => 'Barón de Ley Reserva',
                'categoria' => 'Reserva',
                'tipo' => 'tinto',
                'pais' => 'España',
                'region' => 'Rioja',
                'uva' => 'Tempranillo',
                'anada' => 2018,
                'presentations' => ['750ml'],
                'precio' => 520,
                'precio_promocion' => 480,
                'descripcion_corta' => 'Reserva riojano con vainilla, coco y fruta madura.',
                'descripcion_larga' => '18 meses en barrica americana. Taninos dulces y final especiado.',
                'destacado' => false,
                'imagen' => 'img/botella-fake.webp',
            ],
            [
                'nombre' => 'Sassicaia',
                'categoria' => 'Gran Reserva',
                'tipo' => 'tinto',
                'pais' => 'Italia',
                'region' => 'Bolgheri',
                'uva' => 'Cabernet Sauvignon, Cabernet Franc',
                'anada' => 2019,
                'presentations' => ['750ml'],
                'precio' => 4900,
                'precio_promocion' => null,
                'descripcion_corta' => 'Ícono italiano con cassis, grafito y notas de cedro.',
                'descripcion_larga' => 'Estructura imponente, tanino fino y largo final mineral.',
                'destacado' => true,
                'imagen' => 'img/botella-fake.webp',
            ],
            [
                'nombre' => 'Porto Graham’s Six Grapes',
                'categoria' => 'Tintos',
                'tipo' => 'fortificado',
                'pais' => 'Portugal',
                'region' => 'Douro',
                'uva' => 'Touriga Nacional, Touriga Franca',
                'anada' => null,
                'presentations' => ['750ml', '375ml'],
                'precio' => 620,
                'precio_promocion' => null,
                'descripcion_corta' => 'Oporto Ruby intenso con ciruelas, mora y chocolate.',
                'descripcion_larga' => 'Dulzor equilibrado, cuerpo medio y final especiado. Ideal para postres.',
                'destacado' => false,
                'imagen' => 'img/botella-fake.webp',
            ],
        ];

        $categoryMap = [];
        foreach (Category::pluck('id', 'nombre') as $name => $id) {
            $categoryMap[$name] = $id;
        }

        foreach ($items as $item) {
            $categoriaId = $categoryMap[$item['categoria']] ?? Category::firstOrCreate(
                ['slug' => Str::slug($item['categoria'])],
                ['nombre' => $item['categoria']]
            )->id;

            foreach ($item['presentations'] as $presentation) {
                $slug = Product::generateSlug($item['nombre'], $presentation);
                Product::updateOrCreate(
                    ['slug' => $slug],
                    [
                        'nombre' => $item['nombre'],
                        'presentation' => $presentation,
                        'descripcion_corta' => $item['descripcion_corta'],
                        'descripcion_larga' => $item['descripcion_larga'],
                        'precio' => $item['precio'],
                        'precio_promocion' => $item['precio_promocion'],
                        'porcentaje_descuento' => $item['precio_promocion']
                            ? (int) round((1 - ($item['precio_promocion'] / $item['precio'])) * 100)
                            : null,
                        'categoria_id' => $categoriaId,
                        'tipo' => $item['tipo'],
                        'pais' => $item['pais'],
                        'region' => $item['region'],
                        'uva' => $item['uva'],
                        'anada' => $item['anada'],
                        'stock' => 50,
                        'sku' => strtoupper(Str::slug($item['nombre'])).'-'.Str::random(5),
                        'estado' => 1,
                        'tags' => [$item['pais'], $item['tipo'], $item['region']],
                        'imagen_principal' => $item['imagen'],
                        'galeria' => null,
                        'destacado' => $item['destacado'],
                    ]
                );
            }
        }
    }
}
