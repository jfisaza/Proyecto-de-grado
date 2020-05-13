<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class propuesta_user extends Model
{
    protected $table = 'propuesta_users';
    protected $primaryKey = 'pu_id';
    protected $fillable = ['user_id','propuesta_prop_id'];

    public function propuestas(){
        return $this->hasOne(Propuesta::class,'prop_id');
    }
    public function users(){
        return $this->hasOne(User::class);
    }
}
