<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Empleado;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PedidosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pedidos = Pedido::with(['cliente', 'empleado'])->get();
        $clientes = \App\Models\Cliente::all();
        $empleados = Empleado::all();

        return view('Pedidos.index', compact('pedidos', 'clientes', 'empleados'));
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
        $validated = $this->validatePedido($request);

        Pedido::create($validated);

        return redirect()->route('pedidos.index')->with('success', 'Pedido creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pedido $pedido)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pedido $pedido)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pedido $pedido)
    {
        $validated = $this->validatePedido($request, $pedido);

        $pedido->update($validated);

        return redirect()->route('pedidos.index')->with('success', 'Pedido actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pedido $pedido)
    {
        $pedido->delete();

        return redirect()->route('pedidos.index')->with('success', 'Pedido eliminado exitosamente.');
    }

    private function validatePedido(Request $request, ?Pedido $pedido = null): array
    {
        return $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'empleado_id' => 'required|exists:empleados,id',
            'numero_pedido' => ['required', 'string', 'max:20', Rule::unique('pedidos', 'numero_pedido')->ignore($pedido)],
            'fecha_pedido' => 'required|date',
            'fecha_entrega' => 'nullable|date|after_or_equal:fecha_pedido',
            'total' => 'required|numeric|min:0',
            'estado' => 'required|in:pendiente,en_proceso,completado,cancelado',
            'observaciones' => 'nullable|string|max:255',
        ]);
    }
}
