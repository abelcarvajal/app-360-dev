<?php

namespace App\Http\Controllers;

use App\Models\TipoDocumento;
use Illuminate\Http\Request;

class TipoDocumentoController extends Controller
{
    //
    public function getData(Request $request){

        $documento=TipoDocumento::all();
        
        return response()->json([
            'status' => '200',
            'message' =>  'Data... ',
            'result' => $documento
        ]);
    }
    public function save(Request $request){
        
        $documento=TipoDocumento::create([
            'tipo_documento'=>$request->tipo    
        ]);

        return response()->json([
            'status' => '200',
            'message' =>  'Guardado con éxito'
        ]);
    }

    public function update(Request $request){
        
        $documento=TipoDocumento::findOrFail($request->id);
        $documento->update([
            'tipo_documento'=>$request->tipo
        ]);
        return response()->json([
            'status' => '200',
            'message' =>  'Actualizado con éxito'
        ]);
    }

    public function delete(Request $request){
        
        $documento=TipoDocumento::findOrFail($request->id);
        $documento->delete();

        return response()->json([
            'status' => '200',
            'message' =>  'Borrado con éxito'
        ]);
    }
}
