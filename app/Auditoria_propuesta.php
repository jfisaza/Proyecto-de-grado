<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Auditoria_propuesta extends Model
{
    protected $table = 'auditoria_propuestas';
    protected $primaryKey = 'ap_id';
    protected $fillable = ['ap_titulo','ap_est1','ap_est2','ap_est3','ap_dir_usu_id','ap_codir_usu_id','ap_mod_id','ap_pro_id','ap_con_id','ap_formato'];

    public function concepto(){
        return $this->belongsTo(Conceptos::class,'ap_con_id');
    }
    public function est1(){
        return $this->belongsTo(User::class,'ap_est1');
    }
    public function est2(){
        return $this->belongsTo(User::class,'ap_est2');
    }
    public function est3(){
        return $this->belongsTo(User::class,'ap_est3');
    }
    public function director(){
        return $this->belongsTo(User::class,'ap_dir_usu_id');
    }

    public function codirector(){
        return $this->belongsTo(User::class,'ap_codir_usu_id');
    }

    public function modalidad(){
        return $this->belongsTo(Modalidades::class,'ap_mod_id');
    }
    
    public function programas(){
        return $this->belongsTo(Programas::class,'ap_pro_id');
    }

    public function scopeCodigo($query, $id){
        if($id != ""){
            $query->where('ap_id',$id);
        }
    }
}
