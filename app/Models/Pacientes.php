<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pacientes extends Model
{
    protected $primaryKey = 'id_paciente';
    public $incrementing = true; // si es autoincremental
    protected $keyType = 'int';  // si es numérico
    protected $table = 'pacientes';
    use HasFactory;
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
        return $this->hasMany(MotivoConsulta::class, 'identidad', 'identidad');
    }

    public function apps(){
        return $this->hasMany(App::class, 'identidad');

    }
    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function signosVitales()
    {
        return $this->hasMany(SignosVitales::class, 'id_paciente');
    }

// Último registro de signos vitales
    public function ultimoSignoVital()
    {
        return $this->hasOne(SignosVitales::class, 'id_paciente', 'id')
            ->latest('created_at'); // o latest('id') si prefieres por id
    }



}

