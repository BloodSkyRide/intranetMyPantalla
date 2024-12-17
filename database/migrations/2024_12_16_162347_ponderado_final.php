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
        Schema::create('ponderado_final', function (Blueprint $table) {

            $table->id("id_final");
            $table->integer("id_user")->nullable();
            $table->string("nombre_user",255)->nullable();
            $table->string("apellido_user",255)->nullable();
            $table->float("ponderado_final")->nullable();
            $table->date("fecha")->nullable();
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('id_ponderado');
    }
};
