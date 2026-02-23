<?php
namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class DashboardController extends Controller
{
    // Mostrar el dashboard principal
    public function index()
    {
        return view('dashboard');
    }

    // Mostrar formulario de edición de perfil
    public function editarPerfil()
    {
        $usuario = Auth::user();
        return view('dashboard.editar', compact('usuario'));
    }

    // Actualizar perfil
    public function actualizarPerfil(Request $request)
    {
        $usuario = Auth::user();

        if ($usuario->tipo_perfil === 'empleado') {
            $request->validate([
                'primer_nombre'   => 'required|alpha',
                'primer_apellido' => 'required|alpha',
                'correo'          => [
                    'required',
                    'email',
                    Rule::unique('usuarios', 'correo')->ignore($usuario->id),
                ],
                'telefono'        => 'required',
            ]);

            $usuario->update([
                'primer_nombre'   => $request->primer_nombre,
                'primer_apellido' => $request->primer_apellido,
                'correo'          => $request->correo,
                'telefono'        => $request->telefono,
            ]);
        } else {
            $request->validate([
                'nombre_empresa'  => 'required',
                'razon_social'    => 'required',
                'correo'          => [
                    'required',
                    'email',
                    Rule::unique('usuarios', 'correo')->ignore($usuario->id),
                ],
                'telefono'        => 'required',
            ]);

            $usuario->update([
                'nombre_empresa'  => $request->nombre_empresa,
                'razon_social'    => $request->razon_social,
                'correo'          => $request->correo,
                'telefono'        => $request->telefono,
            ]);
        }

        return redirect()->route('dashboard.index')->with('status', 'Perfil actualizado correctamente');
    }

    // Eliminar perfil
    public function eliminarPerfil()
    {
        $usuario = Auth::user();
        Auth::logout(); // cerrar sesión antes de eliminar
        $usuario->delete();

        return redirect()->route('login')->with('status', 'Tu cuenta ha sido eliminada');
    }
}
