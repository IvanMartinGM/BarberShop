<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('citas_servicios', function (Blueprint $table) {
            $table->foreignId('id_cita')->constrained('citas')->onDelete('cascade');
            $table->foreignId('id_servicio')->constrained('servicios')->onDelete('cascade');
            $table->decimal('precio_aplicado', 8, 2);
            $table->timestamp('hora_inicio_real')->nullable();
            $table->timestamp('hora_fin_real')->nullable();
            $table->integer('duracion_real_minutos')->nullable();
            $table->text('observaciones_servicio')->nullable();
            $table->primary(['id_cita', 'id_servicio']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('citas_servicios');
    }
};