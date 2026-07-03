<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Seguimiento extends Model
{
    use SoftDeletes;

    protected $table = 'seguimientos';

    protected $fillable = [

        'aprendiz_id',
        'instructor_id',
        'estado_id',
        'numero_seguimiento',
        'fecha_programada',
        'fecha_realizada',
        'observaciones',
        'compromisos',
        'recomendaciones',
        'archivo_adjunto',
    ];

    // RELACIONES

    public function aprendiz()
    {
        return $this->belongsTo(Aprendiz::class);
    }

    public function instructor()
    {
        return $this->belongsTo(User::class, 'instructor_id');
    }

    public function estado()
    {
        return $this->belongsTo(
            EstadoSeguimiento::class,
            'estado_id'
        );
    }
}