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
        Schema::create('horarios', function (Blueprint $table) {

            $table->id("id_horario");
            $table->string("id_user");
            $table->string("nombre",255)->nullable();
            $table->string("apellido",255)->nullable();
            $table->time('lunes')->nullable();
            $table->time('martes')->nullable();
            $table->time('miercoles')->nullable();
            $table->time('jueves')->nullable();
            $table->time('viernes')->nullable();
            $table->time('sabado')->nullable();
            $table->time('domingo')->nullable();
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('horarios');
    }
};
