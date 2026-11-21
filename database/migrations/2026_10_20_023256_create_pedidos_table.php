<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();

            $table->foreignId('cliente_id')
                  ->constrained('clientes')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->foreignId('empleado_id')
                  ->constrained('empleados')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->string('numero_pedido', 20)->unique();
            $table->date('fecha_pedido');
            $table->date('fecha_entrega')->nullable();
            $table->decimal('total', 10, 2)->default(0);

            $table->enum('estado', [
                'pendiente',
                'en_proceso',
                'completado',
                'cancelado'
            ])->default('pendiente');

            $table->string('observaciones', 255)->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};
