<?php

namespace Tests\Feature;

use Database\Seeders\CategoriaSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoriaSeederTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_be_run_more_than_once_without_creating_duplicate_categories(): void
    {
        $this->seed(CategoriaSeeder::class);
        $this->seed(CategoriaSeeder::class);

        $this->assertDatabaseCount('categorias', 15);
    }
}
