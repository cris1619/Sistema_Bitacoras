<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ficha;

class FichaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fichas = [

            [
                'numero_ficha' => '2977423',
                'programa_id' => 1,
            ],

            [
                'numero_ficha' => '2977424',
                'programa_id' => 1,
            ],

            [
                'numero_ficha' => '2977425',
                'programa_id' => 2,
            ],

            [
                'numero_ficha' => '2977426',
                'programa_id' => 3,
            ],

        ];

        foreach ($fichas as $ficha) {

            Ficha::updateOrCreate(

                [
                    'numero_ficha' => $ficha['numero_ficha'],
                ],

                $ficha

            );

        }
    }
}