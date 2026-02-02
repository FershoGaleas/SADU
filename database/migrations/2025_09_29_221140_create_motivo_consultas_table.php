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

        Schema::create('motivo_consultas', function (Blueprint $table) {
            $table->id('id_consulta');
            $table->unsignedBigInteger('id_paciente');
            $table->string('identidad',20);
            $table->string('nombre_medico',100);
            $table->longText('descripcion_motivo');
            $table->longText('historia_enfermedad_Actual');
            $table->longText('diagnostico');
            $table->longText('tratamiento');
            $table->longText('examenes');
            $table->longText('antecedentes');
            $table->unsignedBigInteger('id_signos_vitales')->nullable();
            $table->foreign('id_signos_vitales')
                ->references('id_signos_vitales')
                ->on('signos_vitales')
                ->onDelete('set null');
            $table->dateTime('fecha_actual')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->date('fecha_siguiente_cita')->nullable();
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
        Schema::dropIfExists('motivo_consultas');
    }
};






