<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('instructor_programa', function (Blueprint $table) {

            $table->foreignId('instructor_id')
                ->constrained('instructores')
                ->cascadeOnDelete();

            $table->foreignId('programa_id')
                ->constrained('programas_formacion')
                ->cascadeOnDelete();

            $table->primary([
                'instructor_id',
                'programa_id'
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(
            'instructor_programa'
        );
    }
};