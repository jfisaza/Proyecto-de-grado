<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Auditoria_novedades extends Model
{
    protected $table = 'auditoria_novedades';
    protected $primaryKey = 'an_id';
    protected $fillable = ['an_ad_id','an_descripcion','an_fecha'];

    public function auditoriaDesarrollo(){
        return $this->belongsTo(Auditoria_desarrollo::class,'an_ad_id');
    }
}
