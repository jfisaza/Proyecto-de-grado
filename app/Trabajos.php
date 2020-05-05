<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trabajos extends Model
{
    protected $table = 'trabajos';
    protected $primaryKey = 'tra_id';
    protected $fillable = ['tra_id','tra_titulo','tra_fac_id','tra_prop_id','tra_des_id','tra_dir_usu_id',
                            'tra_codir_usu_id','tra_mod_id','tra_citacion','tra_emp_id'];

    public function director(){
        return $this->belongsTo(User::class,'tra_dir_usu_id');
    }
    public function codirector(){
        return $this->belongsTo(User::class,'tra_codir_usu_id');
    }
    public function propuesta(){
        return $this->belongsTo(Propuestas::class,'tra_prop_id');
    }
    public function desarrollo(){
        return $this->belongsTo(Desarrollo::class,'tra_des_id');
    }
    public function modalidad(){
        return $this->belongsTo(Modalidades::class,'tra_mod_id');
    }
    
}
