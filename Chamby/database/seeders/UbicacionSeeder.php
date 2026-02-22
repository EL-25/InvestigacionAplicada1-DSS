<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UbicacionSeeder extends Seeder
{
    public function run()
    {
        // LA LIBERTAD
        $id = DB::table('departamentos')->insertGetId(['nombre' => 'La Libertad']);
        
        $mId = DB::table('municipios')->insertGetId([
            'departamento_id' => $id, 
            'nombre' => 'La Libertad Norte'
        ]);

        DB::table('distritos')->insert([
            ['municipio_id' => $mId, 'nombre' => 'Quezaltepeque'],
            ['municipio_id' => $mId, 'nombre' => 'San Matías'],
            ['municipio_id' => $mId, 'nombre' => 'San Pablo Tacachico']
        ]);

        // SAN SALVADOR (Ejemplo extra)
        $id2 = DB::table('departamentos')->insertGetId(['nombre' => 'San Salvador']);
        
        $mId2 = DB::table('municipios')->insertGetId([
            'departamento_id' => $id2, 
            'nombre' => 'San Salvador Centro'
        ]);

        DB::table('distritos')->insert([
            ['municipio_id' => $mId2, 'nombre' => 'San Salvador'],
            ['municipio_id' => $mId2, 'nombre' => 'Mejicanos'],
            ['municipio_id' => $mId2, 'nombre' => 'Ayutuxtepeque']
        ]);
    }
}