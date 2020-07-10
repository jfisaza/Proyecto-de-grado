<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModalidadesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('modalidades')->insert([
            'mod_nombre'=>'PROYECTO DE INVESTIGACIÓN',
        ]);
        DB::table('modalidades')->insert([
            'mod_nombre'=>'MONOGRAFÍA',
        ]);
        DB::table('modalidades')->insert([
            'mod_nombre'=>'DESARROLLO TECNOLÓGICO',
        ]);
        DB::table('modalidades')->insert([
            'mod_nombre'=>'EMPRENDIMIENTO',
        ]);
    }
}
