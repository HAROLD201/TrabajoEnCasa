<?php

namespace Database\Factories;

use App\Models\Categoria;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductoFactory extends Factory
{
    public function definition(): array
    {
        return [
            'categoria_id' => Categoria::factory(),
            'codigo' => fake()->unique()->bothify('PRO-####'),
            'nombre' => fake()->words(3, true),
            'descripcion' => fake()->sentence(),
            'precio' => fake()->randomFloat(2, 100, 15000),
            'stock' => fake()->numberBetween(0, 100),
            'estado' => fake()->randomElement([
                'activo',
                'inactivo'
            ]),
        ];
    }
}
