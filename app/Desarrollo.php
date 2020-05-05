<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Desarrollo extends Model
{
    protected $table = 'desarrollo';
    protected $primaryKey = 'des_id';
    protected $fillable = ['des_id','des_con_id','des_prop_id','des_formato','des_fecha_entrega','des_fecha_calificacion'];

    public function concepto(){
        return $this->belongsTo(Conceptos::class,'prop_con_id');
    }
}
