<?php

namespace App\Http\Controllers;

use App\Models\Barrio;
use Illuminate\Http\Request;

class BarrioController extends Controller
{
    //
    public function getData(Request $request){

        $barrio=Barrio::all();
        
        return response()->json([
            'status' => '200',
            'message' =>  'Data... ',
            'result' => $barrio
        ]);
    }
    public function save(Request $request){
        
        $barrio=Barrio::create([
            'nombre_barrio'=>$request->barrio,
            'id_municipios'=>$request->id_mun
        ]);

        return response()->json([
            'status' => '200',
            'message' =>  'Guardado con éxito'
        ]);
    }

    public function update(Request $request){

        $barrio=Barrio::FindOrFail($request->id);
        $barrio->update([
            'nombre_barrio'=>$request->barrio,
            'id_municipios'=>$request->id_mun
        ]);
        
        return response()->json([
            'status' => '200',
            'message' =>  'Actualizado con éxito'
        ]);
    }

    public function delete(Request $request){

        $barrio=Barrio::FindOrFail($request->id);
        $barrio->delete();
        
        return response()->json([
            'status' => '200',
            'message' =>  'Borrado con éxito'
        ]);
    }

}
