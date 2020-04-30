<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Solicitudes extends Model
{
    protected $table='solicitudes_practicantes';
    protected $primaryKey='sol_id';
    protected $fillable=['sol_id','sol_pro_id','sol_emp_id'];

    public function empresa(){
        return $this->belongsTo(Empresas::class, 'sol_emp_id');
    }
    public function programa(){
        return $this->belongsTo(Programas::class, 'sol_pro_id');
    }
    public function scopeProgramas($query, $id){
        if($id != ""){
            $query->where('sol_pro_id',$id);
        }
    }
}
