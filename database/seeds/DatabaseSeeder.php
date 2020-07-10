<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CoordinacionesSeeder::class);
        $this->call(FacultadesSeeder::class);
        $this->call(ProgramasSeeder::class);
        $this->call(ModalidadesSeeder::class);
        $this->call(RolesSeeder::class);
        $this->call(UserSeeder::class);
    }
}
