<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SignosVitales extends Model
{
    protected $table = 'signosvitales'; // ← nombre exacto de la tabla
    protected $primaryKey = 'id_signos_vitales'; // ← clave primaria personalizada
    public $incrementing = false; // ← porque identidad no es autoincremental
    protected $keyType = 'string';
    use HasFactory;
    protected $fillable = [
        'id_paciente',
        'identidad',
        'temperatura',
        'unidad_temperatura',
        'presion',
        'frecuencia_cardiaca',
        'peso',
        'unidad_peso',
        'altura',
        'unidad_altura',
        'saturacion_oxigeno',
        'unidad_saturacion_oxigeno',
        'glucometria',
        'unidad_glucometria',
        'indice_masa_corporal',
        'unidad_indice_masa_corporal',
        'plan_medico'

    ];
    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'id_paciente', 'id_paciente');

    }
    public function signos()
    {
        return $this->hasMany(SignosVitales::class, 'identidad', 'identidad');
    }

}
