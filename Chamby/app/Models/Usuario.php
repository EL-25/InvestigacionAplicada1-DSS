<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable {
    use Notifiable;
    protected $table = 'usuarios';
    protected $fillable = [
        'dui', 'primer_nombre', 'segundo_nombre', 'primer_apellido', 'segundo_apellido',
        'correo', 'codigo_pais', 'telefono', 'departamento_id', 'municipio_id', 
        'distrito_id', 'tipo_perfil', 'profesion_id', 'tipo_empresa_id', 'contrasena'
    ];
    protected $hidden = ['contrasena', 'remember_token'];

    public function getAuthPassword() {
        return $this->contrasena;
    }
}