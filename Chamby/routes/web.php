<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('login'); // tu vista personalizada
});

Route::post('/login', function (Request $request) {
    $user = DB::table('Usuarios')
        ->where('Nombre', $request->Nombre)
        ->where('Password', $request->Password)
        ->first();

    if ($user) {
        return "Hola desde Laravel 👋<br>Conexión exitosa con base de datos en Docker y servidor Linux";
    } else {
        return "Credenciales incorrectas ❌";
    }
});
