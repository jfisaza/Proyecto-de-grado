<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropuestaPractica extends Model
{
    protected $table = 'propuesta_practicas';
    protected $primaryKey = 'pp_id';
    protected $fillable = ['pp_titulo','pp_numconvenio','pp_fechaconvenio'
    ,'pp_asesorempresa','pp_dir_usu_id','pp_pro_id','pp_con_id','pp_formato',
    'pp_fecha_entrega','pp_fecha_calificacion'];

    public function director(){
        return $this->belongsTo(User::class,'pp_dir_usu_id');
    }
    public function concepto(){
        return $this->belongsTo(Conceptos::class,'pp_con_id');
    }
}
