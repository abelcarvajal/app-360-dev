<?php

namespace App\Http\Controllers;

use App\Models\Colaborador;
use App\Models\Evaluacion;
use Illuminate\Http\Request;

class EvaluacionController extends Controller
{
    public function getData(Request $request){

        $colaborador = $request->user()->colaborador;

        $query = Evaluacion::with(['colaborador', 'evaluacion_tipos', 'detalle_evaluacion.item']);

        $alcance = $colaborador->alcanceEvaluacionIds();
        if ($alcance !== null) {
            $query->whereIn('id_colaboradores', $alcance);
        }

        $ev = $query->get();

        return response()->json([
            'status' => '200',
            'message' =>  'Evaluaciones obtenidas con éxito',
            'result' => $ev
        ]);
    }
    public function save(Request $request){

        $request->validate([
            'id_colab' => 'required|integer|exists:colaboradors,id',
            'id_tipo_ev' => 'required|integer|exists:evaluacion_tipos,id',
            'fecha' => 'nullable|date',
        ]);

        $colaborador = $request->user()->colaborador;
        $colaboradorEvaluado = Colaborador::findOrFail($request->id_colab);

        if (!$colaboradorEvaluado->puedeSerEvaluado()) {
            abort(403, 'Este módulo no está habilitado para el usuario actual');
        }

        if (!$colaborador->puedeAccederAColaborador((int) $request->id_colab)) {
            abort(403, 'No tienes permisos para esta acción');
        }

        $ev=Evaluacion::create([
            'id_colaboradores'=>$request->id_colab,
            'id_evaluacion_tipos'=>$request->id_tipo_ev,
            'created_at'=>$request->fecha
        ]);

        return response()->json([
            'status' => '200',
            'message' =>  'Guardado con éxito',
            'result'=>$ev
        ]);
    }

    public function update(Request $request){

        $request->validate([
            'id' => 'required|integer|exists:evaluacions,id',
            'id_colab' => 'required|integer|exists:colaboradors,id',
            'id_tipo_ev' => 'required|integer|exists:evaluacion_tipos,id',
            'fecha' => 'nullable|date',
        ]);

        $colaborador = $request->user()->colaborador;
        $ev=Evaluacion::FindOrFail($request->id);
        $colaboradorEvaluado = Colaborador::findOrFail($request->id_colab);

        if (!$colaboradorEvaluado->puedeSerEvaluado()) {
            abort(403, 'Este módulo no está habilitado para el usuario actual');
        }

        if (!$colaborador->puedeAccederAColaborador((int) $ev->id_colaboradores)
            || !$colaborador->puedeAccederAColaborador((int) $request->id_colab)) {
            abort(403, 'No tienes permisos para esta acción');
        }

        $ev->update([
            'created_at'=>$request->fecha,
            'id_colaboradores'=>$request->id_colab,
            'id_evaluacion_tipos'=>$request->id_tipo_ev
        ]);

        return response()->json([
            'status' => '200',
            'message' =>  'Actualizado con éxito'
        ]);
    }

    public function delete(Request $request){

        $request->validate([
            'id' => 'required|integer|exists:evaluacions,id',
        ]);

        $colaborador = $request->user()->colaborador;
        $ev=Evaluacion::FindOrFail($request->id);

        if (!$colaborador->puedeAccederAColaborador((int) $ev->id_colaboradores)) {
            abort(403, 'No tienes permisos para esta acción');
        }

        $ev->delete();

        return response()->json([
            'status' => '200',
            'message' =>  'Borrado con éxito'
        ]);
    }
}
