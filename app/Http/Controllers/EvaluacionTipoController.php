<?php

namespace App\Http\Controllers;

use App\Models\EvaluacionTipo;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Eval_;

class EvaluacionTipoController extends Controller
{
    //
    public function index(){

        $tipo=EvaluacionTipo::select('id','tipo_evaluacion')->get();
        
        return response()->json([
            'status' => '200',
            'message' =>  'Tipos de evaluación ob',
            'result' => $tipo
        ]);
    }
    public function save(Request $request){
        
        $tipo=EvaluacionTipo::create([
            'tipo_evaluacion'=>$request->tipo
        ]);

        return response()->json([
            'status' => '200',
            'message' =>  'Guardado con éxito'
        ]);
    }

    public function update(Request $request){
        
        $tipo=EvaluacionTipo::findOrFail($request->id);
        $tipo->update([
            'tipo_evaluacion'=>$request->tipo
        ]);

        return response()->json([
            'status' => '200',
            'message' =>  'Actualizado con éxito'
        ]);
    }

    public function delete(Request $request){
        
        $tipo=EvaluacionTipo::findOrFail($request->id);
        $tipo->delete();

        return response()->json([
            'status' => '200',
            'message' =>  'Borrado con éxito'
        ]);
    }
}
