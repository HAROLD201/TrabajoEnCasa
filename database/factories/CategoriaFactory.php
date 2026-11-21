<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CategoriaFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nombre' => fake()->unique()->randomElement([
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
                'Muebles de TV'
            ]),
            'descripcion' => fake()->sentence(),
            'estado' => fake()->randomElement([
                'activo',
                'inactivo'
            ]),
    
        ];
    }
}
