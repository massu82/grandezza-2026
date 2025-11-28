<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            'telefono' => '(55) 1234 5678',
            'email' => 'hola@grandezza.mx',
            'direccion' => 'Av. Vino 123, CDMX',
            'horarios' => 'Lun-Sáb 11:00 - 20:00',
        ];

        foreach ($settings as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }
    }
}
