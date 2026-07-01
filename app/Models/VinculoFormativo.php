<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VinculoFormativo extends Model
{
    protected $table = 'vinculos_formativos';

    protected $fillable = [
        'nombre_vinculo'
    ];

    // ==============================
    // RELACIÓN APRENDICES
    // ==============================

    public function aprendices()
    {
        return $this->hasMany(Aprendiz::class, 'vinculo_id');
    }
}