<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FacultadesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('facultades')->insert([
            'fac_nombre'=>'FACULTAD DE CIENCIAS NATURALES E INGENIERÍAS',
        ]);
        DB::table('facultades')->insert([
            'fac_nombre'=>'FACULTAD DE CIENCIAS SOCIOECONÓMICAS Y EMPRESARIALES',
        ]);
    }
}
