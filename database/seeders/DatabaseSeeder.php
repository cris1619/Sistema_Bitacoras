<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([

            RolesSeeder::class,

            EstadosSeeder::class,

            VinculosSeeder::class,

            AdminSeeder::class,

            ProgramaFormacionSeeder::class,
            
            FichaSeeder::class,
        ]);
    }
}