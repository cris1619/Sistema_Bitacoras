<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('instructores', function (Blueprint $table) {

            $table->id();

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->string(
                'tipo_documento',
                10
            );

            $table->string(
                'documento_identidad',
                20
            )->unique();

            $table->string(
                'nombres',
                100
            );

            $table->string(
                'apellidos',
                100
            );

            $table->string(
                'correo_electronico',
                100
            )->unique();

            $table->string(
                'telefono',
                20
            );

            $table->timestamps();

            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('instructores');
    }
};