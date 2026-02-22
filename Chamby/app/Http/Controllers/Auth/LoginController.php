<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller {
    public function mostrarLogin() { return view('auth.login'); }

    public function entrar(Request $request) {
        $credenciales = ['correo' => $request->correo, 'password' => $request->contrasena];

        if (Auth::attempt($credenciales)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }

        return back()->withErrors(['correo' => 'Las credenciales no coinciden.']);
    }

    public function salir(Request $request) {
        Auth::logout();
        return redirect('/login');
    }
}