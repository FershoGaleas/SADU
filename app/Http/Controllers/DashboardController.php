<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;
use App\Models\MotivoConsulta;

class DashboardController extends Controller
{
public function index()
{
$totalPacientes = Paciente::count();
$totalConsultas = MotivoConsulta::count();
$consultasRecientes = MotivoConsulta::latest()->take(5)->get();

return view('dashboard', compact('totalPacientes', 'totalConsultas', 'consultasRecientes'));
}
}
