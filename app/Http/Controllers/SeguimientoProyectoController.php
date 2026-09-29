<?php

// app/Http/Controllers/SeguimientoProyectoController.php
namespace App\Http\Controllers;

use App\Models\SeguimientoProyecto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SeguimientoProyectoController extends Controller
{
    public function index(Request $request)
    {
        try {
            $query = SeguimientoProyecto::query();

            if ($request->filled('search')) {
                $search = $request->input('search');
                $query->where(function($q) use ($search) {
                    $q->where('cui', 'like', "%{$search}%")
                      ->orWhere('alias', 'like', "%{$search}%")
                      ->orWhere('descripcion', 'like', "%{$search}%");
                });
            }

            $proyectos = $query->get();

            return response()->json([
                'success' => true,
                'data' => $proyectos
            ]);

        } catch (\Exception $e) {
            Log::error('Error en SeguimientoProyectoController@index: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Ocurrió un error interno en el servidor.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $proyecto = SeguimientoProyecto::where('etapa_proyecto_id', $id)->first();

            if (!$proyecto) {
                return response()->json([
                    'success' => false,
                    'message' => 'Registro de seguimiento no encontrado para esta etapa'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'data' => $proyecto
            ]);

        } catch (\Exception $e) {
            Log::error('Error en SeguimientoProyectoController@show: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Ocurrió un error interno en el servidor.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
