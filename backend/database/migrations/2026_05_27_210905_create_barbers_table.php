<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('barberos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_usuario')->unique()->constrained('usuarios')->onDelete('restrict');
            $table->enum('estado_disponibilidad', ['disponible', 'ocupado', 'inactivo'])->nullable();
            $table->string('especialidad', 150)->nullable();
            $table->text('biografia')->nullable();
            $table->date('fecha_contratacion')->nullable();
            $table->decimal('calificacion_promedio', 3, 2)->default(0.00);
            $table->integer('experiencia_anos')->default(0);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('barberos');
    }
};