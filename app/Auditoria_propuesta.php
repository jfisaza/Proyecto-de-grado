<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Auditoria_propuesta extends Model
{
    protected $table = 'auditoria_propuestas';
    protected $primaryKey = 'ap_id';
    protected $fillable = ['ap_titulo','ap_est1','ap_est2','ap_est3','ap_dir_usu_id','ap_codir_usu_id','ap_mod_id','ap_pro_id','ap_con_id','ap_formato'];

}
