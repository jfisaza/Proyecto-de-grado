<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coordinacion extends Model
{
    protected $table = 'coordinacion';
    protected $primaryKey = 'coo_id';
    protected $fillable = ['coo_nombre'];
}
