<x-busqueda_paciente-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xxl-center">
            SALA DE ESPERA
        </h2>
    </x-slot>

    <div class="d-flex justify-content-center pt-9 min-vh-100" style="background-color: #ffffff;">
        <div class="container md-8 mt-5" style="background-color: #ffffff;">

            {{-- Formulario de búsqueda --}}
            <form action="{{ route('busqueda_sala') }}" method="GET" class="row g-3 mt-0">
                <div class="col-md-4">
                    <input type="text" name="identidad" class="form-control" placeholder="Buscar por identidad" value="{{ request('identidad') }}">
                </div>
                <div class="col-md-4">
                    <input type="text" name="nombre" class="form-control" placeholder="Buscar por nombre" value="{{ request('nombre') }}">
                </div>
                <div class="col">
                    <button type="submit" class="btn btn-primary w-100">Buscar</button>
                </div>
            </form>

            {{-- Tabla de pacientes --}}
            <table class="table table-striped mt-4">
                <thead class="table-dark">
                <tr>
                    <th>DNI</th>
                    <th>Nombre</th>
                    <th>Plan Medico</th>
                    <th>Doctor Asignado</th>
                    <th>Hora y Fecha de llegada</th>
                    <th>Acción</th>
                </tr>
                </thead>
                <tbody>
                @forelse($pacientes as $paciente)
                    <tr>
                        @auth
                            @if(auth()->user()->rol === 'usuario' && $paciente->status === "Pendiente" || auth()->user()->id === $paciente->id_user && $paciente->status === "Pendiente")
                                <td>{{ $paciente->identidad }}</td>
                                <td>{{ $paciente->nombre_completo }}</td>
                                <td>{{ $paciente->plan_medico }}</td>
                                <td>{{ $paciente->nombre_usuario }}</td>
                                <td>{{ $paciente->fecha_llegada }}</td>
                                <td>
                                    @if(auth()->user()->rol === "admin")
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('pacientes.historial', $paciente->id_paciente) }}" class="btn btn-success py-2 w-100">Atender</a>
                                            <form action="{{ route('pacientes.destroy_espera', $paciente->id_paciente) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este paciente?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-warning py-2 w-100">Despachar</button>
                                            </form>
                                        </div>
                                    @else
                                        <a href="{{ route('sala_espera.edit', $paciente->id_sala_espera) }}" class="btn btn-warning w-100">Corregir</a>
                                    @endif
                                </td>
                            @elseif(auth()->user()->rol === "usuario" && $paciente->status === "Receta")
                                <td>{{ $paciente->identidad }}</td>
                                <td>{{ $paciente->nombre_completo }}</td>
                                <td>{{ $paciente->plan_medico }}</td>
                                <td>{{ $paciente->nombre_usuario }}</td>
                                <td>{{ $paciente->fecha_llegada }}</td>
                                <td>
                                        <div class="d-flex gap-2">
                                            <button type="button" class="btn btn-success py-2 w-100" data-bs-toggle="modal" data-bs-target="#modalConsulta{{ $paciente->id_paciente }}">
                                                Ver Receta </button>
                                            <div class="modal fade" id="modalConsulta{{ $paciente->id_paciente }}" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Paciente:  {{ $paciente->nombre_completo }}</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            @php
                                                                $consulta = $paciente->paciente->consultas()->latest('created_at')->first();
                                                            @endphp

                                                            @if($consulta)
                                                                <h5><strong>Doctor:</strong> {{ $consulta->nombre_medico }}</h5>
                                                                <hr>
                                                                <h4><strong>Tratamiento:</strong> </h4>
                                                                <h5>{{ $consulta->tratamiento }}</h5>
                                                               <hr>
                                                                <h4><strong>Exámenes:</strong></h4>
                                                                <h5>{{ $consulta->examenes }}</h5>
                                                            @else
                                                                <p>No subio expedientes- consulte a medico.</p>
                                                            @endif
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar Ventana</button>
                                                            <form action="{{ route('pacientes.destroy_espera', $paciente->id_paciente) }}" method="POST" onsubmit="return confirm('¿Seguro de despacharlo?')">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger py-2 w-100">Despachar</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </td>
                            @endif
                        @endauth
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="text-center">No se encontraron pacientes.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>

            {{-- Paginación --}}
            <div class="d-flex justify-content-center">
                {{ $pacientes->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>


</x-busqueda_paciente-layout>

{{-- Alerta de éxito --}}
@if(session('success'))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        Swal.fire({
            title: '¡En Buenahora!',
            text: '{{ session('success') }}',
            icon: 'success',
            confirmButtonText: 'Aceptar',
            confirmButtonColor: '#3085d6'
        });
    </script>
@endif