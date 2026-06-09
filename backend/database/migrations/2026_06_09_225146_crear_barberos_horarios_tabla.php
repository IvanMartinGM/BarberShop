<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	public function up(): void
	{
		Schema::create('barberos_horarios', function (Blueprint $table) {
			$table->foreignId('id_barbero')->constrained('barberos')->onDelete('cascade');
			$table->foreignId('id_horario')->constrained('horarios')->onDelete('cascade');
			$table->timestamp('fecha_asignacion')->useCurrent();
			$table->tinyInteger('estado')->default(1);
			$table->primary(['id_barbero', 'id_horario']);
		});
	}

	public function down(): void
	{
		Schema::dropIfExists('barberos_horarios');
	}
};
