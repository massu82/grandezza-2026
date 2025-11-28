<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PageSeeder extends Seeder
{
    public function run(): void
    {
        $pages = [
            [
                'titulo' => 'Nosotros',
                'slug' => 'nosotros',
                'contenido' => 'Somos una vinatería dedicada a curar etiquetas excepcionales de todo el mundo. Creamos experiencias a medida para cada cliente.',
            ],
            [
                'titulo' => 'Contacto',
                'slug' => 'contacto',
                'contenido' => 'Completa el formulario y nuestro equipo te contactará para recomendarte la botella ideal.',
            ],
            [
                'titulo' => 'Términos',
                'slug' => 'terminos',
                'contenido' => 'Condiciones de uso y políticas de compra en tienda.',
            ],
            [
                'titulo' => 'Privacidad',
                'slug' => 'privacidad',
                'contenido' => 'Protegemos tus datos y los usamos únicamente para mejorar tu experiencia.',
            ],
        ];

        foreach ($pages as $page) {
            Page::updateOrCreate(
                ['slug' => Str::slug($page['slug'])],
                [
                    'titulo' => $page['titulo'],
                    'contenido' => $page['contenido'],
                    'publicado' => true,
                ]
            );
        }
    }
}
