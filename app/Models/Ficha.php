<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ficha extends Model
{
    protected $table = 'fichas';

    protected $fillable = [
        'numero_ficha',
        'programa_id'
    ];

    // ==============================
    // RELACIÓN PROGRAMA
    // ==============================

    public function programa()
    {
        return $this->belongsTo(
            ProgramaFormacion::class,
            'programa_id'
        );
    }

    // ==============================
    // RELACIÓN APRENDICES
    // ==============================

    public function aprendices()
    {
        return $this->hasMany(Aprendiz::class, 'ficha_id');
    }
}