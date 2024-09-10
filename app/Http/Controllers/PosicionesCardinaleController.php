<?php

namespace App\Http\Controllers;

use App\Models\PosicionesCardinale;
use Illuminate\Http\Request;

class PosicionesCardinaleController extends Controller
{
    //
    public function getData(Request $request){
        
        $cardinal=PosicionesCardinale::all();

        return response()->json([
            'status' => '200',
            'message' =>  'Data... ',
            'result' => $cardinal
        ]);
    }
    public function save(Request $request){
        
        $cardinal=PosicionesCardinale::create([
            'posicion_cardinal'=>$request->posicion
        ]);

        return response()->json([
            'status' => '200',
            'message' =>  'Guardado con éxito'
        ]);
    }

    public function update(Request $request){
        
        $cardinal=PosicionesCardinale::findOrFail($request->id);
        $cardinal->update([
            'posicion_cardinal'=>$request->posicion
        ]);

        return response()->json([
            'status' => '200',
            'message' =>  'Actualizado con éxito'
        ]);
    }

    public function delete(Request $request){
        
        $cardinal=PosicionesCardinale::findOrFail($request->id);
        $cardinal->delete();

        return response()->json([
            'status' => '200',
            'message' =>  'Borrado con éxito'
        ]);
    }
}
