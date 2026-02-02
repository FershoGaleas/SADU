<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MotivoConsulta extends Model
{
    protected $primaryKey = 'id_consulta';
    public $incrementing = true;
    protected $keyType = 'int';


    use HasFactory;
    protected $fillable = [
        'identidad',
        'id_paciente',
        'nombre_medico',
        'descripcion_motivo',
        'historia_enfermedad_Actual',
        'diagnostico',
        'tratamiento',
        'examenes',
        'antecedentes',
        'fecha_siguiente_cita',
        'id_signos_vitales'

    ];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'id_paciente', 'id_paciente');

    }
    public function signoVital()
    {
        return $this->belongsTo(SignosVitales::class, 'id_signos_vitales', 'id_signos_vitales');
    }
    public function archivos()
    {
        return $this->hasMany(Archivos::class, 'id_consulta', 'id_consulta');

    }



}
