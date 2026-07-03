<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EstadoSeguimiento extends Model
{
    protected $table = 'estados_seguimiento';

    protected $fillable = [
        'nombre_estado'
    ];
}