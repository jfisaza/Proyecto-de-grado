<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuarios extends Model
{
    protected $table='usuarios';
    protected $primaryKey='usu_id';
    protected $fillable=['usu_id','usu_documento','usu_nombres','usu_apellidos','usu_correo',
    'usu_telefono','usu_pro_id','usu_ciudad','usu_clave'];

    public function roles(){
        return $this->belongsToMany('App\Roles');
    }
    public function hasRole($rol){
        if( $this->roles()->where('rol_nombre',$rol)->first() ){
            return true;
        }
        return false;
    }
    public function hasAnyRole($roles){
        if(is_array($roles)){
            foreach($roles as $rol){
                if($this->hasRole($rol)){
                    return true;
                }
            }
        }else{
            if($this->hasRole($roles)){
                return true;
            }
        }
        return false;
    }
    public function authorizeRoles($rol){
        if($this->hasAnyRole($rol)){
            return true;
        }
        abort(401,'Página no autorizada');
    }
}
