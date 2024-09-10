<?php

namespace App\Http\Controllers;

use App\Models\Programa;
use Illuminate\Http\Request;

class ProgramaController extends Controller
{
    //
    public function getData(Request $request){

        $programa=Programa::all();
        
        return response()->json([
            'status' => '200',
            'message' =>  'Data... ',
            'result' => $programa
        ]);
    }
    public function save(Request $request){
        
        $programa=Programa::create([
            'nombre_programa'=>$request->programa
        ]);

        return response()->json([
            'status' => '200',
            'message' =>  'Guardado con éxito'
        ]);
    }

    public function update(Request $request){
        
        $programa=Programa::findOrFail($request->id);
        $programa->update([
            'nombre_programa'=>$request->programa
        ]);

        return response()->json([
            'status' => '200',
            'message' =>  'Actualizado con éxito'
        ]);
    }

    public function delete(Request $request){
        
        $programa=Programa::findOrFail($request->id);
        $programa->delete();
        
        return response()->json([
            'status' => '200',
            'message' =>  'Borrado con éxito'
        ]);
    }
}
