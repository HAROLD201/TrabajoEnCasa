<?php

namespace App\Http\Controllers;

use App\Models\Bodega;
use Illuminate\Http\Request;

class BodegaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bodegas = Bodega::all();
        return view('Bodega.index', compact('bodegas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('bodegas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|min:3|max:255',
            'codigo' => 'required|string|max:50|unique:bodegas,codigo',
            'descripcion' => 'nullable|string|max:150',
        ]);

        Bodega::create($validated);

        return redirect()
            ->route('bodegas.index')
            ->with('success', 'Bodega creada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Bodega $bodega)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bodega $bodega)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bodega $bodega)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|min:3|max:255',
            'codigo' => 'required|string|max:50|unique:bodegas,codigo,' . $bodega->id,
            'descripcion' => 'nullable|string|max:150',
        ]);

        $bodega->update($validated);

        return redirect()
            ->route('bodegas.index')
            ->with('success', 'Bodega actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bodega $bodega)
    {
        $bodega->delete();

        return redirect()
            ->route('bodegas.index')
            ->with('success', 'Bodega eliminada exitosamente.');
    }
}
