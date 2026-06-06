<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('horarios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_horario', 80);
            $table->text('descripcion')->nullable();
            $table->time('hora_inicio');
            $table->time('hora_fin');
            $table->tinyInteger('estado')->default(1);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('horarios');
    }
};