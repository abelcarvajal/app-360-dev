<?php

namespace App\Http\Controllers;

use App\Models\ItemEvaluacion;
use App\Models\ItemNivel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class ItemEvaluacionController extends Controller
{
    private const REGLAS_NIVELES = [
        'niveles' => 'required|array|size:5',
        'niveles.*.nivel' => 'required|integer|between:1,5|distinct',
        'niveles.*.descripcion' => 'required|string',
    ];

    public function index(Request $request)
    {
        $items = ItemEvaluacion::with('niveles')
            ->when($request->id_categoria, fn ($query, $idCategoria) => $query->where('id_categorias_criterios', $idCategoria))
            ->get();

        return response()->json([
            'status' => '200',
            'message' => 'Ítems obtenidos exitosamente',
            'result' => $items
        ]);
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate(array_merge([
                'nombre' => 'required|string|max:255',
                'descripcion' => 'required|string',
                'id_categorias_criterios' => 'required|exists:categorias_criterios,id',
            ], self::REGLAS_NIVELES));

            DB::beginTransaction();

            $item = ItemEvaluacion::create([
                'nombre' => $validated['nombre'],
                'descripcion' => $validated['descripcion'],
                'id_categorias_criterios' => $validated['id_categorias_criterios'],
                'activo' => true,
            ]);

            foreach ($validated['niveles'] as $nivel) {
                ItemNivel::create([
                    'item_evaluacion_id' => $item->id,
                    'nivel' => $nivel['nivel'],
                    'descripcion' => $nivel['descripcion'],
                ]);
            }

            DB::commit();

            return response()->json([
                'status' => '201',
                'message' => 'Ítem creado correctamente',
                'result' => $item->load('niveles')
            ], 201);

        } catch (ValidationException $e) {
            return response()->json([
                'status' => '422',
                'message' => 'Error de validación',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al crear ítem: ' . $e->getMessage());
            return response()->json([
                'status' => '500',
                'message' => 'Error al crear el ítem',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validated = $request->validate(array_merge([
                'nombre' => 'required|string|max:255',
                'descripcion' => 'required|string',
                'id_categorias_criterios' => 'required|exists:categorias_criterios,id',
            ], self::REGLAS_NIVELES));

            $item = ItemEvaluacion::findOrFail($id);

            DB::beginTransaction();

            $item->update([
                'nombre' => $validated['nombre'],
                'descripcion' => $validated['descripcion'],
                'id_categorias_criterios' => $validated['id_categorias_criterios'],
            ]);

            foreach ($validated['niveles'] as $nivel) {
                ItemNivel::updateOrCreate(
                    ['item_evaluacion_id' => $item->id, 'nivel' => $nivel['nivel']],
                    ['descripcion' => $nivel['descripcion']]
                );
            }

            DB::commit();

            return response()->json([
                'status' => '200',
                'message' => 'Ítem actualizado correctamente',
                'result' => $item->load('niveles')
            ]);

        } catch (ValidationException $e) {
            return response()->json([
                'status' => '422',
                'message' => 'Error de validación',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al actualizar ítem: ' . $e->getMessage());
            return response()->json([
                'status' => '500',
                'message' => 'Error al actualizar el ítem',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function cambiarEstado(Request $request, $id)
    {
        $request->validate(['activo' => 'required|boolean']);

        $item = ItemEvaluacion::findOrFail($id);
        $item->update(['activo' => $request->activo]);

        return response()->json([
            'status' => '200',
            'message' => 'Estado del ítem actualizado correctamente',
            'result' => $item
        ]);
    }
}
