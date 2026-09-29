<?php

namespace App\Http\Controllers;

use App\Models\AccionEstadoSituacional;
use App\Models\EstadoSituacional;
use App\Models\EstadoAlerta;
use App\Models\Personal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class AccionEstadoSituacionalController extends Controller
{
    /**
     * Listar las acciones (filtradas por estado o etapa)
     */
    public function index(Request $request)
    {
        $query = AccionEstadoSituacional::with(['estadoAlerta', 'responsable', 'estadoSituacional']);

        // Filtro 1: Acciones de un reporte específico
        if ($request->has('estado_situacional_id')) {
            $query->where('estado_situacional_id', $request->estado_situacional_id);
        }

        // Filtro 2: Todas las acciones de una ETAPA completa
        if ($request->has('etapa_proyecto_id')) {
            $query->whereHas('estadoSituacional', function($q) use ($request) {
                $q->where('etapa_proyecto_id', $request->etapa_proyecto_id);
            });
        }

        $acciones = $query->orderBy('fecha_accion', 'desc')->get();

        return response()->json($acciones);
    }

    /**
     * Registrar un nuevo seguimiento (Acción) y actualizar el Estado Principal
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'estado_situacional_id' => ['required', 'integer', Rule::exists(EstadoSituacional::class, 'id')],
            'estado_alerta_id'      => ['required', 'integer', Rule::exists(EstadoAlerta::class, 'id')],
            'fecha_accion'          => ['required', 'date'],
            'accion_tomada'         => ['required', 'string'],
            'accion_pendiente'      => ['nullable', 'string'],
            'fecha_compromiso'      => ['nullable', 'date'], // <-- Nuevo campo agregado
            'responsable_id'        => ['required', 'integer', Rule::exists(Personal::class, 'id')],
        ]);

        try {
            DB::transaction(function () use ($validated) {

                // 1. Guardar la acción en el historial
                $accion = AccionEstadoSituacional::create($validated);

                // 2. Sincronizar el "estado_alerta_id" con la tabla principal
                $informePrincipal = EstadoSituacional::find($validated['estado_situacional_id']);

                if($informePrincipal) {
                    $informePrincipal->update([
                        'estado_alerta_id' => $validated['estado_alerta_id']
                    ]);
                }
            });

            return response()->json([
                'message' => 'Acción registrada y estado general actualizado correctamente'
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al registrar la acción',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Mostrar una acción específica
     */
    public function show($id)
    {
        $accion = AccionEstadoSituacional::with(['estadoSituacional', 'estadoAlerta', 'responsable'])
            ->find($id);

        if (!$accion) {
            return response()->json([
                'message' => 'No se encontró ninguna Acción/Seguimiento con este ID.'
            ], 404);
        }

        return response()->json($accion);
    }

    /**
     * Actualizar una acción existente
     */
    public function update(Request $request, $id)
    {
        $accion = AccionEstadoSituacional::find($id);

        if (!$accion) {
            return response()->json([
                'message' => 'No se puede actualizar. La acción no existe.'
            ], 404);
        }

        $validated = $request->validate([
            'estado_alerta_id' => ['sometimes', 'required', 'integer', Rule::exists(EstadoAlerta::class, 'id')],
            'fecha_accion'     => ['sometimes', 'required', 'date'],
            'accion_tomada'    => ['sometimes', 'required', 'string'],
            'accion_pendiente' => ['nullable', 'string'],
            'fecha_compromiso' => ['nullable', 'date'], // <-- Nuevo campo agregado
            'responsable_id'   => ['sometimes', 'required', 'integer', Rule::exists(Personal::class, 'id')],
        ]);

        $accion->update($validated);

        return response()->json([
            'message' => 'Acción actualizada correctamente',
            'data'    => $accion
        ]);
    }

    /**
     * Eliminar un registro de acción
     */
    public function destroy($id)
    {
        $accion = AccionEstadoSituacional::find($id);

        if (!$accion) {
            return response()->json([
                'message' => 'No se puede eliminar. La acción no existe.'
            ], 404);
        }

        $accion->delete();

        return response()->json([
            'message' => 'Acción eliminada correctamente'
        ], 200);
    }
}
