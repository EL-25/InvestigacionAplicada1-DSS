<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use App\Models\Profesion;
use App\Models\TipoEmpresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class RegistroController extends Controller {
    
    public function mostrarFormulario() {
        $departamentos = DB::table('departamentos')->get();
        $profesiones = Profesion::all(); // profesiones para empleados
        $tiposEmpresas = TipoEmpresa::all(); // giros de empresa para empresas
        return view('auth.registro', compact('departamentos', 'profesiones', 'tiposEmpresas'));
    }

    public function registrar(Request $request) {
        // Validación condicional según tipo de perfil
        if ($request->tipo_perfil == 'empleado') {
            $request->validate([
                'dui' => 'required|unique:usuarios,dui',
                'primer_nombre' => 'required|alpha',
                'primer_apellido' => 'required|alpha',
                'correo' => 'required|email|unique:usuarios,correo',
                'contrasena' => 'required|min:8|regex:/[@$!%*#?&]/',
                'telefono' => 'required'
            ]);
        } else {
            $request->validate([
                'nombre_empresa' => 'required',
                'razon_social' => 'required',
                'nit' => 'required|unique:usuarios,nit',
                'nrc' => 'required|unique:usuarios,nrc',
                'correo' => 'required|email|unique:usuarios,correo',
                'contrasena' => 'required|min:8|regex:/[@$!%*#?&]/',
                'telefono' => 'required'
            ]);

            // Forzar que no se envíe dui en empresas
            $request->merge(['dui' => null]);
        }

        // Determinar si es empleado o empresa
        $id_dinamico = null;
        $campo_id = null;

        if ($request->tipo_perfil == 'empleado') {
            $registro = Profesion::firstOrCreate(['nombre' => strtolower(trim($request->campo_dinamico))]);
            $campo_id = 'profesion_id';
            $id_dinamico = $registro->id;
        } else {
            $registro = TipoEmpresa::firstOrCreate(['nombre' => strtolower(trim($request->campo_dinamico))]);
            $campo_id = 'tipo_empresa_id';
            $id_dinamico = $registro->id;
        }

        // Crear usuario
        Usuario::create([
            // Campos comunes
            'correo' => $request->correo,
            'codigo_pais' => $request->codigo_pais,
            'telefono' => $request->telefono,
            'departamento_id' => $request->departamento_id,
            'municipio_id' => $request->municipio_id,
            'distrito_id' => $request->distrito_id,
            'tipo_perfil' => $request->tipo_perfil,
            $campo_id => $id_dinamico,
            'contrasena' => Hash::make($request->contrasena),

            // Campos de empleado
            'dui' => $request->tipo_perfil == 'empleado' ? $request->dui : null,
            'primer_nombre' => $request->tipo_perfil == 'empleado' ? $request->primer_nombre : null,
            'segundo_nombre' => $request->tipo_perfil == 'empleado' ? $request->segundo_nombre : null,
            'primer_apellido' => $request->tipo_perfil == 'empleado' ? $request->primer_apellido : null,
            'segundo_apellido' => $request->tipo_perfil == 'empleado' ? $request->segundo_apellido : null,

            // Campos de empresa
            'nombre_empresa' => $request->tipo_perfil == 'empresa' ? $request->nombre_empresa : null,
            'razon_social' => $request->tipo_perfil == 'empresa' ? $request->razon_social : null,
            'nit' => $request->tipo_perfil == 'empresa' ? $request->nit : null,
            'nrc' => $request->tipo_perfil == 'empresa' ? $request->nrc : null,
        ]);

        return redirect()->route('login')->with('status', '¡Cuenta creada!');
    }

    public function getMunicipios($id) {
        return response()->json(DB::table('municipios')->where('departamento_id', $id)->get());
    }

    public function getDistritos($id) {
        return response()->json(DB::table('distritos')->where('municipio_id', $id)->get());
    }
}
