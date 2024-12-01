<?php

namespace App\Http\Controllers;

use App\Models\Pais;
use Illuminate\Http\Request;

class PaisController extends Controller
{
    //
    public function getData(Request $request){
        
        $pais=Pais::all();

        return response()->json([
            'status' => '200',
            'message' =>  'Data... ',
            'result' => $pais
        ]);
    }
    public function save(Request $request){
        
        $pais=Pais::create([
            'nombre_pais'=>$request->pais
        ]);

        return response()->json([
            'status' => '200',
            'message' =>  'Guardado con éxito'
        ]);
    }

    public function update(Request $request){
        
        $pais=Pais::findOrFail($request->id);
        $pais->update([
            'nombre_pais'=>$request->pais
        ]);
        return response()->json([
            'status' => '200',
            'message' =>  'Actualizado con éxito'
        ]);
    }

    public function delete(Request $request){
        
        $pais=Pais::findOrFail($request->id);
        $pais->delete();

        return response()->json([
            'status' => '200',
            'message' =>  'Borrado con éxito'
        ]);
    }
}
