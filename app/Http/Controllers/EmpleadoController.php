<?php

namespace App\Http\Controllers;

use App\Models\Empleado;

class EmpleadoController extends Controller
{
    public function index()
    {
        $empleados = Empleado::where('cargo', 'Administrador')
            ->orWhere('cargo', 'Vendedor')
            ->orderBy('nombre_completo')
            ->get();

        dd($empleados);
    }
}
