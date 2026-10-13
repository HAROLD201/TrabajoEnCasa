<?php

namespace App\Http\Controllers;

use App\Models\Cliente;

class ClienteController extends Controller
{
    public function index()
    {
        $clientes = Cliente::where('nombre_completo', 'like', '%a%')
            ->orderBy('nombre_completo')
            ->get();

        dd($clientes);
    }
}
