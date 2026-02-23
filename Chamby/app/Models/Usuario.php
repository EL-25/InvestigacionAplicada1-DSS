<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable {
    use Notifiable;
    
    protected $table = 'usuarios';
    
   protected $fillable = [
    // empleado
    'dui', 'primer_nombre', 'segundo_nombre', 'primer_apellido', 'segundo_apellido', 'profesion_id',
    // empresa
    'nombre_empresa', 'razon_social', 'nit', 'nrc', 'tipo_empresa_id',
    // comunes
    'correo', 'codigo_pais', 'telefono',
    'departamento_id', 'municipio_id', 'distrito_id',
    'tipo_perfil', 'contrasena'
    ];


    
    protected $hidden = ['contrasena', 'remember_token'];

    public function getAuthPassword() {
        return $this->contrasena;
    }
}
