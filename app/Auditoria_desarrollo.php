<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Auditoria_desarrollo extends Model
{
    protected $table = 'auditoria_desarrollo';
    protected $primaryKey = 'ad_id';
    protected $fillable = ['ad_titulo','ad_est1','ad_est2','ad_est3','ad_dir_usu_id','ad_codir_usu_id','ad_mod_id','ad_pro_id','ad_con_id','ad_formato'];
    
}
