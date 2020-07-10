<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CoordinacionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('coordinacion')->insert([  
            'coo_nombre'=>'DEPORTIVA',  //1
        ]);
        DB::table('coordinacion')->insert([  
            'coo_nombre'=>'TURISMO', //2
        ]);
        DB::table('coordinacion')->insert([  
            'coo_nombre'=>'MERCADEO',  //3
        ]);
        DB::table('coordinacion')->insert([
            'coo_nombre'=>'DISEÑO DE MODAS',  //4
        ]);
        DB::table('coordinacion')->insert([
            'coo_nombre'=>'CONTABILIDAD FINANCIERA',  //5
        ]);
        DB::table('coordinacion')->insert([
            'coo_nombre'=>'BANCA Y FINANZAS',  //6
        ]);
        DB::table('coordinacion')->insert([
            'coo_nombre'=>'AGROINDUSTRIAL',  //7
        ]);
        DB::table('coordinacion')->insert([
            'coo_nombre'=>'ADMINISTRACIÓN DE EMPRESAS',  //8
        ]);
        //FACULTAD DE CIENCIAS
        DB::table('coordinacion')->insert([
            'coo_nombre'=>'ELECTRICIDAD',  //9
        ]);
        DB::table('coordinacion')->insert([
            'coo_nombre'=>'AMBIENTAL',  //10
        ]);
        DB::table('coordinacion')->insert([
            'coo_nombre'=>'TELECOMUNICACIONES',  //11
        ]);
        DB::table('coordinacion')->insert([
            'coo_nombre'=>'ELECTROMECÁNICA',  //12
        ]);
        DB::table('coordinacion')->insert([
            'coo_nombre'=>'ELECTRÓNICA',  //13
        ]);
        DB::table('coordinacion')->insert([
            'coo_nombre'=>'GEOTECNIA',  //14
        ]);
        DB::table('coordinacion')->insert([
            'coo_nombre'=>'SISTEMAS',  //15
        ]);
        DB::table('coordinacion')->insert([
            'coo_nombre'=>'PETRÓLEO',  //16
        ]);
        DB::table('coordinacion')->insert([
            'coo_nombre'=>'TOPOGRAFÍA',  //17
        ]);
        DB::table('coordinacion')->insert([
            'coo_nombre'=>'INDUSTRIAL',  //18
        ]);
    }
}
