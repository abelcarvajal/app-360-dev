<?php

namespace App\Http\Controllers;

use App\Models\Identificacion;
use Illuminate\Http\Request;

class IdentificacionController extends Controller
{
    //
    public function getData(Request $request){

        $identidad=Identificacion::all();
        
        return response()->json([
            'status' => '200',
            'message' =>  'Data... ',
            'result'=> $identidad
        ]);
    }
    public function save(Request $request){
        
        $identidad=Identificacion::create([
            'id_tipos_documento'=>$request->id_tipo,
            'numero_identidad'=>$request->numero,
            'id_municipios'=>$request->id_mun,
            'fecha_expedicion'=>$request->fecha
        ]);

        return response()->json([
            'status' => '200',
            'message' =>  'Guardado con éxito'
        ]);
    }

    public function update(Request $request){
        
        $identidad=Identificacion::FindOrFail($request->id);
        $identidad->update([
            'id_tipos_documento'=>$request->id_tipo,
            'numero_identidad'=>$request->numero,
            'id_municipios'=>$request->id_mun,
            'fecha_expedicion'=>$request->fecha
        ]);
        return response()->json([
            'status' => '200',
            'message' =>  'Actualizado con éxito'
        ]);
    }

    public function delete(Request $request){

        $identidad=Identificacion::FindOrFail($request->id);
        $identidad->delete();
        
        return response()->json([
            'status' => '200',
            'message' =>  'Borrado con éxito'
        ]);
    }
}
