<?php

namespace App\Http\Controllers;

use App\Models\Colaborador;
use App\Models\Identificacion;
use Illuminate\Http\Request;

class ColaboradorController extends Controller
{
    public function store(Request $request)
    {
        // Validación
        $request->validate([
            'nombres' => 'required|string',
            'apellidos' => 'required|string',
            'tipo_documento_id' => 'required|exists:tipo_documentos,id',
            'numero_documento' => 'required|unique:identificacions,numero_documento',
            'fecha_nacimiento' => 'required|date',
            'pais_nacimiento_id' => 'required|exists:pais,id',
            'departamento_nacimiento_id' => 'required|exists:departamentos,id',
            'ciudad_nacimiento_id' => 'required|exists:municipios,id',
            'ciudad_residencia_id' => 'required|exists:municipios,id',
            'direccion' => 'required|string',
            'telefono_fijo' => 'nullable|string',
            'celular' => 'required|string',
            'email' => 'required|email|unique:colaboradors',
            'id_cargos' => 'required|exists:cargos,id',
            'id_programas' => 'required|exists:programas,id',
            'id_centro_costo' => 'required'
        ]);

        try {
            // Crear identificación
            $identificacion = Identificacion::create([
                'numero_documento' => $request->numero_documento,
                'tipo_documento_id' => $request->tipo_documento_id
            ]);

            // Crear colaborador
            $colaborador = Colaborador::create([
                'nombres' => $request->nombres,
                'apellidos' => $request->apellidos,
                'fecha_nacimiento' => $request->fecha_nacimiento,
                'identificacion_id' => $identificacion->id,
                'pais_nacimiento_id' => $request->pais_nacimiento_id,
                'departamento_nacimiento_id' => $request->departamento_nacimiento_id,
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

            // Cargar las relaciones para la respuesta
            $colaborador->load([
                'identificacion.tipoDocumento',
                'paisNacimiento',
                'departamentoNacimiento',
                'ciudadNacimiento',
                'ciudadResidencia',
                'cargo',
                'programa'
            ]);

            return response()->json([
                'message' => 'Colaborador creado exitosamente',
                'data' => $colaborador
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al crear el colaborador',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
