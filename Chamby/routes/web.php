<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\RegistroController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UbicacionController;
use App\Http\Controllers\DashboardController;

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
    // Dashboard principal
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    // Editar perfil
    Route::get('/dashboard/editar', [DashboardController::class, 'editarPerfil'])->name('dashboard.editar');
    Route::post('/dashboard/actualizar', [DashboardController::class, 'actualizarPerfil'])->name('dashboard.actualizar');

    // Eliminar perfil
    Route::delete('/dashboard/eliminar', [DashboardController::class, 'eliminarPerfil'])->name('dashboard.eliminar');

    // Logout
    Route::post('/logout', function () {
        Auth::logout();
        return redirect('/login');
    })->name('logout');
});

