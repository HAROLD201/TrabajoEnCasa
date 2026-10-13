<?php

namespace App\Http\Controllers;

use App\Models\Equipo;

class EquipoController extends Controller
{
    public function index()
    {
        $equipos = Equipo::with('categoria')
            ->where('estado', 'disponible')
            ->orderBy('nombre')
            ->get();

        dd($equipos);
    }
}

