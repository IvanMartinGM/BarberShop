<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('servicios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_servicio', 100);
            $table->text('descripcion')->nullable();
            $table->decimal('precio_base', 8, 2);
            $table->integer('duracion_minutos');
            $table->string('categoria', 60)->nullable();
            $table->string('imagen_servicio', 255)->nullable();
            $table->tinyInteger('estado')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('servicios');
    }
};