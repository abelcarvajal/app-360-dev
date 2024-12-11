<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\CategoriasCriterio;
use App\Models\Criterio;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;



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

    public function update(Request $request, $id)
{
    try {
        Log::info('Iniciando actualización de categoría ID: ' . $id, $request->all());
        
        $request->validate([
            'categoria' => ['required', 'string', 'max:255', Rule::unique('categorias_criterios')->ignore($id)],
            'descripcion' => 'required|string',
            'criterio1' => 'required|string',
            'criterio2' => 'required|string',
            'criterio3' => 'required|string',
            'criterio4' => 'required|string',
            'criterio5' => 'required|string'
        ]);

        DB::beginTransaction();
        
        $categoria = CategoriasCriterio::findOrFail($id);
        
        // Actualizar la categoría
        $categoria->update($request->only(['categoria', 'descripcion']));

        // Actualizar criterios existentes en lugar de eliminarlos
        // Removemos el orderBy('orden') ya que la columna no existe
        $criterios = $categoria->criterios()->get();
        $nuevosValores = [
            $request->criterio1,
            $request->criterio2,
            $request->criterio3,
            $request->criterio4,
            $request->criterio5
        ];

        foreach ($criterios as $index => $criterio) {
            if (isset($nuevosValores[$index])) {
                $criterio->update([
                    'criterio' => $nuevosValores[$index]
                ]);
            }
        }

        // Si hay menos criterios existentes que nuevos, crear los faltantes
        $criteriosExistentes = $criterios->count();
        for ($i = $criteriosExistentes; $i < count($nuevosValores); $i++) {
            $categoria->criterios()->create([
                'criterio' => $nuevosValores[$i]
                // Removemos el campo 'orden' ya que no existe en la tabla
            ]);
        }

        DB::commit();

        return response()->json([
            'status' => '200',
            'message' => 'Categoría y criterios actualizados correctamente'
        ]);

    } catch (ValidationException $e) {
        DB::rollBack();
        return response()->json([
            'status' => '422',
            'message' => 'Error de validación',
            'errors' => $e->errors()
        ], 422);
    } catch (\Exception $e) {
        DB::rollBack();
        Log::error('Error al actualizar categoría: ' . $e->getMessage());
        return response()->json([
            'status' => '500',
            'message' => 'Error al actualizar la categoría: ' . $e->getMessage()
        ], 500);
    }
}

    public function destroy($id)
    {
        try {
            Log::info('Iniciando eliminación de categoría ID: ' . $id);
            
            $categoria = CategoriasCriterio::with('criterios')->findOrFail($id);
            
            // Verificar si hay criterios relacionados
            $criteriosCount = $categoria->criterios->count();
            Log::info('Criterios encontrados para eliminar: ' . $criteriosCount);
            
            DB::beginTransaction();
            try {
                // Eliminar primero los criterios
                $categoria->criterios()->delete();
                // Luego eliminar la categoría
                $categoria->delete();
                
                DB::commit();
                
                return response()->json([
                    'status' => '200',
                    'message' => 'Categoría y ' . $criteriosCount . ' criterios eliminados correctamente'
                ]);
                
            } catch (\Exception $e) {
                DB::rollBack();
                throw $e;
            }
            
        } catch (\Exception $e) {
            Log::error('Error al eliminar categoría: ' . $e->getMessage());
            return response()->json([
                'status' => '500',
                'message' => 'Error al eliminar la categoría y criterios',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
