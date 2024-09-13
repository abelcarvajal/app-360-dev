<?php

namespace App\Http\Controllers;

use App\Models\Colaborador;
use Illuminate\Http\Request;

class ColaboradorController extends Controller
{
    //
    public function getData(Request $request){

        $colaborador=Colaborador::all();
        
        return response()->json([
            'status' => '200',
            'message' =>  'Data... ',
            'result' => $colaborador
        ]);
    }
    public function save(Request $request){
        
        $colaborador=Colaborador::create([
            'nombres'=>$request->nombres,
            'apellidos'=>$request->apellidos,
            'id_identificacion'=>$request->id_ident,
            'id_direcciones'=>$request->id_dir,
            'telefono_fijo'=>$request->tel_fijo,
            'celular'=>$request->movil,
            'email'=>$request->correo,
            'fecha_nacimiento'=>$request->birthday,
            'id_cargos'=>$request->id_cargo,
            'id_sedes'=>$request->id_sede,
            'id_programas'=>$request->id_programa
        ]);

        return response()->json([
            'status' => '200',
            'message' =>  'Guardado con éxito'
        ]);
    }

    public function update(Request $request){

        $colaborador=Colaborador::FindOrFail($request->id);
        $colaborador->update([
            'nombres'=>$request->nombres,
            'apellidos'=>$request->apellidos,
            'id_identificacion'=>$request->id_ident,
            'id_direcciones'=>$request->id_dir,
            'telefono_fijo'=>$request->tel_fijo,
            'celular'=>$request->movil,
            'email'=>$request->correo,
            'fecha_nacimiento'=>$request->birthday,
            'id_cargos'=>$request->id_cargo,
            'id_sedes'=>$request->id_sede,
            'id_programas'=>$request->id_programa
        ]);
        
        return response()->json([
            'status' => '200',
            'message' =>  'Actualizado con éxito'
        ]);
    }

    public function delete(Request $request){

        $colaborador=Colaborador::FindOrFail($request->id);
        $colaborador->delete();
        
        return response()->json([
            'status' => '200',
            'message' =>  'Borrado con éxito'
        ]);
    }
}
