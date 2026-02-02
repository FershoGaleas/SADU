<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalaEspera extends Model
{
    use HasFactory;

    protected $table = 'sala_esperas';
    protected $primaryKey = 'id_sala_espera'; // 👈 la PK correcta
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'id_paciente',
        'id_user',
        'identidad',
        'nombre_completo',
        'status',
        'plan_medico'
    ];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'id_paciente', 'id_paciente');
    }

    public function doctor()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}