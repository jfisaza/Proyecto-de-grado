<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conceptos extends Model
{
    protected $table = 'conceptos';
    protected $primaryKey = 'con_id';
    protected $fillable = ['con_id','con_nombre','con_usu_id','con_fecha'];

    public function calificador(){
        return $this->belongsTo(User::class,'con_usu_id');
    }
}
