<?php

namespace App\Http\Controllers;

use App\Models\Direction;
use Illuminate\Http\Request;

class DirectionController extends Controller
{
    //
    public function getData(Request $request){

        $direction=Direction::all();
        
        return response()->json([
            'status' => '200',
            'message' =>  'Data... ',
            'result' => $direction
        ]);
    }
    public function save(Request $request){

        $direction=Direction::create([
            'id_tipos_via'=>$request->id_tipos_via,
            'numero_via'=>$request->num_via,
            'numero'=>$request->numero,
            'id_barrios'=>$request->id_barrio,
            'id_posiciones_cardinales'=>$request->id_pos_card

        ]);
        
        return response()->json([
            'status' => '200',
            'message' =>  'Guardado con éxito'
        ]);
    }

    public function update(Request $request){

        $direction=Direction::FindOrFail($request->id);
        $direction->update([
            'id_tipos_via'=>$request->id_tipos_via,
            'numero_via'=>$request->num_via,
            'numero'=>$request->numero,
            'id_barrios'=>$request->id_barrio,
            'id_posiciones_cardinales'=>$request->id_pos_card
        ]);
        
        return response()->json([
            'status' => '200',
            'message' =>  'Actualizado con éxito'
        ]);
    }

    public function delete(Request $request){

        $direction=Direction::FindOrFail($request->id);
        $direction->delete();
        
        return response()->json([
            'status' => '200',
            'message' =>  'Borrado con éxito'
        ]);
    }
}
