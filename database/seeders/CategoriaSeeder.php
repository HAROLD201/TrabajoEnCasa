<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    public function run(): void
    {
        $nombres = [
            'Escritorios',
            'Mesas',
            'Sillas',
            'Estanterias',
            'Armarios',
            'Camas',
            'Sofas',
            'Libreros',
            'Bancos',
            'Cómodas',
            'Vitrinas',
            'Roperos',
            'Zapateras',
            'Credenzas',
            'Muebles de TV',
        ];

        foreach ($nombres as $nombre) {
            Categoria::firstOrCreate(
                ['nombre' => $nombre],
                [
                    'descripcion' => fake()->sentence(),
                    'estado' => fake()->randomElement(['activo', 'inactivo']),
                ]
            );
        }
    }
}
