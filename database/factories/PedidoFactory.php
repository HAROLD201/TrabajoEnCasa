<?php

namespace Database\Factories;

use App\Models\Cliente;
use App\Models\Empleado;
use Illuminate\Database\Eloquent\Factories\Factory;

class PedidoFactory extends Factory
{
    public function definition(): array
    {
        return [
            'cliente_id' => Cliente::factory(),
            'empleado_id' => Empleado::factory(),
            'numero_pedido' => fake()->unique()->bothify('PED-####'),
            'fecha_pedido' => fake()->dateTimeBetween(
                '-1 year',
                'now'
            )->format('Y-m-d'),
            'fecha_entrega' => fake()->optional()->dateTimeBetween(
                '-6 months',
                'now'
            )?->format('Y-m-d'),
            'total' => fake()->randomFloat(2, 100, 50000),
            'estado' => fake()->randomElement([
                'pendiente',
                'en_proceso',
                'completado',
                'cancelado'
            ]),
            'observaciones' => fake()->optional()->sentence(),
        ];
    }
}
