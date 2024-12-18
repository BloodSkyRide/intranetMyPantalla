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
        Schema::create('atributos', function (Blueprint $table) {

            $table->id("id_atributo");
            $table->string("nombre_atributo",255);
            $table->integer("porcentaje_efectividad")->nullable();
            $table->date("fecha")->nullable();
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('atributos');
    }
};