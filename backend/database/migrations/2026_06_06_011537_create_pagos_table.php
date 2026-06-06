<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_cita')->unique()->constrained('citas')->onDelete('restrict');
            $table->foreignId('id_metodo_pago')->constrained('metodo_pago')->onDelete('restrict');
            $table->decimal('monto', 10, 2);
            $table->timestamp('fecha_pago')->useCurrent();
            $table->enum('estado_pago', ['pendiente', 'pagado', 'cancelado', 'reembolsado'])->default('pendiente');
            $table->string('referencia_transaccion', 150)->nullable();
            $table->string('concepto', 255)->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pagos');
    }
};