<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DesarrolloPractica extends Model
{
    protected $table = 'desarrollo_practicas';
    protected $primaryKey = 'dp_id';
    protected $fillable = ['dp_titulo','dp_dir_usu_id','dp_pp_id'
    ,'dp_con_id','dp_formato','dp_fecha_entrega','dp_fecha_calificacion'];

    public function director(){
        return $this->belongsTo(User::class,'dp_dir_usu_id');

    }

    public function concepto(){
        return $this->belongsTo(Conceptos::class,'dp_con_id');
    }
}
