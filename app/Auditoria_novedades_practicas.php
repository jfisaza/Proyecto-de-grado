<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Auditoria_novedades_practicas extends Model
{
    protected $table = 'auditoria_novedades_practica';
    protected $primaryKey = 'anp_id';
    protected $fillable = ['anp_id','anp_adp_id','anp_descripcion','anp_fecha'];
}
