<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategoriasCriterio;

class CategoriasCriterioController extends Controller
{
    //
    public function getData(Request $request){
        
        $categorias=CategoriasCriterio::all();

        return response()->json([
            'status' => '200',
            'message' =>  'Data... ',
            'result' => $categorias
        ]);
    }
    public function save(Request $request){
        
        $categoria=CategoriasCriterio::create([
            'categoria_criterios'=>$request->categoria,
            'descripcion'=>$request->descripcion
        ]);

        return response()->json([
            'status' => '200',
            'message' =>  'Guardado con éxito'
        ]);
    }

    public function update(Request $request){

        $categoria=CategoriasCriterio::findOrFail($request->id);

        $categoria->update([
            'categoria_criterios'=>$request->categoria,
            'descripcion'=>$request->descripcion
        ]);
        
        return response()->json([
            'status' => '200',
            'message' =>  'Actualizado con éxito'
        ]);
    }

    public function delete(Request $request){

        $categoria=CategoriasCriterio::findOrFail($request->id);
        $categoria->delete();
        
        return response()->json([
            'status' => '200',
            'message' =>  'Borrado con éxito'
        ]);
    }
}
