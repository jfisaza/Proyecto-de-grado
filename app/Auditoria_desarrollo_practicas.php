<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Auditoria_desarrollo_practicas extends Model
{
    protected $table = 'auditoria_desarrollo_practica';
    protected $primaryKey = 'adp_id';
    protected $fillable = ['adp_titulo','adp_usu_id','adp_emp_id','adp_numconvenio','adp_fechaconvenio'
    ,'adp_dir_usu_id','adp_pro_id','adp_app_id','adp_con_id','adp_formato',
    'adp_fecha_entrega','adp_fecha_calificacion'];

    public function director(){
        return $this->belongsTo(User::class,'adp_dir_usu_id');
    }
    public function concepto(){
        return $this->belongsTo(Conceptos::class,'adp_con_id');
    }
    public function empresa(){
        return $this->belongsTo(Empresas::class, 'adp_emp_id');
    }
}
