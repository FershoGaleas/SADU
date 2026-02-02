<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('SignosVitales', function (Blueprint $table) {
            $table->id('id_signos_vitales');
            $table->unsignedBigInteger('id_paciente');
            $table->string('identidad',20);
            $table->foreign('identidad')->references('identidad')->on('pacientes')->onDelete('cascade')->onUpdate('cascade');
            $table->decimal('temperatura')->nullable();
            $table->string('unidad_temperatura')->nullable();
            $table->string('presion')->nullable();
            $table->string('frecuencia_cardiaca')->nullable();
            $table->decimal('peso')->nullable();
            $table->string('unidad_peso')->nullable();
            $table->integer('altura')->nullable();
            $table->string('unidad_altura')->nullable();
            $table->decimal('saturacion_oxigeno')->nullable();
            $table->string('unidad_saturacion_oxigeno')->nullable();
            $table->decimal('glucometria')->nullable();
            $table->string('unidad_glucometria')->nullable();
            $table->decimal('indice_masa_corporal')->nullable();
            $table->string('unidad_indice_masa_corporal')->nullable();
            $table->dateTime('fecha_ingreso')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('plan_medico')->nullable();
            $table->foreign('id_paciente')->references('id_paciente')->on('pacientes');
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
        Schema::dropIfExists('SignosVitales');
    }
};
