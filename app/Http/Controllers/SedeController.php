<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SedeController extends Controller
{
    //
    public function getData(Request $request){
        
        return response()->json([
            'status' => '200',
            'message' =>  'Data... '
        ]);
    }
    public function save(Request $request){
        
        return response()->json([
            'status' => '200',
            'message' =>  'Guardado con éxito'
        ]);
    }

    public function update(Request $request){
        
        return response()->json([
            'status' => '200',
            'message' =>  'Actualizado con éxito'
        ]);
    }

    public function delete(Request $request){
        
        return response()->json([
            'status' => '200',
            'message' =>  'Borrado con éxito'
        ]);
    }
}
