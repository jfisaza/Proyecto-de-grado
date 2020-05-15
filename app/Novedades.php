<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Novedades extends Model
{
    protected $table = 'novedades';
    protected $primaryKey = 'nov_id';
    protected $fillable = ['nov_des_id','nov_descripcion'];

    public function desarrollo(){
        return $this->belongsTo(Desarrollo::class,'nov_des_id');
    }
}
