<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    protected $table='roles';
    protected $primaryKey='rol_id';
    protected $fillable=['rol_id','rol_nombre'];

    public function usuarios(){
        return $this->belongsToMany('App\Usuarios');
    }
}
