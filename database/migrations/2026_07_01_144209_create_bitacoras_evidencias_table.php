<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bitacoras_evidencias', function (Blueprint $table) {

            $table->id();

            // =====================================
            // RELACIONES
            // =====================================

            $table->foreignId('aprendiz_id')
                ->constrained('aprendices')
                ->cascadeOnDelete();

            $table->foreignId('seguimiento_id')
                ->nullable()
                ->constrained('seguimientos')
                ->nullOnDelete();

            $table->foreignId('estado_id')
                ->constrained('estados_bitacora');

            // =====================================
            // DATOS BITÁCORA
            // =====================================

            $table->integer('numero_bitacora');

            $table->date('fecha_limite_entrega');

            $table->date('fecha_entrega')
                ->nullable();

            $table->string('archivo_evidencia_url')
                ->nullable();

            $table->text('novedades')
                ->nullable();

            // =====================================
            // CONTROL
            // =====================================

            $table->timestamps();

            $table->softDeletes();

            // =====================================
            // RESTRICCIÓN
            // =====================================

            $table->unique([
                'aprendiz_id',
                'numero_bitacora'
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bitacoras_evidencias');
    }
};