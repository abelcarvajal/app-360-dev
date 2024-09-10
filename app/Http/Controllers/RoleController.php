<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    //
    public function getData(Request $request){
        
        $rol=Role::all();

        return response()->json([
            'status' => '200',
            'message' =>  'Data... ',
            'result' => $rol
        ]);
    }
    public function save(Request $request){

        $rol=Role::create([
            'rol'=>$request->rol
        ]);
        
        return response()->json([
            'status' => '200',
            'message' =>  'Guardado con éxito'
        ]);
    }

    public function update(Request $request){
        
        $rol=Role::findOrFail($request->id);

        $rol->update([
            'rol'=>$request->rol
        ]);

        return response()->json([
            'status' => '200',
            'message' =>  'Actualizado con éxito'
        ]);
    }

    public function delete(Request $request){
        
        $rol=Role::findOrFail($request->id);
        $rol->delete();
        return response()->json([
            'status' => '200',
            'message' =>  'Borrado con éxito'
        ]);
    }
}
