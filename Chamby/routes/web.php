<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\RegistroController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UbicacionController;

// Pantalla principal: Login
Route::get('/', function () { return view('auth.login'); });

// Departamentos, municipios y distritos
Route::get('/api/departamentos', [UbicacionController::class, 'obtenerDepartamentos']);
Route::get('/api/municipios/{depto_id}', [UbicacionController::class, 'obtenerMunicipios']);
Route::get('/api/distritos/{muni_id}', [UbicacionController::class, 'obtenerDistritos']);

// Rutas de Registro
Route::get('/registro', [RegistroController::class, 'mostrarFormulario'])->name('registro');
Route::post('/registro', [RegistroController::class, 'registrar'])->name('registro.guardar');

// Rutas de Login
Route::get('/login', [LoginController::class, 'mostrarLogin'])->name('login');
Route::post('/login', [LoginController::class, 'entrar'])->name('login.entrar');

// Dashboard y Logout
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () { 
        return view('dashboard'); 
    })->name('dashboard');

    Route::post('/logout', function () {
        Auth::logout();
        return redirect('/login');
    })->name('logout');
});
