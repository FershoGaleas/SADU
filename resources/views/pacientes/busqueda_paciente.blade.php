<x-busqueda_paciente-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xxl-center">
            LISTADO DE PACIENTES
        </h2>
    </x-slot>

    <div class="justify-content-center align-items-center min-vh" style="background-color: #ffffff;">
            <div class="col p-3">
                <a href="{{ route('create_formulario') }}" class="btn btn-success py-4 text-white w-100">
                    ➕ REGISTRAR NUEVO PACIENTE
                </a>
            </div>
    </div>
    <div class="d-flex justify-content-center pt-9 min-vh-100" style="background-color: #ffffff;">
        <div class="container md-8 mt-5" style="background-color: #ffffff;">
            <form action="{{ route('busqueda_paciente') }}" method="GET" class="row g-3 mt-0">
                <div class="col-md-4">
                    <input type="text" name="identidad" class="form-control" placeholder="Buscar por identidad" value="{{ request('identidad') }}">
                </div>
                <div class="col-md-4">
                    <input type="text" name="nombre" class="form-control" placeholder="Buscar por nombre" value="{{ request('nombre') }}">
                </div>
                <div class="col-md-3">
                    <select name="sexo" class="form-select">
                        <option value="">Sexo</option>
                        <option value="1" {{ request('sexo') == '1' ? 'selected' : '' }}>Masculino</option>
                        <option value="2" {{ request('sexo') == '2' ? 'selected' : '' }}>Femenino</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <input type="date" name="fecha_registro" class="form-control" value="{{ request('fecha_registro') }}" placeholder="fecha_registro">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">Buscar</button>
                </div>

            </form>

            <table class="table table-hover mt-4">
                <thead class="table-dark">
                <tr>
                    <th>DNI</th>
                    <th>Nombre</th>
                    <th>Plan Medico</th>
                    <th>Historial</th>
                </tr>
                </thead>
                <tbody>
                @forelse($pacientes as $paciente)
                    <tr>
                        <td>{{ $paciente->identidad }}</td>
                        <td>{{ $paciente->nombre_completo }}</td>
                        <td>{{$paciente->created_at}}</td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('pacientes.historial_enfermera', $paciente->id_paciente) }}" class="btn btn-info w-100">VER</a>

                                <form action="{{ route('pacientes.destroy_historial_enfermera', $paciente->id_paciente) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este paciente?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="text-center">No se encontraron pacientes.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {{ $pacientes->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</x-busqueda_paciente-layout>
@if(session('success'))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        Swal.fire({
            title: '¡Registro exitoso!',
            text: '{{ session('success') }}',
            icon: 'success',
            confirmButtonText: 'Aceptar',
            confirmButtonColor: '#3085d6'
        });
    </script>
@endif




