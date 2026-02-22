<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UbicacionController extends Controller
{
    // Obtener todos los departamentos
    public function obtenerDepartamentos() {
        return response()->json(DB::table('departamentos')->get());
    }

    // Obtener municipios por Departamento ID
    public function obtenerMunicipios($depto_id) {
        $municipios = DB::table('municipios')
                        ->where('departamento_id', $depto_id)
                        ->get();
        return response()->json($municipios);
    }

    // Obtener distritos por Municipio ID
    public function obtenerDistritos($muni_id) {
        $distritos = DB::table('distritos')
                       ->where('municipio_id', $muni_id)
                       ->get();
        return response()->json($distritos);
    }
}