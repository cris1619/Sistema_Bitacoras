<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EstadoAprendiz extends Model
{
    protected $table = 'estados_aprendiz';

    protected $fillable = [
        'nombre_estado'
    ];

    // ==============================
    // RELACIÓN APRENDICES
    // ==============================

    public function aprendices()
    {
        return $this->hasMany(Aprendiz::class, 'estado_id');
    }
}