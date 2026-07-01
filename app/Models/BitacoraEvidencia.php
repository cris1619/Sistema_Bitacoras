<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BitacoraEvidencia extends Model
{
    use SoftDeletes;

    protected $table = 'bitacoras_evidencias';

    protected $fillable = [

        'aprendiz_id',
        'seguimiento_id',
        'estado_id',

        'numero_bitacora',

        'fecha_limite_entrega',
        'fecha_entrega',

        'archivo_evidencia_url',

        'novedades'
    ];

    // ===================================
    // RELACIÓN APRENDIZ
    // ===================================

    public function aprendiz()
    {
        return $this->belongsTo(
            Aprendiz::class,
            'aprendiz_id'
        );
    }

    // ===================================
    // RELACIÓN SEGUIMIENTO
    // ===================================

    public function seguimiento()
    {
        return $this->belongsTo(
            Seguimiento::class,
            'seguimiento_id'
        );
    }

    // ===================================
    // RELACIÓN ESTADO
    // ===================================

    public function estado()
    {
        return $this->belongsTo(
            EstadoBitacora::class,
            'estado_id'
        );
    }
}