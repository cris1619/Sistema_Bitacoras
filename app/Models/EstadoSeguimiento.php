<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EstadoSeguimiento extends Model
{
    protected $table = 'estados_seguimiento';

    protected $fillable = [
        'nombre_estado'
    ];

    // ==============================
    // RELACIÓN SEGUIMIENTOS
    // ==============================

    public function seguimientos()
    {
        return $this->hasMany(Seguimiento::class, 'estado_id');
    }
}