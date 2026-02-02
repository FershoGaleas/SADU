<x-app-layout>
    <x-slot name="header">
        <h2 class="text-center fw-bold">Editar Consulta Médica</h2>
    </x-slot>

    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-8">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white text-center">
                        <h5 class="mb-0">Actualizar datos de la consulta</h5>
                    </div>

                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <form action="{{ route('consultas.update', $consulta->id_consulta) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label class="form-label">Motivo de consulta</label>
                                <textarea name="descripcion_motivo" class="form-control" rows="2">{{ old('descripcion_motivo', $consulta->descripcion_motivo) }}</textarea>
                                @error('descripcion_motivo') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Historia de enfermedad actual (HEA)</label>
                                <textarea name="historia_enfermedad_Actual" class="form-control" rows="2">{{ old('historia_enfermedad_Actual', $consulta->historia_enfermedad_Actual) }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Diagnóstico</label>
                                <textarea name="diagnostico" class="form-control" rows="2">{{ old('diagnostico', $consulta->diagnostico) }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Tratamiento</label>
                                <textarea name="tratamiento" class="form-control" rows="2">{{ old('tratamiento', $consulta->tratamiento) }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Exámenes realizados</label>
                                <textarea name="examenes" class="form-control" rows="2">{{ old('examenes', $consulta->examenes) }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Antecedentes</label>
                                <textarea name="antecedentes" class="form-control" rows="2">{{ old('antecedentes', $consulta->antecedentes) }}</textarea>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Fecha próxima cita</label>
                                    <input type="date" name="fecha_siguiente_cita" class="form-control" value="{{ old('fecha_siguiente_cita', $consulta->fecha_siguiente_cita) }}">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nombre del médico</label>
                                    <input type="text" name="nombre_medico" class="form-control" value="{{ old('nombre_medico', $consulta->nombre_medico) }}">
                                </div>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-success btn-lg">
                                    <i class="bi bi-save me-2"></i> Guardar cambios
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>