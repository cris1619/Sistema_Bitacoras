<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramaFormacion extends Model
{
    protected $table = 'programas_formacion';

    protected $fillable = [
        'codigo_programa',
        'nombre_programa',
        'nivel_formacion'
    ];

    // ==============================
    // RELACIÓN FICHAS
    // ==============================

    public function fichas()
    {
        return $this->hasMany(Ficha::class, 'programa_id');
    }
}