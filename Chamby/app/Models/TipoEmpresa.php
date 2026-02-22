<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class TipoEmpresa extends Model {
    protected $table = 'tipos_empresa';
    protected $fillable = ['nombre'];
    public $timestamps = false;
}