<?php

namespace App\Http\Controllers;

use App\Models\AlquilerDetalle;

class AlquilerDetalleController extends Controller
{
    public function index()
    {
        $detalles = AlquilerDetalle::with([
            'alquiler.cliente',
            'equipo'
        ])
        ->where('cantidad', '>=', 2)
        ->orderBy('precio_unitario', 'desc')
        ->get();

        dd($detalles);
    }
}
