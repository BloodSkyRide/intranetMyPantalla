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
        Schema::create('guardado_diario', function (Blueprint $table) {

            $table->id("id_guardado");
            $table->integer("id_user")->nullable();
            $table->string("nombre_user",255)->nullable();
            $table->date("fecha")->nullable();
            $table->text("lunes",255)->nullable();
            $table->text("martes",255)->nullable();
            $table->text("miercoles",255)->nullable();
            $table->text("jueves",255)->nullable();
            $table->text("viernes",255)->nullable();
            $table->text("sabado",255)->nullable();
            $table->text("domingo",255)->nullable();
            $table->timestamps();
            
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('guardado_diario');
    }
};
