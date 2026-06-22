<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_usuario')->unique()->constrained('usuarios')->onDelete('restrict');
            $table->date('fecha_nacimiento')->nullable();
            $table->timestamp('ultima_visita')->nullable();
            $table->string('tipo_cliente', 50)->nullable();
            $table->integer('puntos_fidelidad')->default(0);
            $table->tinyInteger('acepta_notificaciones')->default(1);
            $table->text('notas_generales')->nullable();
            $table->integer('total_visitas')->default(0);
            $table->decimal('total_gastado', 10, 2)->default(0.00);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};