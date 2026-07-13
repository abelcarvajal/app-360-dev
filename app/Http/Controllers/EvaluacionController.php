<?php

namespace App\Http\Controllers;

use App\Models\Evaluacion;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Eval_;

class EvaluacionController extends Controller
{
    //
    public function getData(){

        $ev=Evaluacion::with(['colaborador','evaluacion_tipos', 'detalle_evaluacion.item'])->get();
        $ev->map(function($evaluacion){
            return [
                'id' => $evaluacion->id,
                'created_at' => $evaluacion->created_at,
                'colaborador' => $evaluacion->colaborador->nombres . ' ' . $evaluacion->colaborador->apellidos,
                'tipo_evaluacion' => $evaluacion->evaluacion_tipos->tipo_evaluacion,
                'detalle_evaluacion' => $evaluacion->detalle_evaluacion
            ];
        });

        return response()->json([
            'status' => '200',
            'message' =>  'Evaluaciones obtenidas con éxito',
            'result' => $ev
        ]);
    }
    public function save(Request $request){

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

        $ev=Evaluacion::FindOrFail($request->id);
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

        $ev=Evaluacion::FindOrFail($request->id);
        $ev->delete();
        
        return response()->json([
            'status' => '200',
            'message' =>  'Borrado con éxito'
        ]);
    }
}
