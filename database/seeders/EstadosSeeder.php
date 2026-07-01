<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstadosSeeder extends Seeder
{
    public function run(): void
    {
        // =============================
        // ESTADOS APRENDIZ
        // =============================

        DB::table('estados_aprendiz')->insert([

            ['nombre_estado' => 'Activo'],

            ['nombre_estado' => 'Finalizado'],

            ['nombre_estado' => 'Cancelado']
        ]);

        // =============================
        // ESTADOS SEGUIMIENTO
        // =============================

        DB::table('estados_seguimiento')->insert([

            ['nombre_estado' => 'Pendiente'],

            ['nombre_estado' => 'Realizado'],

            ['nombre_estado' => 'Atrasado']
        ]);

        // =============================
        // ESTADOS BITÁCORA
        // =============================

        DB::table('estados_bitacora')->insert([

            ['nombre_estado' => 'Pendiente'],

            ['nombre_estado' => 'Entregada'],

            ['nombre_estado' => 'Vencida']
        ]);
    }
}