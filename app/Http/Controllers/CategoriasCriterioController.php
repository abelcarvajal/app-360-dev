<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\CategoriasCriterio;
use Illuminate\Support\Facades\Log;

class CategoriasCriterioController extends Controller
{
    public function index()
    {
        $categorias = CategoriasCriterio::with('items.niveles')->get();

        return response()->json([
            'status' => '200',
            'message' => 'Categorías obtenidas exitosamente',
            'result' => $categorias
        ]);
    }

    public function show($id)
    {
        try {
            $categoria = CategoriasCriterio::with('items.niveles')->findOrFail($id);
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

    public function store(Request $request)
    {
        try {
            $request->validate([
                'categoria' => ['required', 'string', 'max:255', Rule::unique('categorias_criterios')],
                'descripcion' => 'required|string',
            ]);

            $categoria = CategoriasCriterio::create($request->only(['categoria', 'descripcion']));

            Log::info('Categoría creada con ID: ' . $categoria->id);

            return response()->json(['message' => 'Categoría creada correctamente'], 201);

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
            $request->validate([
                'categoria' => ['required', 'string', 'max:255', Rule::unique('categorias_criterios')->ignore($id)],
                'descripcion' => 'required|string',
            ]);

            $categoria = CategoriasCriterio::findOrFail($id);
            $categoria->update($request->only(['categoria', 'descripcion']));

            return response()->json([
                'status' => '200',
                'message' => 'Categoría actualizada correctamente'
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => '422',
                'message' => 'Error de validación',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
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
            $categoria = CategoriasCriterio::findOrFail($id);
            $categoria->delete();

            return response()->json([
                'status' => '200',
                'message' => 'Categoría eliminada correctamente'
            ]);

        } catch (\Exception $e) {
            Log::error('Error al eliminar categoría: ' . $e->getMessage());
            return response()->json([
                'status' => '500',
                'message' => 'Error al eliminar la categoría',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
