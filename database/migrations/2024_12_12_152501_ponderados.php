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
        Schema::create('ponderados', function (Blueprint $table) {

            $table->id("id_ponderado");
            $table->integer("id_user")->nullable();
            $table->string("nombre_user",255)->nullable();
            $table->integer("id_atributo")->nullable();
            $table->string("nombre_atributo_ponderado",255)->nullable();
            $table->float("ponderado")->nullable();
            $table->date("fecha")->nullable();
            $table->timestamps();
            
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('ponderados');
    }
};
