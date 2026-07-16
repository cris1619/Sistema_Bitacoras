<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProgramaFormacion;

class ProgramaFormacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $programas = [

            [
                'codigo_programa' => '228106',
                'nombre_programa' => 'Tecnólogo en Análisis y Desarrollo de Software',
                'nivel_formacion' => 'Tecnólogo',
                       ],

            [
                'codigo_programa' => '228185',
                'nombre_programa' => 'Tecnólogo en Desarrollo de Videojuegos y Entornos Interactivos',
                'nivel_formacion' => 'Tecnólogo',
            ],

            [
                'codigo_programa' => '228180',
                'nombre_programa' => 'Tecnólogo en Gestión de Redes de Datos',
                'nivel_formacion' => 'Tecnólogo',
            ],

            [
                'codigo_programa' => '228181',
                'nombre_programa' => 'Tecnólogo en Producción Multimedia',
                'nivel_formacion' => 'Tecnólogo',
            ],

        ];

        foreach ($programas as $programa) {

            ProgramaFormacion::updateOrCreate(

                [
                    'codigo_programa' => $programa['codigo_programa'],
                ],

                $programa

            );
        }
    }
}