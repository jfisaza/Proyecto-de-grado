<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'rol_nombre'=>'administrativo',
        ]);
        DB::table('roles')->insert([
            'rol_nombre'=>'docente',
        ]);
        DB::table('roles')->insert([
            'rol_nombre'=>'estudiante',
        ]);
        DB::table('roles')->insert([
            'rol_nombre'=>'super',
        ]);
    }
}
