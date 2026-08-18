<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\MetaFisica;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MetaFisicaController extends Controller
{
    /**
     * Consultar todas las metas físicas o filtrar por proyecto_id mediante query param.
     * Ejemplo: GET /api/metas-fisicas?proyecto_id=5
     */
    public function index(Request $request): JsonResponse
    {
        $query = MetaFisica::with('tipoMeta:id,codigo,nombre,unidad_medida');

        // Filtrar por proyecto si viene el parámetro en la URL
        if ($request->has('proyecto_id')) {
            $query->where('proyecto_id', $request->query('proyecto_id'));
        }

        $metas = $query->get();

        return response()->json([
            'success' => true,
            'total'   => $metas->count(),
            'data'    => $metas,
        ]);
    }

    /**
     * Crear o actualizar una meta física.
     */
    public function storeOrUpdate(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'proyecto_id'  => 'required|integer|exists:proyectos.proyecto_inversion,id',
            'tipo_meta_id' => 'required|integer|exists:catalogo.tipo_meta_fisica,id',
            'cantidad'     => 'required|numeric|min:0',
        ]);

        $usuario = auth()->user()?->username ?? 'system';

        $meta = MetaFisica::updateOrCreate(
            [
                'proyecto_id'  => $validated['proyecto_id'],
                'tipo_meta_id' => $validated['tipo_meta_id'],
            ],
            [
                'cantidad'   => $validated['cantidad'],
                'updated_by' => $usuario,
                'created_by' => $usuario,
            ]
        );

        return response()->json([
            'success' => true,
            'message' => 'Meta física guardada correctamente.',
            'data'    => $meta->load('tipoMeta:id,codigo,nombre,unidad_medida'),
        ]);
    }

    /**
     * Eliminar una meta física por su ID.
     */
    public function destroy(int $id): JsonResponse
    {
        $meta = MetaFisica::findOrFail($id);
        $meta->delete();

        return response()->json([
            'success' => true,
            'message' => 'Meta física eliminada correctamente.',
        ]);
    }
}
