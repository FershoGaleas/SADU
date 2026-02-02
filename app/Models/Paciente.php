<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_paciente';
    public $incrementing = true; // si es autoincremental
    protected $keyType = 'int';  // si es numérico
    protected $table = 'pacientes';
    protected $fillable = [
        'identidad',
        'nombre_completo',
        'dia',
        'mes',
        'anio',
        'direccion',
        'telefono',
        'edad_valor',
        'edad_unidad',
        'sexo'
    ];

    public function consultas()
    {
        return $this->hasMany(MotivoConsulta::class, 'id_paciente', 'id_paciente');
    }

    public function apps()
    {
        return $this->hasMany(App::class, 'identidad');

    }
    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }


    public function motivoconsulta()
    {
        return $this->hasOne(MotivoConsulta::class, 'identidad');
    }
    public function signosVitales()
    {
        return $this->hasMany(SignosVitales::class, 'id_paciente', 'id_paciente');
    }

// Último registro de signos vitales
    public function ultimoSignoVital()
    {
        return $this->hasOne(SignosVitales::class, 'id_paciente', 'id_paciente')
            ->latest('created_at'); // o latest('id') si prefieres por id
    }


}
