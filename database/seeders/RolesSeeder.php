<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [

            'Administrador',

            'Coordinador',

            'Instructor',

            'Aprendiz',
        ];

        foreach ($roles as $rol) {

            Role::create([
                'nombre_rol' => $rol
            ]);
        }
    }
}