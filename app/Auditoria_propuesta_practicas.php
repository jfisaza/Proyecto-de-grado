<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Auditoria_propuesta_practicas extends Model
{
    protected $table = 'auditoria_propuesta_practica';
    protected $primaryKey = 'app_id';
    protected $fillable = ['app_titulo','app_usu_id','app_emp_id','app_numconvenio','app_fechaconvenio'
    ,'app_asesorempresa','app_dir_usu_id','app_pro_id','app_con_id','app_formato',
    'app_fecha_entrega','app_fecha_calificacion'];

    public function director(){
        return $this->belongsTo(User::class,'app_dir_usu_id');
    }
    public function concepto(){
        return $this->belongsTo(Conceptos::class,'app_con_id');
    }
    public function empresa(){
        return $this->belongsTo(Empresas::class, 'app_emp_id');
    }
    public function desarrollo(){
        return $this->hasOne(Auditoria_desarrollo_practicas::class,'adp_app_id');
    }
}
