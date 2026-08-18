<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf; // Asegúrate de tener instalado barryvdh/laravel-dompdf

class AyudaMemoriaController extends Controller
{
    public function show($id)
    {
        try {
            // 1. Consultar los datos consolidados de la vista de base de datos
            $proyecto = DB::table('proyectos.vw_ayuda_memoria_proyecto')
                          ->where('proyecto_id', $id)
                          ->first();

            if (!$proyecto) {
                return response()->json([
                    'success' => false,
                    'message' => 'No se encontraron registros para la ayuda memoria de este proyecto.'
                ], 404);
            }

            // 2. Cargar una vista Blade con el formato de la ayuda memoria (ej: resources/views/pdf/ayuda-memoria.blade.php)
            $pdf = Pdf::loadView('pdf.ayuda-memoria', compact('proyecto'));

            // 3. Forzar la descarga del PDF en el navegador del cliente
            return $pdf->download("Ayuda_Memoria_CUI_{$proyecto->cui}.pdf");

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al generar el PDF de la ayuda memoria.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
