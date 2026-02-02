<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Archivos extends Model
{
    use HasFactory;
    protected $fillable = ['id_consulta', 'ruta'];

    public function consulta()
    {
        return $this->belongsTo(MotivoConsulta::class, 'id_consulta', 'id_consulta');
    }


}
