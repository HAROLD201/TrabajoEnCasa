<?php

namespace Database\Seeders;

use App\Models\Pedido;
use App\Models\Cliente;
use App\Models\Empleado;
use Illuminate\Database\Seeder;

class PedidoSeeder extends Seeder
{
    public function run(): void
    {
        $clientes = Cliente::all();
        $empleados = Empleado::all();
    
        foreach (range(1, 15) as $i) {
            Pedido::factory()->create([
                'cliente_id' => $clientes->random()->id,
                'empleado_id' => $empleados->random()->id,
            ]);
        }
    }
}
