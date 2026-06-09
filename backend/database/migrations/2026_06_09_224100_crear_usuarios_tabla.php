<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('nombres', 100);
            $table->string('primer_apellido', 60);
            $table->string('segundo_apellido', 60)->nullable();
            $table->string('correo', 150)->unique();
            $table->string('contrasena', 255);
            $table->tinyInteger('estado')->default(1);
            $table->string('nombre_usuario', 60)->unique();
            $table->timestamp('fecha_registro')->useCurrent();
            $table->timestamp('ultimo_acceso')->nullable();
            $table->enum('genero', ['M', 'F', 'otro'])->nullable();
            $table->string('foto_perfil', 255)->nullable();
            $table->string('celular', 20)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};