<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;

class EmpleadosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $empleados = Empleado::all();

        return view('Empleados.index', compact('empleados'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'codigo' => 'required|string|max:20|unique:empleados,codigo',
            'nombre' => 'required|string|max:100',
            'email' => 'required|email|max:100|unique:empleados,email',
            'cargo' => 'required|string|max:60',
            'fecha_contratacion' => 'required|date',
            'estado' => 'required|in:activo,inactivo',
        ]);

        Empleado::create($validated);

        return redirect()->route('empleados.index')->with('success', 'Empleado creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Empleado $empleado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Empleado $empleado)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Empleado $empleado)
    {
        $validated = $request->validate([
            'codigo' => 'required|string|max:20|unique:empleados,codigo,' . $empleado->id,
            'nombre' => 'required|string|max:100',
            'email' => 'required|email|max:100|unique:empleados,email,' . $empleado->id,
            'cargo' => 'required|string|max:60',
            'fecha_contratacion' => 'required|date',
            'estado' => 'required|in:activo,inactivo',
        ]);

        $empleado->update($validated);

        return redirect()->route('empleados.index')->with('success', 'Empleado actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Empleado $empleado)
    {
        $empleado->delete();

        return redirect()->route('empleados.index')->with('success', 'Empleado eliminado exitosamente.');
    }
}
