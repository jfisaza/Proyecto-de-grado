<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'documento'=>'1',
            'nombres'=>'SISTEMAS',
            'apellidos'=>'SISTEMAS',
            'telefono'=>'6917700',
            'ciudad'=>'BUCARAMANGA',
            'programa'=>'28',
            'email'=>'sistemas@correo.uts.edu.co',
            'password'=>Hash::make('12345678'),
        ]);
        DB::table('roles_user')->insert([
            'user_id'=>'1',
            'roles_rol_id'=>'1',
        ]);
        DB::table('roles_user')->insert([
            'user_id'=>'1',
            'roles_rol_id'=>'4',
        ]);
    }
}
