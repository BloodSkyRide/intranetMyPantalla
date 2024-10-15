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
        Schema::create('historial_labores', function (Blueprint $table) {
            $table->id("id_historial_labores");
            $table->string("id_labor",255);
            $table->string('id_sub_labor',255);
            $table->string('id_user', 255)->nullable();
            $table->date("fecha")->nullable();
            $table->string("estado",255)->nullable();
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historial_labores');
    }
};
