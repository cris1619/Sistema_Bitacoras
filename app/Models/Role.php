<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';

    protected $fillable = [
        'nombre_rol'
    ];

    // ====================================
    // RELACIÓN USUARIOS
    // ====================================

    public function usuarios()
    {
        return $this->belongsToMany(
            User::class,
            'usuario_roles',
            'rol_id',
            'usuario_id'
        );
    }
}