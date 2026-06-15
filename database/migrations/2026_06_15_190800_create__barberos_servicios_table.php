<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('barberos_servicios', function (Blueprint $table) {
            $table->foreignId('id_barbero')->constrained('barberos')->onDelete('cascade');
            $table->foreignId('id_servicio')->constrained('servicios')->onDelete('cascade');
            $table->tinyInteger('estado')->default(1);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
            $table->primary(['id_barbero', 'id_servicio']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('barberos_servicios');
    }
};