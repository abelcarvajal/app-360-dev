<?php

namespace App\Http\Controllers;

use App\Models\Departamento;
use Illuminate\Http\Request;

class DepartamentoController extends Controller
{
    //
    public function getData(Request $request){
        
        $departamento=Departamento::all();

        return response()->json([
            'status' => '200',
            'message' =>  'Data... ',
            'result' => $departamento
        ]);
    }
    public function save(Request $request){
        
        $departamento=Departamento::create([
            'nombre_departamento'=>$request->departamento,
            'id_pais'=>$request->id_pais
        ]);
        return response()->json([
            'status' => '200',
            'message' =>  'Guardado con éxito'
        ]);
    }

    public function update(Request $request){
        
        $departamento=Departamento::findOrFail($request->id);
        $departamento->update([
            'nombre_departamento'=>$request->departamento,
            'id_pais'=>$request->id_pais
        ]);
        return response()->json([
            'status' => '200',
            'message' =>  'Actualizado con éxito'
        ]);
    }

    public function delete(Request $request){
        
        $departamento=Departamento::findOrFail($request->id);
        $departamento->delete();
        
        return response()->json([
            'status' => '200',
            'message' =>  'Borrado con éxito'
        ]);
    }
}
