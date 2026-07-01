<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('programas_formacion', function (Blueprint $table) {

            $table->id();

            $table->string('codigo_programa', 20)->unique();

            $table->string('nombre_programa', 150);

            $table->string('nivel_formacion', 50);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('programas_formacion');
    }
};