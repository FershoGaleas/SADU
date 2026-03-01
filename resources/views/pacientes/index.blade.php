 <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xxl-center">
                LISTADO CONSULTAS
            </h2>
        </x-slot>
     <div class="d-flex justify-content-center pt-9 min-vh-100" style="background-color: #ffffff;">
        <div class="container md-8 mt-5" style="background-color: #ffffff;">

            <form action="{{ route('pacientes.buscar') }}" method="GET" class="row g-3 mt-0">
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

            <table class="table table-striped mt-4">
                <thead class="table-dark">
                <tr>
                    <th>DNI</th>
                    <th>Nombre</th>
                    <th>Sexo</th>
                    <th>Fecha Registro</th>
                    <th>Historial</th>
                </tr>
                </thead>
                <tbody>
                @forelse($pacientes as $paciente)
                    <tr>
                        <td>{{$paciente->identidad}}</td>
                        <td>{{ $paciente->nombre_completo }}</td>
                        <td>{{ $paciente->sexo == 1 ? 'Masculino' : 'Femenino' }}</td>
                        <td>{{ $paciente->created_at->format('d/m/Y H:i') }}</td>
                        
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('pacientes.historial', $paciente->id_paciente) }}" class="btn btn-secondary py-2 w-100">VER</a>
                        
                                <form action="{{ route('pacientes.destroy', $paciente->id_paciente) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este paciente?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger py-2 w-100">Eliminar</button>
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
    </x-app-layout>




