<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VinculosSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('vinculos_formativos')->insert([

            ['nombre_vinculo' => 'Contrato de Aprendizaje'],

            ['nombre_vinculo' => 'Pasantía'],

            ['nombre_vinculo' => 'Proyecto Productivo'],

            ['nombre_vinculo' => 'Monitoria']
        ]);
    }
}