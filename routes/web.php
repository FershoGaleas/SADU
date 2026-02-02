<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

// Controladores
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\MotivoConsultaController;
use App\Http\Controllers\SignoVitalController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminUserController;

// Modelos
use App\Models\Paciente;

/*
|--------------------------------------------------------------------------
| Rutas públicas (sin login)
|--------------------------------------------------------------------------
*/

// Página principal
Route::get('/', function () {
    if (!auth()->check()) {
        return view('auth.login');
    }

    return auth()->user()->rol === 'admin'
        ? redirect()->route('admin.usuarios')
        : redirect()->route('dashboard');
});


Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/');
})->name('logout');
// Verificación AJAX
Route::get('/verificar-identidad', function (Request $request) {
    $identidad = $request->query('identidad');
    $existe = Paciente::where('identidad', $identidad)->exists();
    return response()->json(['existe' => $existe]);
});


// Login manual
Route::post('/login', function (Request $request) {
    $credentials = $request->only('identidad', 'password');

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        return redirect()->intended(
            auth()->user()->rol === 'admin'
                ? route('admin.usuarios')
                : route('dashboard')
        );
    }

    return back()->withErrors([
        'identidad' => 'Credenciales incorrectas',
    ]);
})->name('login');

//si escoge cualquier ruta y no esta autenticado lo enviara a esta vista de login
Route::get('/login', function () {
    return view('auth.login'); // o la vista que uses
})->name('login.form');

/*
|--------------------------------------------------------------------------
| Rutas para usuarios autenticados (rol ≠ admin)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Perfil
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Pacientes
    Route::get('/formulario_clinica/create', [PacienteController::class, 'create_formulario'])->name('create_formulario');
    Route::post('/formulario_clinica', [PacienteController::class, 'formulario_guardar'])->name('pacientes.formulario_guardar');
    Route::post('/formulario_clinica/historial_enfermera', [PacienteController::class, 'formulario_historial_guardar'])->name('pacientes.formulario_historial_guardar');

    Route::get('/pacientes', [PacienteController::class, 'index'])->name('pacientes.index');
    Route::get('/pacientes/create', [PacienteController::class, 'create'])->name('pacientes.create');
    Route::post('/pacientes', [PacienteController::class, 'store'])->name('pacientes.store');
    Route::get('/pacientes/{id_paciente}/historial', [PacienteController::class, 'historial'])->name('pacientes.historial');
    Route::get('/pacientes/buscar', [PacienteController::class, 'buscar'])->name('pacientes.buscar');

    // Busquedas
    Route::get('/busqueda_paciente', [PacienteController::class, 'busqueda_paciente'])->name('busqueda_paciente');
    Route::get('/pacientes/busqueda', [PacienteController::class, 'busqueda_pacientes'])->name('pacientes.busqueda_paciente');

    // Sala de espera
    Route::get('/sala-espera/agregar/{id_paciente}/{nombre_completo}', [PacienteController::class, 'sala_espera'])->name('pacientes.sala_espera');
    Route::get('/sala_de_espera', [PacienteController::class, 'busqueda_sala'])->name('busqueda_sala');
    Route::get('/formulario_sala_espera', [PacienteController::class, 'sala_espera_busqueda'])->name('sala_espera_busqueda');
    Route::get('/sala_de_espera_usuario', [PacienteController::class, 'busqueda_sala'])->name('busqueda_sala_usuario');

    // Historial y consultas
    Route::get('/pacientes/{id_signos_vitales}/historial_enfermera', [PacienteController::class, 'historial_enfermera'])->name('pacientes.historial_enfermera');
    Route::put('/pacientes/actualizarHistorial/{id_paciente}', [PacienteController::class, 'updatePorPaciente'])->name('pacientes.update');
    Route::put('/pacientes/actualizarSoloPaciente/{id_paciente}', [PacienteController::class, 'UpdateSoloPaciente'])->name('pacientes.UpdateSoloPaciente');
    Route::put('/pacientes/actualizarHistorialSignos/{identidad}/{id_paciente}', [PacienteController::class, 'updatePorSignos'])->name('pacientes.updateSignos');
    Route::get('consultas/{id_consulta}/edit_historial_enfermera', [PacienteController::class, 'edit_historial_enfermera'])->name('consultas.edit_historial_enfermera');
    Route::put('consultas/{id_consulta}/edit_historial_enfermera', [PacienteController::class, 'update_historial_enfermera'])->name('consultas.update_historial_enfermera');
    // Editar sala de espera (formulario)
    Route::get('/sala-espera/{id_sala_espera}/edit', [PacienteController::class, 'editSala'])
        ->name('sala_espera.edit');

// Actualizar sala de espera (guardar cambios)
    Route::put('/sala-espera/{id_sala_espera}', [PacienteController::class, 'updateSala'])
        ->name('sala_espera.update');


    // Consultas
    Route::post('/consultas', [MotivoConsultaController::class, 'store'])->name('consultas.store');
    Route::get('consultas/{id_consulta}/edit', [MotivoConsultaController::class, 'edit'])->name('consultas.edit');
    Route::put('consultas/{id_consulta}', [MotivoConsultaController::class, 'update'])
        ->where('id_consulta', '[0-9]+')
        ->name('consultas.update');

    Route::delete('consultas/{id_consulta}', [MotivoConsultaController::class, 'destroy'])->name('consultas.destroy');
   //valdiacion si existe o no la identidad
    Route::get('/validar-identidad', function (Illuminate\Http\Request $request) {
        $exists = \App\Models\Paciente::where('identidad', $request->identidad)->exists();
        return response()->json(['exists' => $exists]);
    });

    //reportes descargar
    Route::get('/reporte-paciente/{id}', [PacienteController::class, 'reporte'])
        ->name('pacientes.reporte');



    // Eliminación
    Route::delete('eliminar/{identidad}', [PacienteController::class, 'destroy_historial_enfermera'])->name('pacientes.destroy_historial_enfermera');
    Route::delete('eliminar/signos/{identidad}', [PacienteController::class, 'destroy_signos'])->name('pacientes.destroy_signos');
    Route::delete('/pacientes/{identidad}', [PacienteController::class, 'destroy'])->name('pacientes.destroy');
    Route::delete('/destruir_espera/{id_sala_espera}', [PacienteController::class, 'destroy_espera'])->name('pacientes.destroy_espera');
});

/*
|--------------------------------------------------------------------------
| Rutas exclusivas para administradores
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'is_admin'])->prefix('admin')->group(function () {
    Route::get('/usuarios/index', [AdminUserController::class, 'index'])->name('admin.usuarios');
    Route::get('/usuarios/create', [AdminUserController::class, 'create'])->name('admin.usuarios.create');
    Route::post('/usuarios', [AdminUserController::class, 'store'])->name('admin.usuarios.store');
    Route::get('/usuarios/{id}/edit', [AdminUserController::class, 'edit'])->name('admin.usuarios.edit');
    Route::put('/usuarios/{id}', [AdminUserController::class, 'update'])->name('admin.usuarios.update');
    Route::delete('/usuarios/{id}', [AdminUserController::class, 'destroy'])->name('admin.usuarios.destroy');
});

/*s
|--------------------------------------------------------------------------
| Página alternativa
|--------------------------------------------------------------------------
*/

Route::get('/inicio_formulario', function () {
    return view('pacientes.inicio_formulario');
});