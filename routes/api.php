<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ObraController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SeguimientoProyectoController;
use App\Http\Controllers\DashboardController;

use App\Http\Controllers\ProyectoInversionController;
use App\Http\Controllers\TipoEtapaPiController;
use App\Http\Controllers\EstadoGestionController;
use App\Http\Controllers\ControlGastoController;
use App\Http\Controllers\ContratoProyectoController;
use App\Http\Controllers\ValorizacionProgramadaController;
use App\Http\Controllers\EstadoValorizacionController;
use App\Http\Controllers\ValorizacionEjecutadaController;
use App\Http\Controllers\MetaFisicaController;
use App\Http\Controllers\AyudaMemoriaController;
use App\Http\Controllers\EtapaProyectoController;
use App\Http\Controllers\EstadoSituacionalController;
use App\Http\Controllers\AccionEstadoSituacionalController;
use App\Http\Controllers\CatalogoController;
use App\Http\Controllers\DetalleEtapaProyectoController;
use App\Http\Controllers\UserController;

// ==========================================
// RUTAS PÚBLICAS (Sin sesión)
// ==========================================
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


// ==========================================
// RUTAS PROTEGIDAS (Requieren Token de Angular)
// ==========================================
Route::middleware('auth:sanctum')->group(function () {

    // Auth
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::post('/logout', [AuthController::class, 'logout']);

    // Catálogos Generales
    Route::get('/catalogos', [CatalogoController::class, 'index']);

    // Dashboard y KPIs
    Route::get('/dashboard/kpis', [DashboardController::class, 'getKpis']);

    // Obras y Seguimiento
    Route::resource('/obra', ObraController::class);
    Route::get('/seguimiento-proyectos', [SeguimientoProyectoController::class, 'index']);
    Route::get('/seguimiento-proyectos/{id}', [SeguimientoProyectoController::class, 'show']);

    // Proyectos de Inversión
    Route::apiResource('proyectos', ProyectoInversionController::class);
    Route::get('/proyectos/{id}/ayuda-memoria', [AyudaMemoriaController::class, 'show']);

    // Etapas del Proyecto
    Route::get('/etapas-proyecto/proyecto/{proyecto_id}', [EtapaProyectoController::class, 'getByProyecto']);
    Route::get('/etapas-proyecto/{id}/dashboard-completo', [DetalleEtapaProyectoController::class, 'show']);
    Route::apiResource('etapas-proyecto', EtapaProyectoController::class);

    // Catálogos de Etapas y Estados
    Route::apiResource('etapas-pi', TipoEtapaPiController::class);
    Route::apiResource('estados-gestion', EstadoGestionController::class);

    // Control de Gastos y Contratos
    Route::apiResource('control-gasto', ControlGastoController::class);
    Route::get('/contratos-proyecto/etapa/{etapa_proyecto_id}', [ContratoProyectoController::class, 'getByEtapa']);

    // Valorizaciones
    Route::apiResource('valorizaciones-programadas', ValorizacionProgramadaController::class);
    Route::apiResource('estados-valorizacion', EstadoValorizacionController::class);
    Route::apiResource('valorizaciones-ejecutadas', ValorizacionEjecutadaController::class);

    // Metas Físicas
    Route::get('/metas-fisicas', [MetaFisicaController::class, 'index']);

    // Estado Situacional
    Route::apiResource('estado-situacional', EstadoSituacionalController::class);
    Route::apiResource('acciones-estado-situacional', AccionEstadoSituacionalController::class);

    // Rutas de Administración
    Route::apiResource('usuarios', UserController::class);
});
