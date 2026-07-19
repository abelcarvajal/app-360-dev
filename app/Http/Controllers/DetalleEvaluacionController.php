<?php

namespace App\Http\Controllers;

use App\Models\DetalleEvaluacion;
use App\Models\Evaluacion;
use Illuminate\Http\Request;

class DetalleEvaluacionController extends Controller
{
    public function getData(Request $request){

        $colaborador = $request->user()->colaborador;

        $query = DetalleEvaluacion::query();

        $alcance = $colaborador->alcanceEvaluacionIds();
        if ($alcance !== null) {
            $query->whereHas('evaluacion', function ($q) use ($alcance) {
                $q->whereIn('id_colaboradores', $alcance);
            });
        }

        $detalle = $query->get();

        return response()->json([
            'status' => '200',
            'message' =>  'Data... ',
            'result' => $detalle
        ]);
    }
    public function save(Request $request){

        $request->validate([
            'valoracion' => 'required|integer|min:1|max:5',
            'id_criterio' => 'required|exists:items_evaluacion,id',
            'id_evaluacion' => 'required|exists:evaluacions,id'
        ]);

        $colaborador = $request->user()->colaborador;
        $evaluacion = Evaluacion::findOrFail($request->id_evaluacion);

        if (!$colaborador->puedeAccederAColaborador((int) $evaluacion->id_colaboradores)) {
            abort(403, 'No tienes permisos para esta acción');
        }

        $detalle = DetalleEvaluacion::create([
            'valoracion'=>$request->valoracion,
            'id_criterios'=>$request->id_criterio,
            'id_evaluacion'=>$request->id_evaluacion
        ]);

        return response()->json([
            'status' => '200',
            'message' =>  'Guardado con éxito',
            'result' => $detalle
        ]);
    }

    public function update(Request $request){

        $request->validate([
            'id' => 'required|integer|exists:detalle_evaluacions,id',
            'valoracion' => 'required|integer|min:1|max:5',
            'id_criterio' => 'required|exists:items_evaluacion,id',
            'id_evaluacion' => 'required|exists:evaluacions,id'
        ]);

        $colaborador = $request->user()->colaborador;
        $detalle=DetalleEvaluacion::FindOrFail($request->id);
        $evaluacionActual = $detalle->evaluacion;
        $evaluacionNueva = Evaluacion::findOrFail($request->id_evaluacion);

        if (!$colaborador->puedeAccederAColaborador((int) $evaluacionActual->id_colaboradores)
            || !$colaborador->puedeAccederAColaborador((int) $evaluacionNueva->id_colaboradores)) {
            abort(403, 'No tienes permisos para esta acción');
        }

        $detalle->update([
            'valoracion'=>$request->valoracion,
            'id_criterios'=>$request->id_criterio,
            'id_evaluacion'=>$request->id_evaluacion
        ]);

        return response()->json([
            'status' => '200',
            'message' =>  'Actualizado con éxito'
        ]);
    }

    public function delete(Request $request){

        $request->validate([
            'id' => 'required|integer|exists:detalle_evaluacions,id',
        ]);

        $colaborador = $request->user()->colaborador;
        $detalle=DetalleEvaluacion::FindOrFail($request->id);

        if (!$colaborador->puedeAccederAColaborador((int) $detalle->evaluacion->id_colaboradores)) {
            abort(403, 'No tienes permisos para esta acción');
        }

        $detalle->delete();

        return response()->json([
            'status' => '200',
            'message' =>  'Borrado con éxito'
        ]);
    }
}
