<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VwSeguimientoProyecto;

class SeguimientoProyectoController extends Controller
{
    /**
     * Obtiene la lista completa de seguimiento de proyectos desde la vista, ordenada por alias.
     */
    public function index()
    {
        try {
            // Consulta a la vista ordenada por alias alfabéticamente (A-Z)
            $proyectos = VwSeguimientoProyecto::orderBy('alias', 'asc')->get();

            return response()->json([
                'success' => true,
                'data'    => $proyectos,
                'message' => 'Proyectos obtenidos exitosamente'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'data'    => [],
                'message' => 'Error al obtener los proyectos: ' . $e->getMessage()
            ], 500);
        }
    }
}
