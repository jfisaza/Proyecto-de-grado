<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trabajos extends Model
{
    protected $table = 'trabajos';
    protected $primaryKey = 'tra_id';
    protected $fillable = ['tra_id','tra_titulo','tra_fac_id','tra_prop_id','tra_des_id','tra_dir_usu_id',
                            'tra_codir_usu_id','tra_mod_id','tra_citacion','tra_emp_id'];

    public function estudiante(){
        return $this->hasMany('App\User');
    }
}
