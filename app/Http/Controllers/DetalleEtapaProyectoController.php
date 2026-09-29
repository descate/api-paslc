<?php

namespace App\Http\Controllers;

use App\Models\EtapaProyecto;
use App\Models\ContratoProyecto;
use App\Models\ValorizacionProgramada;
use App\Models\ValorizacionEjecutada;
use Illuminate\Http\JsonResponse;

class DetalleEtapaProyectoController extends Controller
{
    public function show($etapa_proyecto_id): JsonResponse
    {
        // 1. Obtener los datos principales de la etapa con sus relaciones
        $etapa = EtapaProyecto::with(['proyecto', 'tipoEtapa', 'estadoGestion'])
            ->find($etapa_proyecto_id);

        if (!$etapa) {
            return response()->json([
                'success' => false,
                'message' => 'Etapa de proyecto no encontrada'
            ], 404);
        }

        // 2. Obtener el contrato activo asociado a esta etapa (ej. roles 1 o 2)
        $contratoActivo = ContratoProyecto::where('etapa_proyecto_id', $etapa_proyecto_id)
            ->whereIn('rol_contrato_id', [1, 2])
            ->where('estado_contrato', true)
            ->first();

        $programadas = [];
        $ejecutadas = [];

        // 3. Si existe contrato, obtenemos la información para la Curva S y valorizaciones
        if ($contratoActivo) {
            $programadas = ValorizacionProgramada::where('contrato_id', $contratoActivo->id)
                ->orderBy('anio')
                ->orderBy('mes')
                ->get();

            $ejecutadas = ValorizacionEjecutada::where('contrato_id', $contratoActivo->id)
                ->orderBy('anio')
                ->orderBy('mes')
                ->get();
        }

        // 4. Retornar el paquete consolidado para el Dashboard
        return response()->json([
            'success' => true,
            'data' => [
                'etapa'           => $etapa,
                'proyecto'        => $etapa->proyecto,
                'tipo_etapa'      => $etapa->tipoEtapa,
                'estado_gestion'  => $etapa->estadoGestion,
                'contrato_activo' => $contratoActivo,
                'curva_s' => [
                    'programadas' => $programadas,
                    'ejecutadas'  => $ejecutadas,
                ]
            ]
        ]);
    }
}
