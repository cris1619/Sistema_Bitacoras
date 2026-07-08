<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Instructor extends Model
{
    use SoftDeletes;

    protected $table = 'instructores';

    protected $fillable = [

        'user_id',
        'tipo_documento',
        'documento_identidad',
        'nombres',
        'apellidos',
        'correo_electronico',
        'telefono',
    ];

    /*
    |--------------------------------------------------------------------------
    | USER
    |--------------------------------------------------------------------------
    */

    public function user()
    {
        return $this->belongsTo(
            User::class
        );
    }

    /*
    |--------------------------------------------------------------------------
    | PROGRAMAS
    |--------------------------------------------------------------------------
    */

    public function programas()
    {
        return $this->belongsToMany(

            ProgramaFormacion::class,

            'instructor_programa',

            'instructor_id',

            'programa_id'
        );
    }

    public function programaIds()
    {
        return $this->programas()
            ->pluck('programas_formacion.id');
    }

    /*
    |--------------------------------------------------------------------------
    | NOMBRE COMPLETO
    |--------------------------------------------------------------------------
    */

    public function getNombreCompletoAttribute()
    {
        return $this->nombres . ' ' .
               $this->apellidos;
    }
}