<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Modalidades extends Model
{
    protected $table='modalidades';
    protected $primaryKey='mod_id';
    protected $fillable=['mod_id','mod_nombre'];
}
