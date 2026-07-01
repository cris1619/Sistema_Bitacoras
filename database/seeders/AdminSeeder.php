<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::create([

            'nombre_completo' => 'Administrador General',

            'email' => 'admin@bitacoras.com',

            'password' => Hash::make('12345678')
        ]);

        $rolAdmin = Role::where(
            'nombre_rol',
            'Administrador'
        )->first();

        $admin->roles()->attach($rolAdmin->id);
    }
}