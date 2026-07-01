<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('aprendices', function (Blueprint $table) {

            $table->id();

            // =====================================
            // RELACIONES
            // =====================================

            $table->foreignId('ficha_id')
                ->constrained('fichas');

            $table->foreignId('estado_id')
                ->constrained('estados_aprendiz');

            $table->foreignId('vinculo_id')
                ->constrained('vinculos_formativos');

            // =====================================
            // DATOS PERSONALES
            // =====================================

            $table->string('tipo_documento', 10);

            $table->string('documento_identidad', 20)
                ->unique();

            $table->string('nombres', 100);

            $table->string('apellidos', 100);

            $table->string('correo_electronico', 100);

            $table->string('telefono', 20);

            // =====================================
            // INFORMACIÓN EMPRESARIAL
            // =====================================

            $table->string('empresa', 150)
                ->nullable();

            $table->string('jefe_inmediato', 150)
                ->nullable();

            $table->string('correo_empresa', 100)
                ->nullable();

            $table->string('telefono_empresa', 20)
                ->nullable();

            // =====================================
            // ETAPA PRODUCTIVA
            // =====================================

            $table->date('fecha_inicio_practica')
                ->nullable();

            $table->date('fecha_fin_practica')
                ->nullable();

            $table->text('detalles_contrato')
                ->nullable();

            // =====================================
            // CONTROL
            // =====================================

            $table->timestamps();

            $table->softDeletes();

            // =====================================
            // ÍNDICES
            // =====================================

            $table->index('documento_identidad');

            $table->index('ficha_id');

            $table->index('estado_id');

            $table->index('correo_electronico');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('aprendices');
    }
};