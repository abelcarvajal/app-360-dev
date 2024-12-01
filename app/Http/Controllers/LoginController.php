<?php

namespace App\Http\Controllers;

use App\Models\Login;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    //
    public function getData(Request $request){

        $login=Login::all();
        
        return response()->json([
            'status' => '200',
            'message' =>  'Data... ',
            'result' => $login
        ]);
    }
    public function save(Request $request){

        $login=Login::create([
            'usuario'=>$request->usuario,
            'contrasena'=>$request->contrasena,
            'id_roles'=>$request->id_rol,
            'id_colaboradores'=>$request->id_colab
        ]);
        
        return response()->json([
            'status' => '200',
            'message' =>  'Guardado con éxito'
        ]);
    }

    public function update(Request $request){

        $login=Login::findOrFail($request->id);
        $login->update([
            'usuario'=>$request->usuario,
            'contrasena'=>$request->contrasena,
            'id_roles'=>$request->id_rol,
            'id_colaboradores'=>$request->id_colab
        ]);
        
        return response()->json([
            'status' => '200',
            'message' =>  'Actualizado con éxito'
        ]);
    }

    public function delete(Request $request){

        $login=Login::findOrFail($request->id);
        $login->delete();
        
        return response()->json([
            'status' => '200',
            'message' =>  'Borrado con éxito'
        ]);
    }
}
