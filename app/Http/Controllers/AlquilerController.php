<?php

namespace App\Http\Controllers;

use App\Models\Alquiler;

class AlquilerController extends Controller
{
    public function index()
    {
        $alquileres = Alquiler::with([
            'cliente',
            'empleado',
            'detalles.equipo'
        ])
        ->where('estado', 'confirmado')
        ->orderBy('fecha_inicio')
        ->get();

        dd($alquileres);
    }
}
