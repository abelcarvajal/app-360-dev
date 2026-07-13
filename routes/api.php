<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CargoController;
use App\Http\Controllers\CategoriasCriterioController;
use App\Http\Controllers\ColaboradorController;
use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\DetalleEvaluacionController;
use App\Http\Controllers\EvaluacionController;
use App\Http\Controllers\EvaluacionTipoController;
use App\Http\Controllers\ItemEvaluacionController;
use App\Http\Controllers\MunicipioController;
use App\Http\Controllers\PaisController;
use App\Http\Controllers\ProgramaController;
use App\Http\Controllers\CentroCostoController;
use App\Http\Controllers\TipoDocumentoController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Rutas públicas (solo auth)
Route::post('auth/login', [AuthController::class, 'login']);

//Rutas protegidas (requieren autenticación)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('auth/logout', [AuthController::class, 'logout']);
    Route::get('auth/me', [AuthController::class, 'me']);
    Route::post('auth/cambiar-password', [AuthController::class, 'cambiarPassword']);

    // Catálogos (solo lectura para usuarios normales)
    Route::get('pais/datos', [PaisController::class, 'getData']);
    Route::get('departamento/datos/{id_pais}', [DepartamentoController::class, 'getDataByPais']);
    Route::get('municipio/datos/{id_departamento}', [MunicipioController::class, 'getDataByDepartamento']);
    Route::get('cargos/datos', [CargoController::class, 'getData']);
    Route::get('programa/datos', [ProgramaController::class, 'getData']);
    Route::get('centro_costo/datos', [CentroCostoController::class, 'getData']);
    Route::get('tipodoc/datos', [TipoDocumentoController::class, 'getData']);
    Route::get('categorias/datos', [CategoriasCriterioController::class, 'index']);
    Route::get('items/datos', [ItemEvaluacionController::class, 'index']);
    Route::get('tipos/datos', [EvaluacionTipoController::class, 'index']);

    // Colaboradores — lectura para cualquier autenticado
    Route::get('colaborador/datos', [ColaboradorController::class, 'index']);
    Route::get('colaborador/dataById/{id}', [ColaboradorController::class, 'show']);

    // Evaluaciones
    Route::get('evaluacion/datos', [EvaluacionController::class, 'getData']);
    Route::post('evaluacion/guardar', [EvaluacionController::class, 'save']);
    Route::put('evaluacion/actualizar', [EvaluacionController::class, 'update']);
    Route::delete('evaluacion/borrar', [EvaluacionController::class, 'delete']);

    // Detalle evaluación
    Route::get('detalle/datos', [DetalleEvaluacionController::class, 'getData']);
    Route::post('detalle/guardar', [DetalleEvaluacionController::class, 'save']);
    Route::put('detalle/actualizar', [DetalleEvaluacionController::class, 'update']);
    Route::delete('detalle/borrar', [DetalleEvaluacionController::class, 'delete']);

    // Gestión de criterios — solo psicólogo y admin
    Route::middleware('rol:psicologo,admin')->group(function () {
        Route::post('categorias/guardar', [CategoriasCriterioController::class, 'store']);
        Route::put('categorias/actualizar/{id}', [CategoriasCriterioController::class, 'update']);
        Route::delete('categorias/borrar/{id}', [CategoriasCriterioController::class, 'destroy']);

        Route::post('items/guardar', [ItemEvaluacionController::class, 'store']);
        Route::put('items/actualizar/{id}', [ItemEvaluacionController::class, 'update']);
        Route::patch('items/estado/{id}', [ItemEvaluacionController::class, 'cambiarEstado']);
    });

    // Gestión de colaboradores y catálogos — solo admin
    Route::middleware('rol:admin')->group(function () {
        Route::post('colaborador/guardar', [ColaboradorController::class, 'store']);
        Route::put('colaborador/actualizar/{id}', [ColaboradorController::class, 'update']);
        Route::patch('colaborador/estado/{id}', [ColaboradorController::class, 'cambiarEstado']);

        Route::post('cargos/guardar', [CargoController::class, 'save']);
        Route::put('cargos/actualizar', [CargoController::class, 'update']);
        Route::delete('cargos/borrar', [CargoController::class, 'delete']);
    });
});


