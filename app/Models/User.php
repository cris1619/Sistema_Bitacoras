<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $table = 'users';

    protected $fillable = [
        'nombre_completo',
        'email',
        'password'
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    // =========================
    // ROLES
    // =========================

    public function roles()
    {
        return $this->belongsToMany(
            Role::class,
            'usuario_roles',
            'usuario_id',
            'rol_id'
        );
    }

    // =========================
    // SEGUIMIENTOS
    // =========================

    public function seguimientos()
    {
        return $this->hasMany(Seguimiento::class, 'instructor_id');
    }

        // ===================================
    // VERIFICAR ROL
    // ===================================

    public function tieneRol($rol)
    {
        return $this->roles()
            ->where('nombre_rol', $rol)
            ->exists();
    }
}