<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banco extends Model
{
    protected $table='banco_ideas';
    protected $primaryKey='ban_id';
    protected $fillable=['ban_id','ban_nombre','ban_usu_id','ban_mod_id','ban_pro_id'];

    public function usuarios(){
        return $this->belongsTo(Usuarios::class, 'ban_usu_id');
    }
    public function modalidad(){
        return $this->belongsTo(Modalidades::class, 'ban_mod_id');
    }
    public function programa(){
        return $this->belongsTo(Programas::class, 'ban_pro_id');
    }
    public function scopeProgramas($query, $id){
        if($id != ""){
            $query->where('ban_pro_id',$id);
        }
    }
}
