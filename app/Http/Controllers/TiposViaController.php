<?php

namespace App\Http\Controllers;

use App\Models\TiposVia;
use Illuminate\Http\Request;

class TiposViaController extends Controller
{
    //
    public function getData(Request $request){
        
        $via=TiposVia::all();

        return response()->json([
            'status' => '200',
            'message' =>  'Data... ',
            'result' => $via
        ]);
    }
    public function save(Request $request){
        
        $via=TiposVia::create([
            'tipo_via'=>$request->via
        ]);

        return response()->json([
            'status' => '200',
            'message' =>  'Guardado con éxito'
        ]);
    }

    public function update(Request $request){

        $via=TiposVia::findOrFail($request->id);
        $via->update([
            'tipo_via'=>$request->via
        ]);

        return response()->json([
            'status' => '200',
            'message' =>  'Actualizado con éxito'
        ]);
    }

    public function delete(Request $request){
        
        $via=TiposVia::findOrFail($request->id);
        $via->delete();
        
        return response()->json([
            'status' => '200',
            'message' =>  'Borrado con éxito'
        ]);
    }
}
