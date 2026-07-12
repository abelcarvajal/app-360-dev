<?php

namespace App\Http\Controllers;

use App\Models\CentroCosto;
use Illuminate\Http\Request;

class CentroCostoController extends Controller
{
    public function getData(Request $request){
        $centroCosto = CentroCosto::all();
        
        return response()->json([
            'status' => '200',
            'message' => 'Data...',
            'result' => $centroCosto
        ]);
    }

    public function save(Request $request){
        $centroCosto = CentroCosto::create([
            'nombre_centro_costo' => $request->nombre_centro_costo
        ]);

        return response()->json([
            'status' => '200',
            'message' => 'Guardado con éxito'
        ]);
    }

    public function update(Request $request){
        $centroCosto = CentroCosto::findOrFail($request->id);
        $centroCosto->update([
            'nombre_centro_costo' => $request->nombre_centro_costo
        ]);

        return response()->json([
            'status' => '200',
            'message' => 'Actualizado con éxito'
        ]);
    }

    public function delete(Request $request){
        $centroCosto = CentroCosto::findOrFail($request->id);
        $centroCosto->delete();

        return response()->json([
            'status' => '200',
            'message' => 'Borrado con éxito'
        ]);
    }
}