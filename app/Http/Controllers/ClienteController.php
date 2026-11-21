<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$clientes = Cliente::all();
        //dd($clientes);
        //return view('clientes.index', compact('clientes'));

       // $clientes = Cliente::withoutTrashed()->get();
        //return view('Clientes.index',compact('clientes'));

        $clientes = Cliente::all();
        $clientes_count = Cliente::Exist;

        return view('Clientes.index', compact('clientes', 'clientes_count'));
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clientes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $validated = $request->validate([
        'nombre' => 'required|string|min:3|max:255',
        'codigo' => 'required|string|max:50|unique:clientes,codigo',
        'email' => 'required|email|max:255|unique:clientes,email',
        'telefono' => 'required|string|max:20',
        'direccion' => 'required|string|max:255',
        'estado' => 'required|in:Activo,Inactivo',
                    
    ]);

    Cliente::create($validated);

    return redirect()
        ->route('clientes.index')
        ->with('success', 'Cliente creado exitosamente.');
}

    public function show(Cliente $cliente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cliente $cliente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cliente $cliente)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|min:3|max:255',
            'codigo' => 'required|string|max:50|unique:clientes,codigo,' . $cliente->id,
            'email' => 'required|email|max:255|unique:clientes,email,' . $cliente->id,
            'telefono' => 'required|string|max:20',
            'direccion' => 'required|string|max:255',
            'estado' => 'required|in:Activo,Inactivo',
        ]);

        $cliente->update($validated);

        return redirect()
            ->route('clientes.index')
            ->with('success', 'Cliente actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->delete();
        
        return redirect()
            ->route('clientes.index')
            ->with('success', 'Cliente eliminado exitosamente.');
    }
}
