<?php

namespace App\Http\Controllers;

use App\Models\Sede;
use Illuminate\Http\Request;

class SedeController extends Controller
{
    //
    public function getData(Request $request){

        $sede=Sede::all();
        
        return response()->json([
            'status' => '200',
            'message' =>  'Data... ',
            'result' => $sede
        ]);
    }
    public function save(Request $request){
        
        $sede=Sede::create([
            'nombre_sede'=>$request->nombre
        ]);

        return response()->json([
            'status' => '200',
            'message' =>  'Guardado con éxito'
        ]);
    }

    public function update(Request $request){
        
        $sede=Sede::findOrFail($request->id);
        $sede->update([
            'nombre_sede'=>$request->nombre
        ]);

        return response()->json([
            'status' => '200',
            'message' =>  'Actualizado con éxito'
        ]);
    }

    public function delete(Request $request){
        
        $sede=Sede::findOrFail($request->id);
        $sede->delete();

        return response()->json([
            'status' => '200',
            'message' =>  'Borrado con éxito'
        ]);
    }
}
