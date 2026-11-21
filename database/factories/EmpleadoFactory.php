<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EmpleadoFactory extends Factory
{
    public function definition(): array
    {
        return [
            'codigo' => fake()->unique()->bothify('EMP-####'),
            'nombre' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'cargo' => fake()->randomElement([
                'Carpintero',
                'Supervisor',
                'Diseñador',
                'Operario',
                'Gerente'
            ]),
            'fecha_contratacion' => fake()->dateTimeBetween(
                '-5 years',
                'now'
            )->format('Y-m-d'),
            'estado' => fake()->randomElement([
                'activo',
                'inactivo'
            ]),
        ];
    }
}
