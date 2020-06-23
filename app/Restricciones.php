<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restricciones extends Model
{
    protected $table = 'restricciones';
    protected $primaryKey = 'res_id';
    protected $fillable = ['res_fecha'];
}
