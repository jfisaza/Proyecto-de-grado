<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresas extends Model
{
    protected $table='empresas';
    protected $primaryKey='emp_id';
    protected $fillable=['emp_id','emp_nombre','emp_sector','emp_representante','emp_direccion','emp_telefono','emp_correo'];
}