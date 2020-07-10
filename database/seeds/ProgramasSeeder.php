<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProgramasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('programas')->insert([
            'pro_nombre'=>'TECNOLOGÍA EN CONTABILIDAD FINANCIERA',
            'pro_fac_id'=>2,
            'pro_coo_id'=>5,
        ]);
        DB::table('programas')->insert([
            'pro_nombre'=>'TECNOLOGÍA EN GESTIÓN DE LA MODA',
            'pro_fac_id'=>2,
            'pro_coo_id'=>4,
        ]);
        DB::table('programas')->insert([
            'pro_nombre'=>'TECNOLOGÍA EN BANCA Y FINANZAS',
            'pro_fac_id'=>2,
            'pro_coo_id'=>6,
        ]);
        DB::table('programas')->insert([
            'pro_nombre'=>'TECNOLOGÍA EN MERCADEO Y GESTIÓN COMERCIAL',
            'pro_fac_id'=>2,
            'pro_coo_id'=>3,
        ]);
        DB::table('programas')->insert([
            'pro_nombre'=>'TECNOLOGÍA EN GESTIÓN EMPRESARIAL',
            'pro_fac_id'=>2,
            'pro_coo_id'=>8,
        ]);
        DB::table('programas')->insert([
            'pro_nombre'=>'TECNOLOGÍA EN GESTIÓN AGROINDUSTRIAL',
            'pro_fac_id'=>2,
            'pro_coo_id'=>7,
        ]);
        DB::table('programas')->insert([
            'pro_nombre'=>'TECNOLOGÍA EN ENTRENAMIENTO DEPORTIVO',
            'pro_fac_id'=>2,
            'pro_coo_id'=>1,
        ]);
        DB::table('programas')->insert([
            'pro_nombre'=>'TECNOLOGÍA EN OPERACIÓN Y MANTENIMIENTO ELECTROMECÁNICO',
            'pro_fac_id'=>1,
            'pro_coo_id'=>12,
        ]);
        DB::table('programas')->insert([
            'pro_nombre'=>'TECNOLOGÍA EN LEVANTAMIENTOS TOPOGRÁFICOS',
            'pro_fac_id'=>1,
            'pro_coo_id'=>17,
        ]);
        DB::table('programas')->insert([
            'pro_nombre'=>'TECNOLOGÍA EN MANEJO DE RECURSOS AMBIENTALES',
            'pro_fac_id'=>1,
            'pro_coo_id'=>10,
        ]);
        DB::table('programas')->insert([
            'pro_nombre'=>'TECNOLOGÍA EN ELECTRICIDAD INDUSTRIAL',
            'pro_fac_id'=>1,
            'pro_coo_id'=>9,
        ]);
        DB::table('programas')->insert([
            'pro_nombre'=>'TECNOLOGÍA EN ESTUDIOS GEOTÉCNICOS',
            'pro_fac_id'=>1,
            'pro_coo_id'=>14,
        ]);
        DB::table('programas')->insert([
            'pro_nombre'=>'TECNOLOGÍA EN IMPLEMENTACIÓN DE SISTEMAS ELECTRÓNICOS INDUSTRIALES',
            'pro_fac_id'=>1,
            'pro_coo_id'=>13,
        ]);
        DB::table('programas')->insert([
            'pro_nombre'=>'TECNOLOGÍA EN GESTIÓN DE SISTEMAS DE TELECOMUNICACIONES',
            'pro_fac_id'=>1,
            'pro_coo_id'=>11,
        ]);
        DB::table('programas')->insert([
            'pro_nombre'=>'TECNOLOGÍA EN DESARROLLO DE SISTEMAS INFORMÁTICOS',
            'pro_fac_id'=>1,
            'pro_coo_id'=>15,
        ]);
        DB::table('programas')->insert([
            'pro_nombre'=>'TECNOLOGÍA EN PRODUCCIÓN INDUSTRIAL',
            'pro_fac_id'=>1,
            'pro_coo_id'=>18,
        ]);
        DB::table('programas')->insert([
            'pro_nombre'=>'ADMINISTRACION DE EMPRESAS',
            'pro_fac_id'=>2,
            'pro_coo_id'=>8,
        ]);
        DB::table('programas')->insert([
            'pro_nombre'=>'PROFESIONAL EN ACTIVIDAD FÍSICA Y DEPORTE',
            'pro_fac_id'=>2,
            'pro_coo_id'=>1,
        ]);
        DB::table('programas')->insert([
            'pro_nombre'=>'PROFESIONAL EN DISEÑO DE MODA',
            'pro_fac_id'=>2,
            'pro_coo_id'=>4,
        ]);
        DB::table('programas')->insert([
            'pro_nombre'=>'PROFESIONAL EN MARKETING Y NEGOCIOS INTERNACIONALES',
            'pro_fac_id'=>2,
            'pro_coo_id'=>3,
        ]);
        DB::table('programas')->insert([
            'pro_nombre'=>'CONTADURÍA PÚBLICA',
            'pro_fac_id'=>2,
            'pro_coo_id'=>5,
        ]);
        DB::table('programas')->insert([
            'pro_nombre'=>'INGENIERÍA DE TELECOMUNICACIONES',
            'pro_fac_id'=>1,
            'pro_coo_id'=>11,
        ]);
        DB::table('programas')->insert([
            'pro_nombre'=>'INGENIERÍA ELECTROMECÁNICA',
            'pro_fac_id'=>1,
            'pro_coo_id'=>12,
        ]);
        DB::table('programas')->insert([
            'pro_nombre'=>'INGENIERÍA AMBIENTAL',
            'pro_fac_id'=>1,
            'pro_coo_id'=>10,
        ]);
        DB::table('programas')->insert([
            'pro_nombre'=>'INGENIERÍA INDUSTRIAL',
            'pro_fac_id'=>1,
            'pro_coo_id'=>18,
        ]);
        DB::table('programas')->insert([
            'pro_nombre'=>'INGENIERÍA ELECTRÓNICA',
            'pro_fac_id'=>1,
            'pro_coo_id'=>13,
        ]);
        DB::table('programas')->insert([
            'pro_nombre'=>'INGENIERÍA ELÉCTRICA',
            'pro_fac_id'=>1,
            'pro_coo_id'=>9,
        ]);
        DB::table('programas')->insert([
            'pro_nombre'=>'INGENIERÍA DE SISTEMAS',
            'pro_fac_id'=>1,
            'pro_coo_id'=>15,
        ]);
        DB::table('programas')->insert([
            'pro_nombre'=>'INGENIERÍA EN TOPOGRAFÍA',
            'pro_fac_id'=>1,
            'pro_coo_id'=>17,
        ]);
        DB::table('programas')->insert([
            'pro_nombre'=>'TÉCNICO PROFESIONAL EN INSTALACION DE REDES ELÉCTRICAS',
            'pro_fac_id'=>1,
            'pro_coo_id'=>9,
        ]);
    }
}
