<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conceptos extends Model
{
    protected $table = 'conceptos';
    protected $primaryKey = 'con_id';
    protected $fillable = ['con_id','con_nombre','con_acta','con_usu_id','con_fecha'];

    public function calificador(){
        return $this->belongsTo(User::class,'con_usu_id');
    }
    public function propuestas(){
        return $this->hasOne(Propuesta::class,'prop_con_id');
    }
    public function desarrollos(){
        return $this->hasOne(Desarrollo::class,'des_con_id');
    }

    public function propuestasP(){
        return $this->hasOne(PropuestaPractica::class,'pp_con_id');
    }
    public function desarrollosP(){
        return $this->hasOne(DesarrolloPractica::class,'dp_con_id');
    }

}
