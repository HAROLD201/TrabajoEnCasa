<?php

namespace Database\Seeders;

use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Database\Seeder;

class ProductoSeeder extends Seeder
{
    public function run(): void
    {
        $categorias = Categoria::all();

        foreach (range(1, 15) as $i) {
            Producto::factory()->create([
                'categoria_id' => $categorias->random()->id,
            ]);
        }
    }
}
