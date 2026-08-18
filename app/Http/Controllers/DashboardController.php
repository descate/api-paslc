<?php

namespace App\Http\Controllers;

use App\Models\MetaFisica;
use App\Models\ProyectoInversion; // <-- Importante: Importar el modelo
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function getKpis(Request $request)
    {
        // 1. Calcular Total de Beneficiarios
        $totalBeneficiarios = MetaFisica::whereHas('tipoMeta', function ($query) {
            $query->where('codigo', 'BENEF');
        })->sum('cantidad');

        // 2. Calcular Total de Conexiones Nuevas
        $totalConexionesNuevas = MetaFisica::whereHas('tipoMeta', function ($query) {
            $query->whereIn('codigo', ['CONEX_AGUA_NUEVA', 'CONEX_ALC_NUEVA']);
        })->sum('cantidad');

        // 3. NUEVO: Total de Proyectos (Cartera)
        $totalProyectos = ProyectoInversion::count();

        // 4. NUEVO: Inversión Total (Sumatoria del monto de inversión)
        $montoInversion = ProyectoInversion::sum('monto_inversion');

        return response()->json([
            'success' => true,
            'data' => [
                'total_beneficiarios' => (float) $totalBeneficiarios,
                'total_conexiones_nuevas' => (float) $totalConexionesNuevas,
                'total_proyectos' => $totalProyectos,
                'monto_inversion' => (float) $montoInversion
            ]
        ]);
    }
}
