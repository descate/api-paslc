<?php

namespace App\Http\Controllers;

use App\Models\ControlGasto;
use Illuminate\Http\Request;

class ControlGastoController extends Controller
{
    public function index(Request $request)
    {
        $query = ControlGasto::with('proyecto');

        // 1. Filtro por Proyecto (Obligatorio desde la vista)
        if ($request->has('proyecto_id')) {
            $query->where('proyecto_id', $request->proyecto_id);
        }

        // 2. Filtro por Mes (¡Esta es la pieza que falta!)
        // Solo se aplica si el frontend envía un mes específico
        if ($request->has('mes') && $request->mes != null) {
            $query->where('mes', $request->mes);
        }

        $gastos = $query->get();

        return response()->json($gastos);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'proyecto_id' => 'required|integer|exists:proyectos.proyecto_inversion,id',
            'componente_proyecto_id' => 'nullable|integer',
            'meta' => 'nullable|integer',
            'clasificador_gasto' => 'nullable|string|max:20',
            'concepto_pago' => 'required|string',
            'mes' => 'required|integer|min:1|max:12',
            'monto_gasto' => 'required|numeric',
            'created_by' => 'nullable|string|max:100'
        ]);

        $gasto = ControlGasto::create($validatedData);
        return response()->json($gasto, 201);
    }

    public function show($id)
    {
        $gasto = ControlGasto::with('proyecto')->findOrFail($id);
        return response()->json($gasto);
    }

    public function update(Request $request, $id)
    {
        $gasto = ControlGasto::findOrFail($id);
        $gasto->update($request->all());
        return response()->json($gasto);
    }

    public function destroy($id)
    {
        $gasto = ControlGasto::findOrFail($id);
        $gasto->delete();
        return response()->json(null, 204);
    }
}
