<?php

namespace App\Http\Controllers;

use App\Models\EtapaProyecto;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EtapaProyectoController extends Controller
{
    /**
     * Listar todas las etapas con sus catálogos asociados.
     */
    public function index(): JsonResponse
    {
        $etapas = EtapaProyecto::with(['tipoEtapa', 'estadoGestion'])->get();

        return response()->json([
            'success' => true,
            'total'   => $etapas->count(),
            'data'    => $etapas,
        ]);
    }

    /**
     * Listar todas las etapas de un proyecto específico ordenadas por número.
     * Ruta: GET /api/etapas-proyecto/proyecto/{proyecto_id}
     */
    public function getByProyecto($proyecto_id): JsonResponse
    {
        $etapas = EtapaProyecto::with(['tipoEtapa', 'estadoGestion'])
            ->where('proyecto_id', $proyecto_id)
            ->orderBy('numero_etapa', 'asc')
            ->get();

        return response()->json([
            'success' => true,
            'total'   => $etapas->count(),
            'data'    => $etapas,
        ]);
    }

    /**
     * Crear una nueva etapa de proyecto.
     */
    public function store(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'proyecto_id'  => 'required|integer',
            'numero_etapa' => 'required|integer',
            'alias_etapa'  => 'nullable|string|max:50',
            'etapa_id'     => 'nullable|integer',
            'estado_id'    => 'nullable|integer',
        ]);

        $etapa = EtapaProyecto::create($validatedData);

        return response()->json([
            'success' => true,
            'message' => 'Etapa creada correctamente.',
            'data'    => $etapa->load(['tipoEtapa', 'estadoGestion']),
        ], 201);
    }

    /**
     * Mostrar los datos detallados de una etapa específica por su ID.
     * Ruta: GET /api/etapas-proyecto/{id}
     */
    public function show($id): JsonResponse
    {
        $etapa = EtapaProyecto::with(['proyecto', 'tipoEtapa', 'estadoGestion'])->findOrFail($id);

        return response()->json([
            'success' => true,
            'data'    => $etapa,
        ]);
    }

    /**
     * Actualizar una etapa existente.
     */
    public function update(Request $request, $id): JsonResponse
    {
        $etapa = EtapaProyecto::findOrFail($id);

        $validatedData = $request->validate([
            'proyecto_id'  => 'sometimes|required|integer',
            'numero_etapa' => 'sometimes|required|integer',
            'alias_etapa'  => 'nullable|string|max:50',
            'etapa_id'     => 'nullable|integer',
            'estado_id'    => 'nullable|integer',
        ]);

        $etapa->update($validatedData);

        return response()->json([
            'success' => true,
            'message' => 'Etapa actualizada correctamente.',
            'data'    => $etapa->load(['tipoEtapa', 'estadoGestion']),
        ]);
    }

    /**
     * Eliminar una etapa por su ID.
     */
    public function destroy($id): JsonResponse
    {
        $etapa = EtapaProyecto::findOrFail($id);
        $etapa->delete();

        return response()->json([
            'success' => true,
            'message' => 'Etapa eliminada correctamente.',
        ]);
    }
}
