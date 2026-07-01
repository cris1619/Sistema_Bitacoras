<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('seguimientos', function (Blueprint $table) {

            $table->id();

            // =====================================
            // RELACIONES
            // =====================================

            $table->foreignId('aprendiz_id')
                ->constrained('aprendices')
                ->cascadeOnDelete();

            $table->foreignId('instructor_id')
                ->constrained('users');

            $table->foreignId('estado_id')
                ->constrained('estados_seguimiento');

            // =====================================
            // DATOS SEGUIMIENTO
            // =====================================

            $table->integer('numero_seguimiento');

            $table->date('fecha_programada');

            $table->date('fecha_realizada')
                ->nullable();

            $table->text('observaciones')
                ->nullable();

            $table->text('compromisos')
                ->nullable();

            $table->text('recomendaciones')
                ->nullable();

            $table->string('archivo_adjunto')
                ->nullable();

            // =====================================
            // CONTROL
            // =====================================

            $table->timestamps();

            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('seguimientos');
    }
};