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
use App\Http\Controllers\ContratoController;
use App\Http\Controllers\ValorizacionProgramadaController;
// Nuevos controladores importados
use App\Http\Controllers\EstadoValorizacionController;
use App\Http\Controllers\ValorizacionEjecutadaController;
use App\Http\Controllers\MetaFisicaController;
use App\Http\Controllers\AyudaMemoriaController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::resource('/obra', ObraController::class);
Route::get('/seguimiento-proyectos', [SeguimientoProyectoController::class, 'index']);
Route::get('/dashboard/kpis', [DashboardController::class, 'getKpis']);

// Rutas para la gestión de Proyectos de Inversión [cite: 21]
Route::apiResource('proyectos', ProyectoInversionController::class);

// Rutas para los Catálogos de Etapas y Estados [cite: 22, 23]
Route::apiResource('etapas-pi', TipoEtapaPiController::class);
Route::apiResource('estados-gestion', EstadoGestionController::class);

// Rutas para el Control de Gastos [cite: 24]
Route::apiResource('control-gasto', ControlGastoController::class);
Route::get('/contratos', [ContratoController::class, 'index']);
Route::get('/contratos/{id}', [ContratoController::class, 'show']);
Route::apiResource('valorizaciones-programadas', ValorizacionProgramadaController::class);

Route::get('/metas-fisicas', [MetaFisicaController::class, 'index']);
Route::get('/proyectos/{id}/ayuda-memoria', [AyudaMemoriaController::class, 'show']);
// Rutas para las Valorizaciones Ejecutadas
Route::apiResource('estados-valorizacion', EstadoValorizacionController::class);
Route::apiResource('valorizaciones-ejecutadas', ValorizacionEjecutadaController::class);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::post('/logout', [AuthController::class, 'logout']);
});
