<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\CategoriasCriterio;
use App\Models\Criterio;
use Illuminate\Support\Facades\Log;



class CategoriasCriterioController extends Controller

{
    //Cambié el método getData por index, ya que me devuelve las v¿categorías con los criterios asociados.
    public function index()
    {
        $categorias = CategoriasCriterio::with('criterios')->get();
        
        return response()->json([
            'status' => '200',
            'message' => 'Categorías obtenidas exitosamente',
            'result' => $categorias
        ]);
    }

    /*Cambié el método save por store, ya que store me permite guardar además los criterios asociados*/
    public function store(Request $request)
    {
        try {
            $request->validate([
                'categoria' => ['required', 'string', 'max:255', Rule::unique('categorias_criterios')],
                'descripcion' => 'required|string',
                'criterio1' => 'required|string',
                'criterio2' => 'required|string',
                'criterio3' => 'required|string',
                'criterio4' => 'required|string',
                'criterio5' => 'required|string'
            ]);

            $categoria = CategoriasCriterio::create($request->only(['categoria', 'descripcion']));
            
            Log::info('Categoría creada con ID: ' . $categoria->id);

            foreach ($request->only(['criterio1', 'criterio2', 'criterio3', 'criterio4', 'criterio5']) as $criterioData) {
                Criterio::create([
                    'criterio' => $criterioData,
                    'id_categorias_criterios' => $categoria->id
                ]);
            }

            return response()->json(['message' => 'Categoría y criterios creados correctamente'], 201);

        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile()
            ], 500);
        }
    }
    
    public function show($id)
    {
        try {
            $categoria = CategoriasCriterio::with('criterios')->findOrFail($id);
            
            return response()->json([
                'status' => '200',
                'message' => 'Categoría obtenida exitosamente',
                'result' => $categoria
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'status' => '500',
                'message' => 'Error al obtener la categoría',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'categoria' => ['required', 'string', 'max:255', Rule::unique('categoria_criterios')->ignore($id)],
            'descripcion' => 'required|string',
            'criterio1' => 'required|string',
            'criterio2' => 'required|string',
            'criterio3' => 'required|string',
            'criterio4' => 'required|string',
            'criterio5' => 'required|string'
        ]);

        $categoria = CategoriasCriterio::findOrFail($id);

        $categoria->update($request->only(['categoria', 'descripcion']));

        $criteriosData = $request->only(['criterio1', 'criterio2', 'criterio3', 'criterio4', 'criterio5']);
        $categoria->criterios()->delete(); // Eliminar criterios existentes
        foreach ($criteriosData as $criterioData) {
            $categoria->criterios()->create(['criterio' => $criterioData]);
        }

        return response()->json([
            'status' => '200',
            'message' => 'Categoría y criterios actualizados correctamente'
        ]);
    }

    public function destroy($id)
    {
        $categoria = CategoriasCriterio::findOrFail($id);
        $categoria->criterios()->delete(); // Eliminar criterios relacionados
        $categoria->delete();
        
        return response()->json([
            'status' => '200',
            'message' => 'Categoría y criterios eliminados correctamente'
        ]);
    }
}
