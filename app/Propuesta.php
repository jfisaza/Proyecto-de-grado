<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Propuesta extends Model
{
    protected $table = 'propuesta';
    protected $primaryKey = 'prop_id';
    protected $fillable = ['prop_titulo','prop_est_usu_id','prop_dir_usu_id','prop_codir_usu_id','prop_mod_id','prop_con_id','prop_formato','prop_fecha_entrega','prop_fecha_calificacion'];



    public function concepto(){
        return $this->belongsTo(Conceptos::class,'prop_con_id');
    }

    public function director(){
        return $this->belongsTo(User::class,'prop_dir_usu_id');
    }

    public function codirector(){
        return $this->belongsTo(User::class,'prop_codir_usu_id');
    }

    public function modalidad(){
        return $this->belongsTo(Modalidades::class,'prop_mod_id');
    }


}

