<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fichas', function (Blueprint $table) {

            $table->id();

            $table->string('numero_ficha', 20)->unique();

            $table->foreignId('programa_id')
                ->constrained('programas_formacion');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fichas');
    }
};