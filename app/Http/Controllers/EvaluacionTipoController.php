<?php

namespace App\Http\Controllers;

use App\Models\EvaluacionTipo;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Eval_;

class EvaluacionTipoController extends Controller
{
    //
    public function getData(Request $request){

        $tipo_ev=EvaluacionTipo::all();
        
        return response()->json([
            'status' => '200',
            'message' =>  'Data... ',
            'result' => $tipo_ev
        ]);
    }
    public function save(Request $request){
        
        $tipo_ev=EvaluacionTipo::create([
            'tipo_evaluacion'=>$request->tipo
        ]);

        return response()->json([
            'status' => '200',
            'message' =>  'Guardado con éxito'
        ]);
    }

    public function update(Request $request){
        
        $tipo_ev=EvaluacionTipo::findOrFail($request->id);
        $tipo_ev->update([
            'tipo_evaluacion'=>$request->tipo
        ]);

        return response()->json([
            'status' => '200',
            'message' =>  'Actualizado con éxito'
        ]);
    }

    public function delete(Request $request){
        
        $tipo_ev=EvaluacionTipo::findOrFail($request->id);
        $tipo_ev->delete();

        return response()->json([
            'status' => '200',
            'message' =>  'Borrado con éxito'
        ]);
    }
}
