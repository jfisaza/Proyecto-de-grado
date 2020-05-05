<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Propuestas extends Model
{
    protected $table = 'propuesta';
    protected $primaryKey = 'prop_id';
    protected $fillable = ['prop_id','prop_con_id','prop_formato','prop_fecha_entrega','prop_fecha_calificacion'];

    public function concepto(){
        return $this->belongsTo(Conceptos::class,'prop_con_id');
    }
}
