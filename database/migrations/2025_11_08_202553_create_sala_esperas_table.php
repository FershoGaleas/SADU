<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sala_esperas', function (Blueprint $table) {
            $table->id('id_sala_espera');
            $table->unsignedBigInteger('id_paciente')->nullable();
            $table->unsignedBigInteger('id_user')->nullable();
            $table->foreign('id_paciente')->references('id_paciente')->on('pacientes');
            $table->string('identidad', 20)->nullable();
            $table->string('nombre_completo', 150)->nullable();
            $table->dateTime('fecha_llegada')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->foreign('id_user')->references('id')->on('users');
            $table->string('status')->default('Pendiente');
            $table->string('plan_medico')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sala_esperas');
    }
};
