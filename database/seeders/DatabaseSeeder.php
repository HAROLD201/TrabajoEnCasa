<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            ClienteSeeder::class,
            EmpleadoSeeder::class,
            CategoriaSeeder::class,
            ProductoSeeder::class,
            PedidoSeeder::class,
            BodegaSeeder::class,
        ]);
    }
}
