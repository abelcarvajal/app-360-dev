<?php

namespace App\Http\Controllers;

use App\Models\Evaluacion;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Eval_;

class EvaluacionController extends Controller
{
    //
    public function getData(Request $request){

        $ev=Evaluacion::all();
        
        return response()->json([
            'status' => '200',
            'message' =>  'Data... ',
            'result' => $ev
        ]);
    }
    public function save(Request $request){

        $ev=Evaluacion::create([
            'fecha'=>$request->fecha,
            'id_colaboradores'=>$request->id_colab,
            'id_login'=>$request->id_login,
            'id_detalle_evaluacion'=>$request->id_det_ev
        ]);
        
        return response()->json([
            'status' => '200',
            'message' =>  'Guardado con éxito'
        ]);
    }

    public function update(Request $request){

        $ev=Evaluacion::FindOrFail($request->id);
        $ev->update([
            'fecha'=>$request->fecha,
            'id_colaboradores'=>$request->id_colab,
            'id_login'=>$request->id_login,
            'id_detalle_evaluacion'=>$request->id_det_ev
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
