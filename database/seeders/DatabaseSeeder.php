<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'andres@m-studio.com.mx'],
            [
                'name' => 'Andrés Massuttier',
                'password' => Hash::make('delDuero1'),
            ]
        );

        $this->call([
            CategorySeeder::class,
            ProductSeeder::class,
            PromotionSeeder::class,
            PageSeeder::class,
            SettingSeeder::class,
        ]);
    }
}
