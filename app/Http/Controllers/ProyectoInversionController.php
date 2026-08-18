<?php

namespace App\Http\Controllers;

use App\Models\ProyectoInversion;
use Illuminate\Http\Request;

class ProyectoInversionController extends Controller
{
    // Definimos las columnas que queremos traer (excluyendo 'geom')
    private $columnas = [
        'id',
        'cui',
        'descripcion',
        'alias',
        'monto_inversion',
        'etapa_actual_id',
        'estado_id',
        'ubigeo',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    ];

    public function index()
    {
        // Aplicamos el select para excluir 'geom' y traemos las relaciones
        $proyectos = ProyectoInversion::select($this->columnas)
            ->with(['estado', 'etapaActual'])
            ->get();

        return response()->json($proyectos);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'cui' => 'required|string|max:20',
            'descripcion' => 'required|string',
            'alias' => 'nullable|string|max:50',
            'monto_inversion' => 'nullable|numeric',
            'etapa_actual_id' => 'nullable|integer',
            'estado_id' => 'nullable|integer',
            'ubigeo' => 'nullable|string|max:6',
            'geom' => 'nullable', // Se mantiene en la validación por si se envía en la creación
            'created_by' => 'nullable|string|max:20'
        ]);

        $proyecto = ProyectoInversion::create($validatedData);

        // Retornamos el proyecto recién creado sin el geom
        $proyectoRefresh = ProyectoInversion::select($this->columnas)->find($proyecto->id);

        return response()->json($proyectoRefresh, 201);
    }

    public function show($id)
    {
        // Aplicamos el select para excluir 'geom' en la consulta individual
        $proyecto = ProyectoInversion::select($this->columnas)
            ->with(['estado', 'etapaActual', 'controlesGasto'])
            ->findOrFail($id);

        return response()->json($proyecto);
    }

    public function update(Request $request, $id)
    {
        $proyecto = ProyectoInversion::findOrFail($id);
        $proyecto->update($request->all());

        // Retornamos el proyecto actualizado sin el geom
        $proyectoActualizado = ProyectoInversion::select($this->columnas)->find($id);

        return response()->json($proyectoActualizado);
    }

    public function destroy($id)
    {
        $proyecto = ProyectoInversion::findOrFail($id);
        $proyecto->delete();
        return response()->json(null, 204);
    }
}
