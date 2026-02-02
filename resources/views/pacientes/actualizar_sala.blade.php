<x-busqueda_paciente-layout>
    <x-slot name="header">
        <h2 class="text-center fw-bold">ESCOGE OTRO DOCTOR</h2>
    </x-slot>

    <div class="container py-4">
        <div class="card shadow">
            <div class="card-body">
                <form action="{{ route('sala_espera.update', $sala->id_sala_espera) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="id_user" class="form-label">Doctor:</label>
                        <select name="id_user" id="id_user" class="form-select" required>
                            @foreach ($doctores as $doctor)
                                <option value="{{ $doctor->id }}" {{ $sala->id_user == $doctor->id ? 'selected' : '' }}>
                                    {{ $doctor->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_user') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-success btn-lg">
                            Guardar cambios
                        </button>
                    </div>
                </form>
            </div>

</x-busqueda_paciente-layout>