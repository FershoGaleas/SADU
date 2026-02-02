<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Motivo_consulta extends Model
{
    use HasFactory;
    public function paciente(){
        return $this->belongsTo(Paciente::class,'id_paciente');
    }
}
