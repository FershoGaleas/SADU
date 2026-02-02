<?php

namespace App\Http\Controllers;

use App\Models\MotivoConsulta;
use App\Models\SalaEspera;
use App\Models\SignosVitales;
use Illuminate\Http\Request;

class MotivoConsultaController extends Controller
{
    protected $primaryKey = 'id_consulta';
    public $incrementing = false;
    protected $keyType = 'string';
    public function destroy($id_consulta)
    {
        $consulta = MotivoConsulta::where('id_consulta', $id_consulta)->firstOrFail();
        $consulta->delete();

        return redirect()->route('pacientes.historial', $id_consulta)->with('success', 'Consulta eliminada correctamente.');
    }

    public function edit($id_consulta)
    {
        $consulta = MotivoConsulta::findOrFail($id_consulta);
        return view('consultas.edit', compact('consulta'));
    }

    public function update(Request $request, $id_consulta)
    {
        $consulta = MotivoConsulta::findOrFail($id_consulta);

        $consulta->update($request->all());

        return redirect()->route('pacientes.historial', $consulta->id_paciente)->with('success', 'Consulta actualizada correctamente.');
    }

    public function store(Request $request)
    {
        $request->validate([
            'identidad' => 'required|exists:pacientes,identidad',
            'id_paciente' => 'required|exists:pacientes,id_paciente',
            'nombre_medico' => 'required|string',
            'descripcion_motivo' => 'required|string',
            'historia_enfermedad_Actual' => 'nullable|string',
            'diagnostico' => 'nullable|string',
            'tratamiento' => 'nullable|string',
            'examenes' => 'nullable|string',
            'antecedentes' => 'nullable|string',
            'fecha_siguiente_cita' => 'nullable|date|after_or_equal:today'
    ]);

        // Buscar el último signo vital del paciente
        $ultimoSigno = SignosVitales::where('id_paciente', $request->id_paciente)
            ->latest('created_at')
            ->first();

        // Crear la consulta incluyendo el id_signo_vital
        $consulta = MotivoConsulta::create(array_merge(
            $request->all(),
            ['id_signo_vital' => $ultimoSigno?->id_signo_vital] // si existe, lo guarda
        ));
        $sala = SalaEspera::where('id_paciente', $request->id_paciente)
            ->latest('created_at')
            ->first();

        if ($sala) {
            $sala->update(['status' => 'Receta']);
        }
        // Guardar archivos si existen
        if ($request->hasFile('archivos')) {
            foreach ($request->file('archivos') as $archivo) {
                $nombre = time().'_'.$archivo->getClientOriginalName();
                $archivo->move(public_path('images'), $nombre);

                $consulta->archivos()->create([
                    'ruta' => 'images/'.$nombre
                ]);
            }
        }



        return back()->with('success', 'Consulta registrada correctamente.');
    }
}