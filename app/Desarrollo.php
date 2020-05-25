<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Desarrollo extends Model
{
    protected $table = 'desarrollo';
    protected $primaryKey = 'des_id';
    protected $fillable = ['des_id','des_titulo','des_est_usu_id','des_dir_usu_id','des_codir_usu_id','des_mod_id','des_pro_id','des_con_id','des_prop_id','des_formato','des_fecha_entrega','des_fecha_calificacion','des_citacion'];

    public function concepto(){
        return $this->belongsTo(Conceptos::class,'des_con_id');
    }

    public function propuesta(){
        return $this->belongsTo(Propuesta::class,'des_prop_id');
    }
    public function director(){
        return $this->belongsTo(User::class,'des_dir_usu_id');
    }

    public function codirector(){
        return $this->belongsTo(User::class,'des_codir_usu_id');
    }

    public function modalidad(){
        return $this->belongsTo(Modalidades::class,'des_mod_id');
    }
    public function estudiantes(){
        return $this->hasMany(User::class,'propuesta');
    }
    public function novedades(){
        return $this->hasMany(Novedades::class,'nov_des_id');
    }
    public function programas(){
        return $this->belongsTo(Programas::class,'des_pro_id');
    }

    public function scopeCodigo($query, $id){
        if($id != ""){
            $query->where('des_id',$id);
        }
    }
}
