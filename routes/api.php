<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarrioController;
use App\Http\Controllers\CargoController;
use App\Http\Controllers\CategoriasCriterioController;
use App\Http\Controllers\ColaboradorController;
use App\Http\Controllers\CriterioController;
use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\DetalleEvaluacionController;
use App\Http\Controllers\DirectionController;
use App\Http\Controllers\EvaluacionController;
use App\Http\Controllers\IdentificacionController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MunicipioController;
use App\Http\Controllers\PaisController;
use App\Http\Controllers\PosicionesCardinaleController;
use App\Http\Controllers\ProgramaController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SedeController;
use App\Http\Controllers\TipoDocumentoController;
use App\Http\Controllers\TiposViaController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::controller(BarrioController::class)->group(function(){
    Route::get('barrios/datos', 'getData');
    Route::post('barrios/guardar', 'save');
    Route::put('barrios/actualizar', 'update');
    Route::delete('barrios/borrar', 'delete');
});

Route::controller(CargoController::class)->group(function(){
    Route::get('cargos/datos', 'getData');
    Route::post('cargos/guardar', 'save');
    Route::put('cargos/actualizar', 'update');
    Route::delete('cargos/borrar', 'delete');
});

Route::controller(CategoriasCriterioController::class)->group(function(){
    Route::get('categorias/datos', 'getData');
    Route::post('categorias/guardar', 'save');
    Route::put('categorias/actualizar', 'update');
    Route::delete('categorias/borrar', 'delete');
});

Route::controller(ColaboradorController::class)->group(function(){
    Route::get('colaborador/datos', 'getData');
    Route::post('colaborador/guardar', 'save');
    Route::put('colaborador/actualizar', 'update');
    Route::delete('colaborador/borrar', 'delete');
});

Route::controller(CriterioController::class)->group(function(){
    Route::get('criterio/datos', 'getData');
    Route::post('criterio/guardar', 'save');
    Route::put('criterio/actualizar', 'update');
    Route::delete('criterio/borrar', 'delete');
});

Route::controller(DepartamentoController::class)->group(function(){
    Route::get('departamento/datos', 'getData');
    Route::post('departamento/guardar', 'save');
    Route::put('departamento/actualizar', 'update');
    Route::delete('departamento/borrar', 'delete');
});

Route::controller(DetalleEvaluacionController::class)->group(function(){
    Route::get('detalle/datos', 'getData');
    Route::post('detalle/guardar', 'save');
    Route::put('detalle/actualizar', 'update');
    Route::delete('detalle/borrar', 'delete');
});

Route::controller(DirectionController::class)->group(function(){
    Route::get('direccion/datos', 'getData');
    Route::post('direccion/guardar', 'save');
    Route::put('direccion/actualizar', 'update');
    Route::delete('direccion/borrar', 'delete');
});

Route::controller(EvaluacionController::class)->group(function(){
    Route::get('evaluacion/datos', 'getData');
    Route::post('evaluacion/guardar', 'save');
    Route::put('evaluacion/actualizar', 'update');
    Route::delete('evaluacion/borrar', 'delete');
});

Route::controller(IdentificacionController::class)->group(function(){
    Route::get('identificacion/datos', 'getData');
    Route::post('identificacion/guardar', 'save');
    Route::put('identificacion/actualizar', 'update');
    Route::delete('identificacion/borrar', 'delete');
});

Route::controller(LoginController::class)->group(function(){
    Route::get('login/datos', 'getData');
    Route::post('login/guardar', 'save');
    Route::put('login/actualizar', 'update');
    Route::delete('login/borrar', 'delete');
});

Route::controller(MunicipioController::class)->group(function(){
    Route::get('municipio/datos', 'getData');
    Route::post('municipio/guardar', 'save');
    Route::put('municipio/actualizar', 'update');
    Route::delete('municipio/borrar', 'delete');
});

Route::controller(PaisController::class)->group(function(){
    Route::get('pais/datos', 'getData');
    Route::post('pais/guardar', 'save');
    Route::put('pais/actualizar', 'update');
    Route::delete('pais/borrar', 'delete');
});

Route::controller(PosicionesCardinaleController::class)->group(function(){
    Route::get('cardinales/datos', 'getData');
    Route::post('cardinales/guardar', 'save');
    Route::put('cardinales/actualizar', 'update');
    Route::delete('cardinales/borrar', 'delete');
});

Route::controller(ProgramaController::class)->group(function(){
    Route::get('programa/datos', 'getData');
    Route::post('programa/guardar', 'save');
    Route::put('programa/actualizar', 'update');
    Route::delete('programa/borrar', 'delete');
});

Route::controller(RoleController::class)->group(function(){
    Route::get('rol/datos', 'getData');
    Route::post('rol/guardar', 'save');
    Route::put('rol/actualizar', 'update');
    Route::delete('rol/borrar', 'delete');
});

Route::controller(SedeController::class)->group(function(){
    Route::get('sede/datos', 'getData');
    Route::post('sede/guardar', 'save');
    Route::put('sede/actualizar', 'update');
    Route::delete('sede/borrar', 'delete');
});

Route::controller(TipoDocumentoController::class)->group(function(){
    Route::get('tipodoc/datos', 'getData');
    Route::post('tipodoc/guardar', 'save');
    Route::put('tipodoc/actualizar', 'update');
    Route::delete('tipodoc/borrar', 'delete');
});

Route::controller(TiposViaController::class)->group(function(){
    Route::get('tipovia/datos', 'getData');
    Route::post('tipovia/guardar', 'save');
    Route::put('tipovia/actualizar', 'update');
    Route::delete('tipovia/borrar', 'delete');
});