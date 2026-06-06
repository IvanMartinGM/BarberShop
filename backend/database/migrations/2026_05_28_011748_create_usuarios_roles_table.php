<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('usuarios_roles', function (Blueprint $table) {
            $table->foreignId('id_usuario')->constrained('usuarios')->onDelete('cascade');
            $table->foreignId('id_rol')->constrained('roles')->onDelete('cascade');
            $table->timestamp('fecha_asignacion')->useCurrent();
            $table->tinyInteger('estado')->default(1);
            $table->primary(['id_usuario', 'id_rol']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('usuarios_roles');
    }
};