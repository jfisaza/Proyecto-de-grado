<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Novedades_practicas extends Model
{
    protected $table = 'novedades_practica';
    protected $primaryKey = 'np_id';
    protected $fillable = ['np_dp_id','np_descripcion','np_fecha'];

    public function desarrollo(){
        return $this->hasOne(Desarrollo::class,'np_dp_id');
    }
}
