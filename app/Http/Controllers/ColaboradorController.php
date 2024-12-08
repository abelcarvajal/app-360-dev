<?php

namespace App\Http\Controllers;

use App\Models\Colaborador;
use App\Models\Identificacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ColaboradorController extends Controller
{
    public function show($id)
    {
        $colaborador = Colaborador::with('identificacion.tipo_documento', 'ciudadNacimiento', 'ciudadResidencia', 'cargo', 'programa', 'centroCosto')->findOrFail($id);
        return response()->json($colaborador);
    }

    public function index(Request $request)
    {
        $colaboradores = Colaborador::with('identificacion.tipo_documento', 'ciudadNacimiento', 'ciudadResidencia', 'cargo', 'programa', 'centroCosto')->get();
        return response()->json($colaboradores);
    }

    public function store(Request $request)
    {
        // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'tipo_documento_id' => 'required|exists:tipo_documentos,id',
            'numero_documento' => 'required|string|unique:identificacions,numero_documento',
            'fecha_nacimiento' => 'required|date',
            'ciudad_nacimiento_id' => 'required|exists:municipios,id',
            'ciudad_residencia_id' => 'required|exists:municipios,id',
            'direccion' => 'required|string|max:255',
            'telefono_fijo' => 'nullable|string|max:20',
            'celular' => 'required|string|max:20',
            'email' => 'required|email|unique:colaboradors,email',
            'id_cargos' => 'required|exists:cargos,id',
            'id_programas' => 'required|exists:programas,id',
            'id_centro_costo' => 'required|exists:centro_costo,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error de validación',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            DB::beginTransaction();
            
            // Verificar si ya existe la identificación
            Log::info('Buscando identificación:', ['numero_documento' => $request->numero_documento]);

            $identificacion = Identificacion::firstOrCreate(
                ['numero_documento' => $request->numero_documento],
                ['tipo_documento_id' => $request->tipo_documento_id]
            );

            Log::info('Resultado identificación:', [
                'id' => $identificacion->id,
                'numero_documento' => $identificacion->numero_documento,
                'es_nuevo' => $identificacion->wasRecentlyCreated
            ]);

            // Log para verificar la creación o existencia de identificación
            Log::info('Identificación existente o creada:', ['id' => $identificacion->id]);

            // Crear colaborador
            $colaborador = Colaborador::create([
                'nombres' => $request->nombres,
                'apellidos' => $request->apellidos,
                'fecha_nacimiento' => $request->fecha_nacimiento,
                'identificacion_id' => $identificacion->id,
                'ciudad_nacimiento_id' => $request->ciudad_nacimiento_id,
                'ciudad_residencia_id' => $request->ciudad_residencia_id,
                'direccion' => $request->direccion,
                'telefono_fijo' => $request->telefono_fijo,
                'celular' => $request->celular,
                'email' => $request->email,
                'id_cargos' => $request->id_cargos,
                'id_programas' => $request->id_programas,
                'id_centro_costo' => $request->id_centro_costo
            ]);

            DB::commit();

            // Cargar las relaciones
            $colaborador->load([
                'identificacion.tipo_documento',
                'ciudadNacimiento',
                'ciudadResidencia',
                'cargo',
                'programa',
                'centroCosto'
            ]);

            return response()->json([
                'message' => 'Colaborador creado exitosamente',
                'data' => $colaborador
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Error al crear el colaborador',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            
            Log::info('Iniciando actualización del colaborador ID: ' . $id, $request->all());

            // Validación
            $validator = Validator::make($request->all(), [
                'nombres' => 'required|string|max:255',
                'apellidos' => 'required|string|max:255',
                'tipo_documento_id' => 'required|exists:tipo_documentos,id',
                'numero_documento' => 'required|string',
                'ciudad_nacimiento_id' => 'required|exists:municipios,id',
                'ciudad_residencia_id' => 'required|exists:municipios,id',
                'direccion' => 'required|string|max:255',
                'telefono_fijo' => 'nullable|string|max:20',
                'celular' => 'required|string|max:20',
                'email' => 'required|email|unique:colaboradors,email,' . $id,
                'id_cargos' => 'required|exists:cargos,id',
                'id_programas' => 'required|exists:programas,id',
                'id_centro_costo' => 'required|exists:centro_costo,id',
                'fecha_nacimiento' => 'required|date',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Error de validación',
                    'errors' => $validator->errors()
                ], 422);
            }

            // Buscar o crear la identificación
            $identificacion = Identificacion::firstOrCreate(
                ['numero_documento' => $request->numero_documento],
                ['tipo_documento_id' => $request->tipo_documento_id]
            );

            Log::info('Identificación procesada:', [
                'id' => $identificacion->id,
                'numero_documento' => $identificacion->numero_documento
            ]);

            $colaborador = Colaborador::findOrFail($id);
            $colaborador->update([
                'nombres' => $request->nombres,
                'apellidos' => $request->apellidos,
                'identificacion_id' => $identificacion->id,
                'fecha_nacimiento' => $request->fecha_nacimiento,
                'ciudad_nacimiento_id' => $request->ciudad_nacimiento_id,
                'ciudad_residencia_id' => $request->ciudad_residencia_id,
                'direccion' => $request->direccion,
                'telefono_fijo' => $request->telefono_fijo,
                'celular' => $request->celular,
                'email' => $request->email,
                'id_cargos' => $request->id_cargos,
                'id_programas' => $request->id_programas,
                'id_centro_costo' => $request->id_centro_costo
            ]);

            $colaborador->load([
                'identificacion.tipo_documento',
                'ciudadNacimiento',
                'ciudadResidencia',
                'cargo',
                'programa',
                'centroCosto'
            ]);

            DB::commit();

            return response()->json([
                'message' => 'Colaborador actualizado exitosamente',
                'data' => $colaborador
            ], 200);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al actualizar colaborador: ' . $e->getMessage());
            
            return response()->json([
                'message' => 'Error al actualizar el colaborador',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            
            $colaborador = Colaborador::with('identificacion')->findOrFail($id);

            if (!$colaborador) {
                return response()->json([
                    'message' => 'Colaborador no encontrado'
                ], 404);
            }

            $identificacionId =$colaborador->identificacion_id;
            
            $colaborador->delete();

            // Eliminar la identificación si existe
            if ($identificacionId) {
                // Eliminamos la identificación ya que es única para cada colaborador
                Identificacion::where('id', $identificacionId)->delete();
            }
            
            DB::commit();
            
            return response()->json([
                'message' => 'Colaborador eliminado exitosamente'
            ], 200);
            
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Error al eliminar el colaborador',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
