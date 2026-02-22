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
        return view('auth.registro', compact('departamentos'));
    }

    public function registrar(Request $request) {
        $request->validate([
            'dui' => 'required|unique:usuarios,dui',
            'primer_nombre' => 'required|alpha',
            'primer_apellido' => 'required|alpha',
            'correo' => 'required|email|unique:usuarios,correo',
            'contrasena' => 'required|min:8|regex:/[@$!%*#?&]/',
            'telefono' => 'required'
        ]);

        $id_dinamico = null;

        // Lógica de "no repetir palabras" y guardar dinámicamente
        if ($request->tipo_perfil == 'empleado') {
            $registro = Profesion::firstOrCreate(['nombre' => strtolower(trim($request->campo_dinamico))]);
            $campo_id = 'profesion_id';
            $id_dinamico = $registro->id;
        } else {
            $registro = TipoEmpresa::firstOrCreate(['nombre' => strtolower(trim($request->campo_dinamico))]);
            $campo_id = 'tipo_empresa_id';
            $id_dinamico = $registro->id;
        }

        Usuario::create([
            'dui' => $request->dui,
            'primer_nombre' => $request->primer_nombre,
            'segundo_nombre' => $request->segundo_nombre,
            'primer_apellido' => $request->primer_apellido,
            'segundo_apellido' => $request->segundo_apellido,
            'correo' => $request->correo,
            'codigo_pais' => $request->codigo_pais,
            'telefono' => $request->telefono,
            'departamento_id' => $request->departamento_id,
            'municipio_id' => $request->municipio_id,
            'distrito_id' => $request->distrito_id,
            'tipo_perfil' => $request->tipo_perfil,
            $campo_id => $id_dinamico,
            'contrasena' => Hash::make($request->contrasena),
        ]);

        return redirect()->route('login')->with('status', '¡Cuenta creada!');
    }

    // API para cascada
    public function getMunicipios($id) {
        return response()->json(DB::table('municipios')->where('departamento_id', $id)->get());
    }

    public function getDistritos($id) {
        return response()->json(DB::table('distritos')->where('municipio_id', $id)->get());
    }
}