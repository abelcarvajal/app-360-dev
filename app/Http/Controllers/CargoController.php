<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cargo;
use LDAP\Result;

class CargoController extends Controller
{
    //
    public function getData(Request $request){
        
        $nombre_cargo=Cargo::all();

        return response()->json([
            'status' => '200',
            'message' =>  'Data... ',
            'result' => $nombre_cargo
        ]);
    }
    public function save(Request $request){
        
        $cargo=Cargo::create([
            'nombre_cargo'=>$request->nombre_cargo,
        ]);

        return response()->json([
            'status' => '200',
            'message' =>  'Guardado con éxito'
        ]);
    }

    public function update(Request $request){
        
        $cargo=Cargo::findOrFail($request->id);

        $cargo->update([
            'nombre_cargo'=>$request->nombre,
        ]);

        return response()->json([
            'status' => '200',
            'message' =>  'Actualizado con éxito'
        ]);
    }

    public function delete(Request $request){
        
        $cargo=Cargo::findOrFail($request->id);
        
        $cargo->delete();

        return response()->json([
            'status' => '200',
            'message' =>  'Borrado con éxito'
        ]);
    }
}
