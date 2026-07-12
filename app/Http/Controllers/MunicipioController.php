<?php

namespace App\Http\Controllers;

use App\Models\Municipio;
use Illuminate\Http\Request;

class MunicipioController extends Controller
{
    //
    public function getData(Request $request){
        
        $mun=Municipio::all();

        return response()->json([
            'status' => '200',
            'message' =>  'Data... ',
            'result' => $mun
        ]);
    }
    //Método para obtener los municipios por departamento
    public function getDataByDepartamento($id_departamento){
        $municipio=Municipio::where('id_departamentos', $id_departamento)->get();
        return response()->json($municipio);
    }
    
    public function save(Request $request){
        
        $mun=Municipio::create([
            'nombre_municipio'=>$request->ciudad,
            'id_departamentos'=>$request->id_dep
        ]);

        return response()->json([
            'status' => '200',
            'message' =>  'Guardado con éxito'
        ]);
    }

    public function update(Request $request){
        
        $mun=Municipio::findOrFail($request->id);
        $mun->update([
            'nombre_municipio'=>$request->ciudad,
            'id_departamentos'=>$request->id_dep
        ]);

        return response()->json([
            'status' => '200',
            'message' =>  'Actualizado con éxito'
        ]);
    }

    public function delete(Request $request){
        
        $mun=Municipio::findOrFail($request->id);
        $mun->delete();

        return response()->json([
            'status' => '200',
            'message' =>  'Borrado con éxito'
        ]);
    }
}
