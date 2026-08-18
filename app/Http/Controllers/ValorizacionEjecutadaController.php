<?php

namespace App\Http\Controllers;

use App\Models\ValorizacionEjecutada;
use App\Models\Contrato;
use App\Models\ProyectoInversion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class ValorizacionEjecutadaController extends Controller
{
    public function index(Request $request)
    {
        $query = ValorizacionEjecutada::query()
            ->with('estadoValorizacion')
            ->select([
                '*',
                // Window Functions para calcular acumulados ejecutados mágicamente desde Postgres
                DB::raw('SUM(monto) OVER (PARTITION BY contrato_id ORDER BY anio, mes) as monto_acumulado'),
                DB::raw('SUM(por_avance_fisico) OVER (PARTITION BY contrato_id ORDER BY anio, mes) as por_avance_fisico_acumulado')
            ]);
        
        if ($request->has('contrato_id')) {
            $query->where('contrato_id', $request->contrato_id);
        }

        $valorizaciones = $query->orderBy('anio')->orderBy('mes')->get();
        return response()->json($valorizaciones);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'proyecto_id' => ['required', 'integer', Rule::exists(ProyectoInversion::class, 'id')],
            'contrato_id' => ['required', 'integer', Rule::exists(Contrato::class, 'id')],
            'anio' => 'required|integer',
            'mes' => 'required|integer|min:1|max:12',
            'monto' => 'required|numeric',
            'por_avance_fisico' => 'required|numeric|min:0|max:100',
            'fecha_presentacion' => 'nullable|date',
            'estado_valorizacion_id' => 'nullable|integer'
        ]);

        $valorizacion = ValorizacionEjecutada::create($validated);
        
        return response()->json($valorizacion, 201);
    }
}