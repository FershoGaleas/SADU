<?php

namespace App\Http\Controllers;

use App\Models\Motivo_consulta;
use App\Models\MotivoConsulta;
use App\Models\Paciente;
use App\Models\SalaEspera;
use App\Models\SignosVitales;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf;


class PacienteController extends Controller
{
    protected $primaryKey = 'identidad';

    public function destroy($id_paciente)
    {
        $paciente = Paciente::where('id_paciente', $id_paciente)->firstOrFail();

        // Eliminar consultas asociadas
        $paciente->consultas()->delete();

        // Eliminar signos vitales asociados
        $paciente->signosVitales()->delete();

        // Eliminar paciente
        $paciente->delete();

        return redirect()->route('pacientes.busqueda_paciente')
            ->with('success', 'Paciente y sus registros fueron eliminados correctamente');
    }

    public function destroy_espera($id_paciente)
        {
            $paciente = SalaEspera::where('id_paciente', $id_paciente)->firstOrFail();

            // Eliminar consultas asociadas


            // Eliminar paciente
            $paciente->delete();

            return back()->with('success', 'Paciente despachado con exito');
        }
    public function destroy_historial_enfermera($identidad)
    {
        // Buscar paciente
        $paciente = Paciente::where('identidad', $identidad)->firstOrFail();

        // Eliminar signos vitales asociados
        SignosVitales::where('identidad', $identidad)->delete();

        // Eliminar consultas asociadas
        $paciente->consultas()->delete();

        // Eliminar paciente
        $paciente->delete();

        return redirect()->route('pacientes.busqueda_pacientes')->with('success', 'Paciente, sus signos vitales y consultas fueron eliminados correctamente');
    }
    public function destroy_signos($identidad)
    {
        $consulta = SignosVitales::where('identidad', $identidad)->firstOrFail();
        $consulta->delete();

        return redirect()->route('pacientes.historial_enfermera', $identidad)->with('success', 'Consulta eliminada correctamente.');
    }
    public function UpdateSoloPaciente(Request $request, $id_paciente)
    {
        $request->validate([
            'identidad' => 'required|string|max:20',
            'nombre_completo' => 'required|string|max:100',
            //fecha de nacimineto
            'dia'=> 'integer',
            'mes'=>'integer',
            'anio'=> 'integer',
            //fin de fecha de nacimiento
            'direccion' => 'string|max:200',
            'telefono' => 'string|max:20',
            'edad_valor' => 'required|numeric|min:0',
            'edad_unidad' => 'required|in:años,meses,días',
            'sexo' => 'in:1,2'
        ]);

        // Buscar paciente por ID
        $paciente = Paciente::where('id_paciente', $id_paciente)->firstOrFail();

        // Obtener identidad desde el paciente
        $identidad = $paciente->identidad;


        // Actualizar paciente
        $paciente->update([
            'identidad'=>$request->identidad,
            'nombre_completo' => $request->nombre_completo,
            'dia' => $request->dia,
            'mes' => $request->mes,
            'anio' => $request->anio,
            'direccion' => $request->direccion,
            'telefono' => $request->telefono,
            'edad_valor' => $request->edad_valor,
            'edad_unidad' => $request->edad_unidad,
            'sexo' => $request->sexo,
        ]);
        return redirect()->back()->with('success', 'Datos actualizados correctamente');
    }
    public function updatePorPaciente(Request $request, $id_paciente)
    {
        $request->validate([
            'identidad' => 'required|string|max:20',
            'nombre_completo' => 'required|string|max:100',
            //fecha de nacimineto
            'dia'=> 'integer',
            'mes'=>'integer',
            'anio'=> 'integer',
            //fin de fecha de nacimiento
            'direccion' => 'string|max:200',
            'telefono' => 'string|max:20',
            'edad_valor' => 'required|numeric|min:0',
            'edad_unidad' => 'required|in:años,meses,días',
            'sexo' => 'in:1,2',
            'temperatura'=> 'nullable|numeric|min:0',
            'unidad_temperatura'=>'required|in:Celsius,Farenheit,Kelvin',
            'presion'=>'string|nullable',
            'frecuencia_cardiaca'=>'string|nullable',
            'peso'=>'numeric|nullable',
            'unidad_peso'=>'nullable|in:kilogramos',
            'saturacion_oxigeno'=>'numeric|nullable',
            'unidad_saturacion_oxigeno'=>'nullable|in:%',
            'glucometria'=>'numeric|nullable',
            'unidad_glucometria'=>'nullable|in:mg/dl',
            'indice_masa_corporal'=>'numeric|nullable',
            'unidad_indice_masa_corporal'=>'nullable|in:kg/m2',
            'altura'=>'numeric|nullable',
            'unidad_altura'=>'nullable|in:Metros',
            'plan_medico'=>'nullable|in:si,no'
        ]);

        // Buscar paciente por ID
        $paciente = Paciente::where('id_paciente', $id_paciente)->firstOrFail();

        // Obtener identidad desde el paciente
        $identidad = $paciente->identidad;

        // Buscar signos vitales por identidad
        $signos = SignosVitales::where('identidad', $identidad)->firstOrFail();

        // Actualizar paciente
        $paciente->update([
            'identidad'=>$request->identidad,
            'nombre_completo' => $request->nombre_completo,
            'dia' => $request->dia,
            'mes' => $request->mes,
            'anio' => $request->anio,
            'direccion' => $request->direccion,
            'telefono' => $request->telefono,
            'edad_valor' => $request->edad_valor,
            'edad_unidad' => $request->edad_unidad,
            'sexo' => $request->sexo,
        ]);

        // Actualizar signos vitales
        $signos->update([
            'identidad' => $identidad,
            'temperatura' => $request->temperatura,
            'unidad_temperatura' => $request->unidad_temperatura,
            'presion' => $request->presion,
            'frecuencia_cardiaca' => $request->frecuencia_cardiaca,
            'peso' => $request->peso,
            'unidad_peso' => $request->unidad_peso,
            'altura'=>$request->altura,
            'unidad_altura'=>$request->unidad_altura,
            'saturacion_oxigeno'=>$request->saturacion_oxigeno,
            'unidad_saturacion_oxigeno'=>$request->unidad_saturacion_oxigeno,
            'glucometria'=>$request->glucometria,
            'unidad_glucometria'=>$request->unidad_glucometria,
            'indice_masa_corporal'=>$request->indice_masa_corporal,
            'unidad_indice_masa_corporal'=>$request->unidad_indice_masa_corporal,
            'plan_medico'=>$request->plan_medico
        ]);

        return redirect()->back()->with('success', 'Datos actualizados correctamente');
    }
    public function updatePorSignos(Request $request, $id_signos_vitales,$id_paciente)
    {
        $signos = SignosVitales::where('id_signos_vitales', $id_signos_vitales)->firstOrFail();

        $signos->update([
            'identidad'=>$signos->identidad,
            'temperatura'=>$request->temperatura,
            'unidad_temperatura'=>$request->unidad_temperatura,
            'presion'=>$request->presion,
            'frecuencia_cardiaca'=>$request->frecuencia_cardiaca,
            'peso'=>$request->peso,
            'unidad_peso'=>$request->unidad_peso,
            'saturacion_oxigeno'=>$request->saturacion_oxigeno,
            'unidad_saturacion_oxigeno'=>$request->unidad_saturacion_oxigeno,
            'glucometria'=>$request->glucometria,
            'unidad_glucometria'=>$request->unidad_glucometria,
            'indice_masa_corporal'=>$request->indice_masa_corporal,
            'unidad_indice_masa_corporal'=>$request->unidad_indice_masa_corporal,
            'altura'=>$request->altura,
            'unidad_altura'=>$request->unidad_altura,
            'plan_medico'=>$request->plan_medico

        ]);
        return redirect()->route('pacientes.historial_enfermera', $id_paciente)->with('success', 'Signos actualizados correctamente.');
    }
    public function historial($id_paciente)
    {
        // Buscar el paciente por ID y cargar sus consultas
        $paciente = Paciente::where('id_paciente', $id_paciente)
            ->with('consultas')
            ->first();

        if (!$paciente) {
            return redirect()->route('pacientes.busqueda_paciente')
                ->with('error', 'Paciente no encontrado');
        }

        // Obtener la identidad desde el paciente
        $identidad = $paciente->identidad;

        // Buscar los signos vitales por identidad
        $signos = SignosVitales::where('identidad', $identidad)
            ->orderBy('created_at','desc')
            ->first(); // ← puedes quitar with('signos') si no existe esa relación

        return view('pacientes.historial', compact('paciente', 'signos'));
    }




    public function historial_enfermera($id_paciente)
    {
        // Buscar el paciente por ID y cargar sus consultas
        $paciente = Paciente::where('id_paciente', $id_paciente)
            ->with('consultas')
            ->first();

        if (!$paciente) {
            return redirect()->route('pacientes.busqueda_paciente')
                ->with('error', 'Paciente no encontrado');
        }

        // Obtener la identidad desde el paciente
        $identidad = $paciente->identidad;

        // Buscar los signos vitales por identidad
        $signos = SignosVitales::where('identidad', $identidad)
            ->first(); // ← puedes quitar with('signos') si no existe esa relación
        $usuarios = User::all();
        return view('pacientes.historial_enfermera', compact('paciente', 'signos', 'usuarios'));
    }

    public function index(){
        $pacientes = Paciente::paginate(10);
        return view('pacientes.index', compact('pacientes'));
    }
    public function busqueda_pacientes(Request $request){
        $query = Paciente::query();
        if ($request->filled('identidad')) {
            $query->where('identidad', 'like', '%' . $request->identidad . '%');
        }
        if ($request->filled('nombre')) {
            $query->where('nombre_completo', 'like', '%' . $request->nombre . '%');
        }

        if ($request->filled('sexo')) {
            $query->where('sexo', $request->sexo);
        }
        if ($request->filled('fecha_registro')) {
            $query->whereDate('created_at', $request->fecha_registro);
        }

        $pacientes = $query->paginate(10);
        return view('pacientes.busqueda_paciente', compact('pacientes'));
    }
    public function sala_espera_busqueda(Request $request){
        $query = Paciente::query();
        if ($request->filled('identidad')) {
            $query->where('identidad', 'like', '%' . $request->identidad . '%');
        }
        if ($request->filled('nombre')) {
            $query->where('nombre_completo', 'like', '%' . $request->nombre . '%');
        }

        if ($request->filled('sexo')) {
            $query->where('sexo', $request->sexo);
        }
        if ($request->filled('fecha_registro')) {
            $query->whereDate('created_at', $request->fecha_registro);
        }

        $pacientes = $query->paginate(10);
        return view('pacientes.formulario_sala_espera', compact('pacientes'));
    }
    public function buscar(Request $request)
    {
        $query = Paciente::query();
        if ($request->filled('identidad')) {
            $query->where('identidad', 'like', '%' . $request->identidad . '%');
        }
        if ($request->filled('nombre')) {
            $query->where('nombre_completo', 'like', '%' . $request->nombre . '%');
        }

        if ($request->filled('sexo')) {
            $query->where('sexo', $request->sexo);
        }
        if ($request->filled('fecha_registro')) {
            $query->whereDate('created_at', $request->fecha_registro);
        }

        $pacientes = $query->paginate(10);
        return view('pacientes.index', compact('pacientes'));
    }


    //mostrar formulario
    public function create(){
        return view('pacientes.create');
    }
    public function create_formulario(){
        $usuarios = User::all();
        return view('pacientes.formulario_cliente',compact('usuarios'));
    }

    //guardar paciente en la bbdd
    public function store(Request $request){
        $request->validate([
            'identidad' => 'required|string|max:20|unique:pacientes,identidad',
           'nombre_completo' => 'required|string|max:100',
            //fecha de nacimiento
            'dia' => 'integer',
            'mes' => 'integer',
            'anio' => 'integer',
            //fin de fecha de nacimiento
            'direccion' => 'string|max:200',
            'telefono' => 'string|max:20',
            'edad_valor' => 'required|numeric|min:0',
            'edad_unidad' => 'required|in:años,meses,días',
            'sexo' => 'in:1,2',
            'id_paciente' => 'required|integer|exists:pacientes,id_paciente',
            'descripcion_motivo' => 'string|max:255',
            'historia_enfermedad_Actual' => 'nullable|string|max:1000',
            'diagnostico' => 'nullable|string|max:1000',
            'tratamiento' => 'nullable|string|max:1000',
            'examenes' => 'nullable|string|max:1000',
            'antecedentes' => 'nullable|string|max:1000',
            'fecha_siguiente_cita' => 'nullable|date|after_or_equal:today'
        ]);

        $paciente = Paciente::create([
            'identidad' => $request->identidad,
            'nombre_completo' => $request->nombre_completo,
            'dia' => $request->dia,
            'mes' => $request->mes,
            'anio' => $request->anio,
            'direccion' => $request->direccion,
            'telefono' => $request->telefono,
            'edad_valor' => $request->edad_valor,
             'edad_unidad' => $request->edad_unidad,
            'sexo' => $request->sexo

        ]);

        //voy a guardar motivo de consulta vinculado al paciente
        MotivoConsulta::create([
            'identidad' => $paciente->identidad,
            'id_paciente'=>$paciente->id_paciente,
            'nombre_medico' => $request->nombre_medico,
            'descripcion_motivo' => $request->descripcion_motivo,
            'historia_enfermedad_Actual' => $request->historia_enfermedad_Actual,
            'diagnostico' => $request->diagnostico,
            'tratamiento' => $request->tratamiento,
            'examenes' => $request->examenes,
            'antecedentes' => $request->antecedentes,
            'fecha_siguiente_cita' => $request->fecha_siguiente_cita
        ]);

        return redirect()->route('pacientes.create')-> with('success','Consulta Guardada con exito');


    }
    public function busqueda_paciente(Request $request){

        $query = Paciente::query();
        if ($request->filled('identidad')) {
            $query->where('identidad', 'like', '%' . $request->identidad . '%');
        }
        if ($request->filled('nombre')) {
            $query->where('nombre_completo', 'like', '%' . $request->nombre . '%');
        }
        if ($request->filled('sexo')) {
            $query->where('sexo', $request->sexo);
        }
        if ($request->filled('fecha_registro')) {
            $query->whereDate('created_at', $request->fecha_registro);
        }
        $pacientes = $query->with('ultimoSignoVital')->paginate(10);



        return view('pacientes.busqueda_paciente', compact('pacientes'));

    }
    //Formulario_historial_guardar se encarga de ingresar los datos del ultimo formulario de historial_enfermera
    public function sala_espera($id_paciente)
    {
        // Buscar paciente por su PK
        $paciente = Paciente::findOrFail($id_paciente);

        // Último signo vital
        $ultimoSigno = SignosVitales::where('identidad', $paciente->identidad)
            ->latest('created_at')
            ->first();


        // Verificar si ya está en sala de espera
        $existe = SalaEspera::where('id_paciente', $paciente->id_paciente)->first();

        if (!$existe) {
            SalaEspera::create([
                'identidad'       => $paciente->identidad,
                'id_paciente'     => $paciente->id_paciente,
                'nombre_completo' => $paciente->nombre_completo,
                'estado'          => 'Pendiente',
                'plan_medico' => optional($ultimoSigno)->plan_medico,

            ]);
        }

        return redirect()->back()->with('success', 'Paciente agregado a sala de espera');
    }
    public function busqueda_sala(Request $request)
    {
        $query = SalaEspera::with(['paciente.consultas'])
            ->join('users', 'sala_esperas.id_user', '=', 'users.id')
            ->select('sala_esperas.*', 'users.name as nombre_usuario')
            ->where(function($q){
                $q->where('sala_esperas.id_user',auth()->id())
                    ->orwhere('sala_esperas.id_enfermera',auth()->id());
            }); // <-- filtro por usuario actual o por enfermera actual

        if ($request->filled('identidad')) {
            $query->where('sala_esperas.identidad', 'like', '%' . $request->identidad . '%');
        }

        if ($request->filled('nombre')) {
            $query->where('sala_esperas.nombre_completo', 'like', '%' . $request->nombre . '%');
        }

        $pacientes = $query->orderBy('sala_esperas.fecha_llegada', 'desc') // ordena los más recientes primero
        ->paginate(10);

        return view('pacientes.sala_de_espera', compact('pacientes'));
    }




    // formulario para ingresar status o en sala de espera paciente
    public function formulario_historial_guardar(Request $request)
    {
        // Validación de entrada
        $request->validate([
            'identidad' => 'required|string|max:20',
            'id_paciente' => 'integer',
            'temperatura' => 'nullable|numeric|min:0',
            'unidad_temperatura' => 'nullable|in:Celsius,Farenheit,Kelvin',
            'presion' => 'nullable|string',
            'frecuencia_cardiaca' => 'nullable|string',
            'peso' => 'nullable|numeric',
            'unidad_peso' => 'nullable|in:kilogramos',
            'saturacion_oxigeno'=>'numeric|nullable',
            'unidad_saturacion_oxigeno'=>'nullable|in:%',
            'glucometria'=>'numeric|nullable',
            'unidad_glucometria'=>'nullable|in:mg/dl',
            'indice_masa_corporal'=>'numeric|nullable',
            'unidad_indice_masa_corporal'=>'nullable|in:kg/m2',
            'altura'=>'numeric|nullable',
            'unidad_altura'=>'nullable|in:Metros',
            'plan_medico'=>'nullable|in:si,no'
        ]);

        // Buscar paciente por identidad
        $paciente = Paciente::where('identidad', $request->identidad)->first();

        if (!$paciente) {
            return back()->withErrors(['identidad' => 'Paciente no encontrado.']);
        }
        $usuarios = User::where('id', $request->usuario_id)->first();

        if (!$usuarios) {
            return back()->withErrors(['id' => 'Doctor no encontrado.']);
        }

        // Guardar signos vitales
        SignosVitales::create([
            'identidad' => $request->identidad,
            'id_paciente' => $paciente->id_paciente,
            'temperatura' => $request->temperatura,
            'unidad_temperatura' => $request->unidad_temperatura,
            'presion' => $request->presion,
            'frecuencia_cardiaca' => $request->frecuencia_cardiaca,
            'peso' => $request->peso,
            'unidad_peso' => $request->unidad_peso,
            'saturacion_oxigeno'=>$request->saturacion_oxigeno,
            'unidad_saturacion_oxigeno'=>$request->unidad_saturacion_oxigeno,
            'glucometria'=>$request->glucometria,
            'unidad_glucometria'=>$request->unidad_glucometria,
            'indice_masa_corporal'=>$request->indice_masa_corporal,
            'unidad_indice_masa_corporal'=>$request->unidad_indice_masa_corporal,
            'altura' => $request->altura,
            'unidad_altura' => $request->unidad_altura,
            'plan_medico'=>$request->plan_medico
        ]);

        // Verificar si ya está en sala de espera
        $existe = SalaEspera::where('identidad', $request->identidad)->first();

        if (!$existe) {
            SalaEspera::create([
                'identidad' => $paciente->identidad,
                'id_paciente' => $paciente->id_paciente,
                'id_user' => $usuarios->id,
                'nombre_completo' => $paciente->nombre_completo,
                'estado' => 'Pendiente',
                'plan_medico'=>$request->plan_medico,
                'id_enfermera' => Auth::id()
            ]);
        }

        // Confirmación final
        return back()->with('success', 'Paciente y signos vitales registrados correctamente.');
    }
    public function formulario_guardar(Request $request){

        $request->validate([
            'identidad' => 'required|string|max:20|unique:pacientes,identidad',
            'nombre_completo' => 'required|string|max:100',
            'dia' => 'int',
            'mes' => 'int',
            'anio' => 'int',
            'direccion' => 'string|max:200',
            'telefono' => 'string|max:20',
            'edad_valor' => 'nullable|numeric|min:0',
            'edad_unidad' => 'nullable|in:años,meses,días',
            'sexo' => 'in:1,2',
            'temperatura'=> 'nullable|numeric|min:0',
            'unidad_temperatura'=>'nullable|in:Celsius,Farenheit,Kelvin',
            'presion'=>'string|nullable',
            'frecuencia_cardiaca'=>'string|nullable',
            'peso'=>'numeric|nullable',
            'unidad_peso'=>'in:kilogramos',
            'saturacion_oxigeno'=>'numeric|nullable',
            'unidad_saturacion_oxigeno'=>'nullable|in:%',
            'glucometria'=>'numeric|nullable',
            'unidad_glucometria'=>'nullable|in:mg/dl',
            'indice_masa_corporal'=>'numeric|nullable',
            'unidad_indice_masa_corporal'=>'nullable|in:kg/m2',
            'altura'=>'numeric|nullable',
            'unidad_altura'=>'nullable|in:Metros',
            'plan_medico'=>'nullable|in:si,no'
        ]);
        $paciente = Paciente::create([
            'identidad' => $request->identidad,
            'nombre_completo' => $request->nombre_completo,
            'dia' => $request->dia,
            'mes' => $request->mes,
            'anio' => $request->anio,
            'direccion' => $request->direccion,
            'telefono' => $request->telefono,
            'edad_valor' => $request->edad_valor,
            'edad_unidad' => $request->edad_unidad,
            'sexo' => $request->sexo
        ]);
        SignosVitales::create([

            'identidad'=>$paciente->identidad,
            'id_paciente'=>$paciente->id_paciente,
            'temperatura'=>$request->temperatura,
            'unidad_temperatura'=>$request->unidad_temperatura,
            'presion'=>$request->presion,
            'frecuencia_cardiaca'=>$request->frecuencia_cardiaca,
            'peso'=>$request->peso,
            'unidad_peso'=>$request->unidad_peso,
            'saturacion_oxigeno'=>$request->saturacion_oxigeno,
            'unidad_saturacion_oxigeno'=>$request->unidad_saturacion_oxigeno,
            'glucometria'=>$request->glucometria,
            'unidad_glucometria'=>$request->unidad_glucometria,
            'indice_masa_corporal'=>$request->indice_masa_corporal,
            'unidad_indice_masa_corporal'=>$request->unidad_indice_masa_corporal,
            'altura'=>$request->altura,
            'unidad_altura'=>$request->unidad_altura,
            'plan_medico'=>$request->plan_medico
        ]);
        $existe = SalaEspera::where('identidad', $paciente->identidad)->first();
        $usuarios = User::where('id', $request->usuario_id)->first();

        if (!$usuarios) {
            return back()->withErrors(['id' => 'Doctor no encontrado.']);
        }
        if (!$existe) {
            SalaEspera::create([
                'identidad' => $paciente->identidad,
                'id_user'=>$usuarios->id,
                'id_paciente' => $paciente->id_paciente,
                'nombre_completo' => $paciente->nombre_completo,
                'estado' => 'Pendiente',
                'plan_medico' => $request->plan_medico,
                'id_enfermera' => Auth::id()
            ]);
        }

        return redirect('/busqueda_paciente')-> with('success','Paciente y Signos Vitales registrados correctamente');
    }
    public function edit_historial_enfermera($id_signos_vitales)
    {
        $consulta = SignosVitales::findOrFail($id_signos_vitales);
        return view('consultas.edit_historial_enfermera', compact('consulta'));
    }
    public function update_historial_enfermera(Request $request, $identidad)
    {
        $consulta = SignosVitales::where('identidad', $identidad)->firstOrFail();
        $consulta->update($request->all());


        return redirect()->route('consultas.historial_enfermera', $consulta->identidad)->with('success', 'Consulta actualizada correctamente.');
    }

    public function editSala($id_sala_espera)
    {
        $sala = SalaEspera::findOrFail($id_sala_espera);
        $doctores = User::where('rol', 'admin')->get();

        return view('pacientes.actualizar_sala', compact('sala', 'doctores'));
    }

    public function updateSala(Request $request, $id_sala_espera)
    {
        $request->validate([
            'id_user' => 'required|exists:users,id',
        ]);

        $sala = SalaEspera::findOrFail($id_sala_espera);
        $sala->id_user = $request->id_user;
        $sala->save();

        return redirect()->route('busqueda_sala')->with('success', 'Doctor asignado correctamente.');
    }



    public function reporte($id_consulta)
    {
        //buscar la consulta especifica que se seleccionará
        $consulta = MotivoConsulta::with('paciente','signoVital')->findorFail($id_consulta);
        $paciente = $consulta->paciente;
        $signos   = $consulta->signoVital;

        $pdf = Pdf::loadView('reportes.reportes_pacientes', [
            'paciente' => $paciente,
            'signos'=>$signos,
            'consulta' => $consulta
        ]);
        return $pdf->stream('consulta_'.$consulta->id_consulta.'.pdf');
    }


}
