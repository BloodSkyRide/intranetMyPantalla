<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('historial_asistencia', function (Blueprint $table) {
            $table->id("id_historial_asistencia");
            $table->integer("id_user");
            $table->string('estado',255);
            $table->date('fecha')->nullable();
            $table->time("hora")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historial_asistencia');
    }
};
