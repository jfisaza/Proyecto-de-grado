<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'documento','nombres','apellidos','telefono','ciudad','programa','email', 'password','propuesta','desarrollo'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //relacion con la tabla de roles
    public function roles(){
        return $this->belongsToMany('App\Roles');
    }

    //funcion para validar si un usuario tiene un rol
    public function hasRole($rol){
        if( $this->roles()->where('rol_nombre',$rol)->first() ){
            return true;
        }
        return false;
    }

    //funcion para validar si un usuario tiene varios roles
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

    //funcion que autoriza la entrada a paginas dependiendo del rol de usuario
    public function authorizeRoles($rol){
        if($this->hasAnyRole($rol)){
            return true;
        }
        abort(401,'Página no autorizada');
    }
    public function authorizeManyRoles($rol1,$rol2){
        if($this->hasAnyRole($rol1) || $this->hasAnyRole($rol2)){
            return true;
        }
        abort(401,'Página no autorizada');
    }

    public function programas(){
        return $this->belongsTo(Programas::class, 'programa');
    }
    
    public function propuestas(){
        return $this->belongsTo(Propuesta::class,'propuesta');
    }
    public function desarrollos(){
        return $this->belongsTo(Desarrollo::class,'desarrollo');
    }
    public function practicas(){
        return $this->hasOne(DesarrolloPractica::class,'dp_usu_id');
    }
    

}
