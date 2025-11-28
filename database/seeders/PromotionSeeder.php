<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Promotion;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class PromotionSeeder extends Seeder
{
    public function run(): void
    {
        if (Product::count() < 10) {
            $this->call(ProductSeeder::class);
        }

        $promotions = [
            [
                'titulo' => 'Festival de Malbec',
                'descripcion' => 'Selección especial de Malbec con descuento para maridar con carnes.',
                'banner' => 'https://images.unsplash.com/photo-1514369118554-e20d93546b30?auto=format&fit=crop&w=1200&q=80',
                'fecha_inicio' => Carbon::now()->subDays(2),
                'fecha_fin' => Carbon::now()->addWeeks(2),
                'activo' => true,
            ],
            [
                'titulo' => 'Blancos de verano',
                'descripcion' => 'Vinos blancos refrescantes para clima cálido.',
                'banner' => 'https://images.unsplash.com/photo-1524592094714-0f0654e20314?auto=format&fit=crop&w=1200&q=80',
                'fecha_inicio' => Carbon::now()->subDays(5),
                'fecha_fin' => Carbon::now()->addWeeks(1),
                'activo' => true,
            ],
        ];

        foreach ($promotions as $data) {
            $promotion = Promotion::updateOrCreate(
                ['titulo' => $data['titulo']],
                $data
            );

            $productIds = Product::inRandomOrder()->take(12)->pluck('id');
            $promotion->products()->sync($productIds);
        }
    }
}
