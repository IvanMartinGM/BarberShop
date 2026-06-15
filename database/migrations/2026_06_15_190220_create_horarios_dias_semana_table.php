<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('horarios_dias_semana', function (Blueprint $table) {
            $table->foreignId('id_horario')->constrained('horarios')->onDelete('cascade');
            $table->foreignId('id_dia')->constrained('dias_semana')->onDelete('cascade');
            $table->primary(['id_horario', 'id_dia']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('horarios_dias_semana');
    }
};