<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropuestaPractica extends Model
{
    protected $table = 'propuesta_practicas';
    protected $primaryKey = 'pp_id';
    protected $fillable = ['pp_titulo','pp_usu_id','pp_emp_id','pp_numconvenio','pp_fechaconvenio'
    ,'pp_asesorempresa','pp_dir_usu_id','pp_pro_id','pp_con_id','pp_formato',
    'pp_fecha_entrega','pp_fecha_calificacion'];

    public function director(){
        return $this->belongsTo(User::class,'pp_dir_usu_id');
    }
    public function concepto(){
        return $this->belongsTo(Conceptos::class,'pp_con_id');
    }
    public function empresa(){
        return $this->belongsTo(Empresas::class, 'pp_emp_id');
    }
    public function estudiante(){
        return $this->belongsTo(User::class, 'pp_usu_id');
    }
    public function desarrollo(){
        return $this->hasOne(DesarrolloPractica::class,'dp_pp_id');
    }
    public function programas(){
        return $this->belongsTo(Programas::class,'pp_pro_id');
    }
} 
