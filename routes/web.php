<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\EquipoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\AlquilerController;
use App\Http\Controllers\AlquilerDetalleController;

Route::get('/categorias',
[CategoriaController::class, 'index']);

Route::get('/equipos',
[EquipoController::class, 'index']);

Route::get('/clientes', 
[ClienteController::class, 'index']);

Route::get('/empleados', 
[EmpleadoController::class, 'index']);

Route::get('/alquileres', 
[AlquilerController::class, 'index']);

Route::get('/alquiler-detalles', 
[AlquilerDetalleController::class, 'index']);
