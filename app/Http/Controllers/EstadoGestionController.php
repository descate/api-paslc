<?php

namespace App\Http\Controllers;

use App\Models\EstadoGestion;
use Illuminate\Http\Request;

class EstadoGestionController extends Controller
{
    public function index()
    {
        $estados = EstadoGestion::with('etapa')->where('activo', true)->get();
        return response()->json($estados);
    }

    public function store(Request $request)
    {
        $estado = EstadoGestion::create($request->all());
        return response()->json($estado, 201);
    }

    public function show($id)
    {
        $estado = EstadoGestion::with('etapa')->findOrFail($id);
        return response()->json($estado);
    }

    public function update(Request $request, $id)
    {
        $estado = EstadoGestion::findOrFail($id);
        $estado->update($request->all());
        return response()->json($estado);
    }

    public function destroy($id)
    {
        $estado = EstadoGestion::findOrFail($id);
        // Soft delete lógico cambiando el estado activo
        $estado->update(['activo' => false]);
        return response()->json(null, 204);
    }
}
