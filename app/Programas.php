<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Programas extends Model
{
    protected $table='programas';
    protected $primaryKey='pro_id';
    protected $fillable=['pro_id','pro_nombre','pro_fac_id','pro_coo_id'];
}
