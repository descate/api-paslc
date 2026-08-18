<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Contrato;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ContratoController extends Controller
{
    /**
     * Muestra una lista de los contratos.
     * Soporta un parámetro opcional para filtrar por proyecto.
     * Ejemplo: GET /api/contratos?proyecto_id=5
     */
    public function index(Request $request): JsonResponse
    {
        $query = Contrato::query();

        if ($request->has('proyecto_id')) {
            $query->where('proyecto_id', $request->query('proyecto_id'));
        }

        // Obtener la data (podrías usar ->paginate() en lugar de ->get() si hay muchos)
        $contratos = $query->get();

        return response()->json([
            'success' => true,
            'total'   => $contratos->count(),
            'data'    => $contratos
        ]);
    }

    /**
     * Muestra un contrato en específico.
     */
    public function show($id): JsonResponse
    {
        $contrato = Contrato::find($id);

        if (!$contrato) {
            return response()->json([
                'success' => false,
                'message' => 'Contrato no encontrado'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data'    => $contrato
        ]);
    }

    /**
     * Almacena un contrato recién creado en la base de datos.
     */
    public function store(Request $request): JsonResponse
    {
        // Reglas de validación basadas en tu estructura SQL (NOT NULL y tipos de datos)
        $validatedData = $request->validate([
            'proyecto_id'      => 'required|integer',
            'rol_contrato_id'  => 'required|integer',
            'razon_social'     => 'required|string|max:200',
            'ruc'              => 'nullable|string|max:11',
            'numero_contrato'  => 'required|string|max:40',
            'fecha_firma'      => 'nullable|date',
            'monto_contractual'=> 'required|numeric|min:0',
            'plazo_contractual'=> 'required|integer|min:0',
            // El resto de los campos son opcionales según la estructura SQL
            'finicio_contractual'        => 'nullable|date',
            'ffin_contractual'           => 'nullable|date',
            'plazo_vigente'              => 'nullable|integer',
            'ffin_vigente'               => 'nullable|date',
            'ffin_programada'            => 'nullable|date',
            'modalidad_ejecucion_id'     => 'nullable|integer',
            'procedimiento_seleccion_id' => 'nullable|integer',
            'modalidad_contratacion_id'  => 'nullable|integer',
            'sistema_contratacion_id'    => 'nullable|integer',
            'estado_id'                  => 'nullable|integer',
        ]);

        try {
            $contrato = Contrato::create($validatedData);

            return response()->json([
                'success' => true,
                'message' => 'Contrato creado exitosamente',
                'data'    => $contrato
            ], 201);

        } catch (\Exception $e) {
            // Manejo de errores (por ejemplo, violación de la regla UNIQUE uq_proyecto_rol_contrato)
            return response()->json([
                'success' => false,
                'message' => 'Error al crear el contrato: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Actualiza el contrato especificado en la base de datos.
     */
    public function update(Request $request, $id): JsonResponse
    {
        $contrato = Contrato::find($id);

        if (!$contrato) {
            return response()->json([
                'success' => false,
                'message' => 'Contrato no encontrado'
            ], 404);
        }

        // Las mismas reglas de validación, pero permitiendo campos parciales (a veces es necesario)
        $validatedData = $request->validate([
            'proyecto_id'      => 'sometimes|required|integer',
            'rol_contrato_id'  => 'sometimes|required|integer',
            'razon_social'     => 'sometimes|required|string|max:200',
            'ruc'              => 'nullable|string|max:11',
            'numero_contrato'  => 'sometimes|required|string|max:40',
            'fecha_firma'      => 'nullable|date',
            'monto_contractual'=> 'sometimes|required|numeric|min:0',
            'plazo_contractual'=> 'sometimes|required|integer|min:0',
            'finicio_contractual'        => 'nullable|date',
            'ffin_contractual'           => 'nullable|date',
            'plazo_vigente'              => 'nullable|integer',
            'ffin_vigente'               => 'nullable|date',
            'ffin_programada'            => 'nullable|date',
            'modalidad_ejecucion_id'     => 'nullable|integer',
            'procedimiento_seleccion_id' => 'nullable|integer',
            'modalidad_contratacion_id'  => 'nullable|integer',
            'sistema_contratacion_id'    => 'nullable|integer',
            'estado_id'                  => 'nullable|integer',
        ]);

        try {
            $contrato->update($validatedData);

            return response()->json([
                'success' => true,
                'message' => 'Contrato actualizado exitosamente',
                'data'    => $contrato
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar el contrato: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Elimina el contrato especificado.
     */
    public function destroy($id): JsonResponse
    {
        $contrato = Contrato::find($id);

        if (!$contrato) {
            return response()->json([
                'success' => false,
                'message' => 'Contrato no encontrado'
            ], 404);
        }

        try {
            $contrato->delete();

            return response()->json([
                'success' => true,
                'message' => 'Contrato eliminado exitosamente'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar el contrato: ' . $e->getMessage()
            ], 500);
        }
    }
}
