<?php

namespace App\Http\Controllers;

use App\Models\DetalleEvaluacion;
use Egulias\EmailValidator\Result\Reason\DetailedReason;
use Illuminate\Http\Request;

class DetalleEvaluacionController extends Controller
{
    //
    public function getData(Request $request){

        $detallev=DetalleEvaluacion::all();
        
        return response()->json([
            'status' => '200',
            'message' =>  'Data... ',
            'result' => $detallev
        ]);
    }
    public function save(Request $request){

        $detallev=DetalleEvaluacion::create([
            'valoracion'=>$request->val,
            'id_criterios'=>$request->id_criterio
        ]);
        
        return response()->json([
            'status' => '200',
            'message' =>  'Guardado con éxito'
        ]);
    }

    public function update(Request $request){

        $detallev=DetalleEvaluacion::FindOrFail($request->id);
        $detallev->update([
            'valoracion'=>$request->val,
            'id_criterios'=>$request->id_criterio
        ]);
        
        return response()->json([
            'status' => '200',
            'message' =>  'Actualizado con éxito'
        ]);
    }

    public function delete(Request $request){

        $detallev=DetalleEvaluacion::FindOrFail($request->id);
        $detallev->delete();
        
        return response()->json([
            'status' => '200',
            'message' =>  'Borrado con éxito'
        ]);
    }
}
