<?php

namespace App\Http\Controllers;

use App\Models\ContratoProyecto;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ContratoProyectoController extends Controller
{
    /**
     * Obtener contratos filtrados por etapa_proyecto_id, rol_contrato (1 o 2) y estado_contrato activo (true/1).
     * Ruta de ejemplo: GET /api/contratos-proyecto/etapa/5
     */
    public function getByEtapa($etapa_proyecto_id): JsonResponse
    {
        $contratos = ContratoProyecto::where('etapa_proyecto_id', $etapa_proyecto_id)
            ->whereIn('rol_contrato_id', [1, 2])
            ->where('estado_contrato', true)
            ->with(['etapaProyecto', 'proyectoInversion'])
            ->get();

        return response()->json([
            'success' => true,
            'total'   => $contratos->count(),
            'data'    => $contratos,
        ]);
    }

    /**
     * Listar todos los contratos.
     */
    public function index(): JsonResponse
    {
        $contratos = ContratoProyecto::with(['etapaProyecto', 'proyectoInversion'])->get();

        return response()->json([
            'success' => true,
            'total'   => $contratos->count(),
            'data'    => $contratos,
        ]);
    }

    /**
     * Crear un nuevo contrato.
     */
    public function store(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'proyecto_id'                => 'required|integer',
            'etapa_proyecto_id'          => 'required|integer',
            'rol_contrato_id'            => 'required|integer',
            'numero_contrato'            => 'required|string|max:100',
            'nombre_contratista'         => 'required|string|max:200',
            'ruc_contratista'            => 'nullable|string|max:11',
            'fecha_firma'                => 'nullable|date',
            'monto_contractual'          => 'required|numeric',
            'plazo_contractual'          => 'required|integer',
            'finicio_contractual'        => 'nullable|date',
            'ffin_contractual'           => 'nullable|date',
            'plazo_vigente'              => 'nullable|integer',
            'ffin_vigente'               => 'nullable|date',
            'modalidad_ejecucion_id'     => 'nullable|integer',
            'procedimiento_seleccion_id' => 'nullable|integer',
            'modalidad_contratacion_id'  => 'nullable|integer',
            'sistema_contratacion_id'    => 'nullable|integer',
            'estado_contrato'            => 'nullable|boolean',
        ]);

        $contrato = ContratoProyecto::create($validatedData);

        return response()->json([
            'success' => true,
            'message' => 'Contrato creado correctamente.',
            'data'    => $contrato,
        ], 201);
    }

    /**
     * Mostrar un contrato específico por su ID.
     */
    public function show($id): JsonResponse
    {
        $contrato = ContratoProyecto::with(['etapaProyecto', 'proyectoInversion'])->findOrFail($id);

        return response()->json([
            'success' => true,
            'data'    => $contrato,
        ]);
    }

    /**
     * Actualizar un contrato existente.
     */
    public function update(Request $request, $id): JsonResponse
    {
        $contrato = ContratoProyecto::findOrFail($id);

        $validatedData = $request->validate([
            'proyecto_id'                => 'sometimes|required|integer',
            'etapa_proyecto_id'          => 'sometimes|required|integer',
            'rol_contrato_id'            => 'sometimes|required|integer',
            'numero_contrato'            => 'sometimes|required|string|max:100',
            'nombre_contratista'         => 'sometimes|required|string|max:200',
            'ruc_contratista'            => 'nullable|string|max:11',
            'fecha_firma'                => 'nullable|date',
            'monto_contractual'          => 'sometimes|required|numeric',
            'plazo_contractual'          => 'sometimes|required|integer',
            'finicio_contractual'        => 'nullable|date',
            'ffin_contractual'           => 'nullable|date',
            'plazo_vigente'              => 'nullable|integer',
            'ffin_vigente'               => 'nullable|date',
            'modalidad_ejecucion_id'     => 'nullable|integer',
            'procedimiento_seleccion_id' => 'nullable|integer',
            'modalidad_contratacion_id'  => 'nullable|integer',
            'sistema_contratacion_id'    => 'nullable|integer',
            'estado_contrato'            => 'nullable|boolean',
        ]);

        $contrato->update($validatedData);

        return response()->json([
            'success' => true,
            'message' => 'Contrato actualizado correctamente.',
            'data'    => $contrato,
        ]);
    }

    /**
     * Eliminar un contrato.
     */
    public function destroy($id): JsonResponse
    {
        $contrato = ContratoProyecto::findOrFail($id);
        $contrato->delete();

        return response()->json([
            'success' => true,
            'message' => 'Contrato eliminado correctamente.',
        ]);
    }
}
