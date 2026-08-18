<?php

namespace App\Http\Controllers;

use App\Models\ValorizacionProgramada;
use App\Models\ProyectoInversion;
use App\Models\Contrato;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ValorizacionProgramadaController extends Controller
{
    public function index(Request $request)
    {
        // Iniciamos la consulta seleccionando todos los campos y calculando los acumulados
        $query = ValorizacionProgramada::query()
            ->select([
                '*',
                // Window Function para el Monto Acumulado
                DB::raw('SUM(monto) OVER (PARTITION BY contrato_id ORDER BY anio, mes) as monto_acumulado'),

                // Window Function para el % de Avance Acumulado
                DB::raw('SUM(por_avance_fisico) OVER (PARTITION BY contrato_id ORDER BY anio, mes) as por_avance_fisico_acumulado')
            ]);

        // Filtros cruzados esenciales
        if ($request->has('proyecto_id')) {
            $query->where('proyecto_id', $request->proyecto_id);
        }
        if ($request->has('contrato_id')) {
            $query->where('contrato_id', $request->contrato_id);
        }
        if ($request->has('anio')) {
            $query->where('anio', $request->anio);
        }

        // Ejecutamos la consulta y ordenamos cronológicamente
        $valorizaciones = $query->orderBy('anio')->orderBy('mes')->get();

        return response()->json($valorizaciones);
    }

    public function store(Request $request)
    {
        // Actualizamos las validaciones de las llaves foráneas
        $validated = $request->validate([
            'proyecto_id' => [
                'required',
                'integer',
                Rule::exists(ProyectoInversion::class, 'id') // <-- Solución para el esquema
            ],
            'contrato_id' => [
                'required',
                'integer',
                Rule::exists(Contrato::class, 'id') // <-- Solución para el esquema
            ],
            'anio' => 'required|integer',
            'mes' => 'required|integer|min:1|max:12',
            'monto' => 'required|numeric',
            'por_avance_fisico' => 'required|numeric|min:0|max:100'
        ]);

        $valorizacion = ValorizacionProgramada::create($validated);

        return response()->json($valorizacion, 201);
    }

    public function show($id)
    {
        $valorizacion = ValorizacionProgramada::findOrFail($id);
        return response()->json($valorizacion);
    }

    public function update(Request $request, $id)
    {
        $valorizacion = ValorizacionProgramada::findOrFail($id);
        $valorizacion->update($request->all());
        return response()->json($valorizacion);
    }

    public function destroy($id)
    {
        $valorizacion = ValorizacionProgramada::findOrFail($id);
        $valorizacion->delete();
        return response()->json(null, 204);
    }
}
