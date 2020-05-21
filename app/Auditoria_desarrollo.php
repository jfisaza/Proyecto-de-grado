<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Auditoria_desarrollo extends Model
{
    protected $table = 'auditoria_desarrollo';
    protected $primaryKey = 'ad_id';
    protected $fillable = ['ad_titulo','ad_est1','ad_est2','ad_est3','ad_dir_usu_id','ad_codir_usu_id','ad_mod_id','ad_pro_id','ad_con_id','ad_formato','ad_ap_id'];
    
    public function concepto(){
        return $this->belongsTo(Conceptos::class,'ad_con_id');
    }
    public function est1(){
        return $this->belongsTo(User::class,'ad_est1');
    }
    public function est2(){
        return $this->belongsTo(User::class,'ad_est2');
    }
    public function est3(){
        return $this->belongsTo(User::class,'ad_est3');
    }
    public function director(){
        return $this->belongsTo(User::class,'ad_dir_usu_id');
    }

    public function codirector(){
        return $this->belongsTo(User::class,'ad_codir_usu_id');
    }

    public function modalidad(){
        return $this->belongsTo(Modalidades::class,'ad_mod_id');
    }
    public function propuesta(){
        return $this->belongsTo(Auditoria_propuesta::class,'ad_ap_id');
    }
    public function novedades(){
        return $this->hasMany(Novedades::class,'an_ad_id');
    }
    
    public function programas(){
        return $this->belongsTo(Programas::class,'ad_pro_id');
    }
}
