<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\MetaFisica;
use App\Models\EtapaProyecto;
use App\Models\ProyectoInversion;
use App\Models\TipoMetaFisica;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MetaFisicaController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $request->validate([
            'etapa_proyecto_id' => [
                'required',
                'integer',
                function ($attribute, $value, $fail) {
                    if (!EtapaProyecto::where('id', $value)->exists()) {
                        $fail('La etapa de proyecto seleccionada no es válida.');
                    }
                }
            ]
        ]);

        $metas = MetaFisica::with('tipoMeta:id,codigo,nombre,unidad_medida')
            ->where('etapa_proyecto_id', $request->query('etapa_proyecto_id'))
            ->get();

        return response()->json([
            'success' => true,
            'total'   => $metas->count(),
            'data'    => $metas,
        ]);
    }

    public function storeOrUpdate(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'proyecto_id' => [
                'required',
                'integer',
                function ($attribute, $value, $fail) {
                    if (!ProyectoInversion::where('id', $value)->exists()) {
                        $fail('El proyecto no existe.');
                    }
                }
            ],
            'tipo_meta_id' => [
                'required',
                'integer',
                function ($attribute, $value, $fail) {
                    if (!TipoMetaFisica::where('id', $value)->exists()) {
                        $fail('El tipo de meta no existe.');
                    }
                }
            ],
            'cantidad' => 'required|numeric|min:0',
            'etapa_proyecto_id' => [
                'nullable',
                'integer',
                function ($attribute, $value, $fail) {
                    if ($value && !EtapaProyecto::where('id', $value)->exists()) {
                        $fail('La etapa de proyecto no existe.');
                    }
                }
            ],
        ]);

        $meta = MetaFisica::updateOrCreate(
            [
                'proyecto_id'  => $validated['proyecto_id'],
                'tipo_meta_id' => $validated['tipo_meta_id'],
            ],
            [
                'cantidad'          => $validated['cantidad'],
                'etapa_proyecto_id' => $validated['etapa_proyecto_id'] ?? null,
            ]
        );

        return response()->json([
            'success' => true,
            'message' => 'Meta física guardada correctamente.',
            'data'    => $meta->load('tipoMeta:id,codigo,nombre,unidad_medida'),
        ]);
    }

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
