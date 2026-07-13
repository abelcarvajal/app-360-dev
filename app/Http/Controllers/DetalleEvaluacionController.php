<?php

namespace App\Http\Controllers;

use App\Models\DetalleEvaluacion;
use Egulias\EmailValidator\Result\Reason\DetailedReason;
use Illuminate\Http\Request;

class DetalleEvaluacionController extends Controller
{
    //
    public function getData(Request $request){

        $detalle=DetalleEvaluacion::all();
        
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

        $detalle=DetalleEvaluacion::FindOrFail($request->id);
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

        $detalle=DetalleEvaluacion::FindOrFail($request->id);
        $detalle->delete();
        
        return response()->json([
            'status' => '200',
            'message' =>  'Borrado con éxito'
        ]);
    }
}
