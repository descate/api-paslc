<?php

namespace App\Http\Controllers;

use App\Models\EstadoSituacional;
use App\Models\EtapaProyecto;
use App\Models\TipoSituacion;
use App\Models\NivelAlerta;
use App\Models\EstadoAlerta;
use App\Models\Personal;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EstadoSituacionalController extends Controller
{
    /**
     * Obtener todos los estados situacionales con sus relaciones.
     */
    public function index(Request $request)
    {
        $query = EstadoSituacional::with([
            'etapaProyecto',
            'tipoSituacion',
            'nivelAlerta',
            'estadoAlerta',
            'responsable',
            'acciones.responsable',
            'acciones.estadoAlerta'
        ]);

        if ($request->has('etapa_proyecto_id')) {
            $query->where('etapa_proyecto_id', $request->etapa_proyecto_id);
        }

        $informes = $query->orderBy('fecha_reporte', 'desc')
                  ->orderBy('id', 'desc') // <-- EL DESEMPATE MÁGICO
                  ->get();

        return response()->json($informes);
    }

    /**
     * Guardar un nuevo estado situacional.
     */
    public function store(Request $request)
    {
        // 1. Configuramos la regla de unicidad condicional
        $uniqueRule = Rule::unique(EstadoSituacional::class, 'numero_informe');

        // Si el valor ingresado es 'N/A' (en mayúscula o minúscula), ignoramos la regla de único
        if (strtoupper($request->input('numero_informe')) === 'N/A') {
            $numeroInformeRules = ['required', 'string', 'max:150'];
        } else {
            $numeroInformeRules = ['required', 'string', 'max:150', $uniqueRule];
        }

        $validated = $request->validate([
            'etapa_proyecto_id'   => ['required', 'integer', Rule::exists(EtapaProyecto::class, 'id')],
            'numero_informe'      => $numeroInformeRules,
            'fecha_reporte'       => ['required', 'date'],
            'tipo_es_id'          => ['required', 'integer', Rule::exists(TipoSituacion::class, 'id')],
            'nivel_alerta_id'     => ['required', 'integer', Rule::exists(NivelAlerta::class, 'id')],
            'estado_alerta_id'    => ['required', 'integer', Rule::exists(EstadoAlerta::class, 'id')],
            'titulo'              => ['required', 'string', 'max:255'], // <--- Agregado a la validación
            'descripcion'         => ['required', 'string'],
            'responsable_id'      => ['required', 'integer', Rule::exists(Personal::class, 'id')]
        ]);

        $validated['es_reiterativo'] = $request->input('es_reiterativo', false);

        $informe = EstadoSituacional::create($validated);

        return response()->json([
            'message' => 'Estado situacional registrado correctamente',
            'data'    => $informe
        ], 201);
    }

    /**
     * Mostrar un estado situacional específico.
     */
    public function show($id)
    {
        $informe = EstadoSituacional::with([
            'etapaProyecto',
            'tipoSituacion',
            'nivelAlerta',
            'estadoAlerta',
            'responsable',
            'acciones.responsable',
            'acciones.estadoAlerta'
        ])->find($id);

        if (!$informe) {
            return response()->json([
                'message' => 'No se encontró ningún registro de Estado Situacional con este ID.'
            ], 404);
        }

        return response()->json($informe);
    }

    /**
     * Actualizar un estado situacional existente.
     */
    public function update(Request $request, $id)
    {
        $informe = EstadoSituacional::find($id);

        if (!$informe) {
            return response()->json([
                'message' => 'No se puede actualizar. El registro de Estado Situacional no existe.'
            ], 404);
        }

        // 1. Lógica condicional para el update
        if (strtoupper($request->input('numero_informe')) === 'N/A') {
            $numeroInformeRules = ['sometimes', 'required', 'string', 'max:150'];
        } else {
            $numeroInformeRules = [
                'sometimes', 'required', 'string', 'max:150',
                Rule::unique(EstadoSituacional::class, 'numero_informe')->ignore($id)
            ];
        }

        $validated = $request->validate([
            'etapa_proyecto_id'   => ['sometimes', 'required', 'integer', Rule::exists(EtapaProyecto::class, 'id')],
            'numero_informe'      => $numeroInformeRules,
            'fecha_reporte'       => ['sometimes', 'required', 'date'],
            'tipo_es_id'          => ['sometimes', 'required', 'integer', Rule::exists(TipoSituacion::class, 'id')],
            'nivel_alerta_id'     => ['sometimes', 'required', 'integer', Rule::exists(NivelAlerta::class, 'id')],
            'estado_alerta_id'    => ['sometimes', 'required', 'integer', Rule::exists(EstadoAlerta::class, 'id')],
            'titulo'              => ['sometimes', 'required', 'string', 'max:255'], // <--- Agregado a la validación
            'descripcion'         => ['sometimes', 'required', 'string'],
            'responsable_id'      => ['sometimes', 'required', 'integer', Rule::exists(Personal::class, 'id')]
        ]);

        $informe->update($validated);

        return response()->json([
            'message' => 'Estado situacional actualizado correctamente',
            'data'    => $informe
        ]);
    }

    /**
     * Eliminar un estado situacional.
     */
    public function destroy($id)
    {
        $informe = EstadoSituacional::find($id);

        if (!$informe) {
            return response()->json([
                'message' => 'No se puede eliminar. El registro de Estado Situacional no existe.'
            ], 404);
        }

        $informe->delete();

        return response()->json([
            'message' => 'Estado situacional eliminado correctamente'
        ], 200);
    }
}
