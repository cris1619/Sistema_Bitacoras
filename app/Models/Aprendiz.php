<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Aprendiz extends Model
{
    use SoftDeletes;

    protected $table = 'aprendices';

    protected $fillable = [

        'ficha_id',
        'estado_id',
        'vinculo_id',

        'tipo_documento',
        'documento_identidad',

        'nombres',
        'apellidos',

        'correo_electronico',
        'telefono',

        'empresa',
        'jefe_inmediato',
        'correo_empresa',
        'telefono_empresa',

        'fecha_inicio_practica',
        'fecha_fin_practica',

        'detalles_contrato'
    ];

    // ====================================
    // RELACIÓN FICHA
    // ====================================

    public function ficha()
    {
        return $this->belongsTo(Ficha::class);
    }

    // ====================================
    // RELACIÓN ESTADO
    // ====================================

    public function estado()
    {
        return $this->belongsTo(
            EstadoAprendiz::class,
            'estado_id'
        );
    }

    // ====================================
    // RELACIÓN VÍNCULO
    // ====================================

    public function vinculo()
    {
        return $this->belongsTo(
            VinculoFormativo::class,
            'vinculo_id'
        );
    }

    // ====================================
    // RELACIÓN SEGUIMIENTOS
    // ====================================

    public function seguimientos()
    {
        return $this->hasMany(
            Seguimiento::class,
            'aprendiz_id'
        );
    }

    // ====================================
    // RELACIÓN BITÁCORAS
    // ====================================

    public function bitacoras()
    {
        return $this->hasMany(
            BitacoraEvidencia::class,
            'aprendiz_id'
        );
    }
}