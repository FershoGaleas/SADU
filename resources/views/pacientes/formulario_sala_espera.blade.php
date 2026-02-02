<x-busqueda_paciente-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xxl-center">
            AGREGAR A SALA DE ESPERA
        </h2>
    </x-slot>


    <div class="d-flex justify-content-center pt-9 min-vh-100" style="background-color: #ffffff;">
        <div class="container md-8 mt-5" style="background-color: #ffffff;">
            <form action="{{ route('busqueda_paciente') }}" method="GET" class="row g-3 mt-0">
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

            <table class="table table-hover mt-4">
                <thead class="table-dark">
                <tr>
                    <th>DNI</th>
                    <th>Nombre</th>
                    <th>Historial</th>
                </tr>
                </thead>
                <tbody>
                @forelse($pacientes as $paciente)
                    <tr>
                        <td>{{ $paciente->identidad}}</td>
                        <td>{{ $paciente->nombre_completo }}</td>
                        <td>
                            <div class="col">
                                <a href="{{ route('pacientes.sala_espera', ['id_paciente'=>$paciente->id_paciente,'nombre_completo'=>$paciente->nombre_completo]) }}" class="btn btn-success w-100">AGREGAR</a>
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
            title: '¡En Buenahora!',
            text: '{{ session('success') }}',
            icon: 'success',
            confirmButtonText: 'Aceptar',
            confirmButtonColor: '#3085d6'
        });
    </script>
@endif




