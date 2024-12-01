<?php

namespace App\Http\Controllers;

use App\Models\Criterio;
use Illuminate\Http\Request;

class CriterioController extends Controller
{
    //
    public function getData(Request $request)
    {

        $criterio = Criterio::all();

        return response()->json([
            'status' => '200',
            'message' =>  'Data... ',
            'result' => $criterio
        ]);
    }
    public function save(Request $request)
    {

        $criterio = Criterio::create([
            'criterio' => $request->criterio,
            'id_categorias_criterios' => $request->id_cat_crit
        ]);

        return response()->json([
            'status' => '200',
            'message' =>  'Guardado con éxito'
        ]);
    }

    public function update(Request $request)
    {

        $criterio = Criterio::findOrFail($request->id);
        $criterio->update([
            'criterio' => $request->criterio 
            /* No agrego la llave foránea, ya que de acuerdo a las reglas del negocio, 
            en este punto sólo se necesitaría actualizar el criterio. */
        ]);
        return response()->json([
            'status' => '200',
            'message' =>  'Actualizado con éxito'
        ]);
    }

    public function delete(Request $request)
    {
        $criterio=Criterio::findOrFail($request->id);
        $criterio->delete();
        return response()->json([
            'status' => '200',
            'message' =>  'Borrado con éxito'
        ]);
    }
}
