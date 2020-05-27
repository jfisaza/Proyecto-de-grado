<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresas extends Model
{
    protected $table='empresa';
    protected $primaryKey='emp_id';
    protected $fillable=['emp_nombre','emp_sector','emp_representante','emp_direccion','emp_telefono','emp_correo'];
}
