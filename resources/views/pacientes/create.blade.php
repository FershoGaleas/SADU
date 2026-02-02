<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xxl-center text-gray-800 dark:text-neutral-950 leading-tight">
            Registrar nuevo paciente
        </h2>
    </x-slot>

    <div class="container py-4" style="max-width: 100%">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-8">
                <div class="card shadow-lg w-100">
                    <div class="card-header bg-primary text-white text-center">
                        <h4 class="mb-0">Datos del paciente</h4>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <form action="{{ route('pacientes.store') }}" method="POST">
                            @csrf

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="identidad" class="form-label">Número de Identidad</label>
                                    <input type="text" name="identidad" class="form-control" value="{{ old('identidad') }}">
                                    @error('identidad') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="nombre_completo" class="form-label">Nombre completo</label>
                                    <input type="text" name="nombre_completo" class="form-control" value="{{ old('nombre_completo') }}">
                                    @error('nombre_completo') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="fecha_nacimiento" class="form-label">Fecha de nacimiento</label>
                                    <input type="date" name="fecha_nacimiento" class="form-control" value="{{ old('fecha_nacimiento') }}">
                                    @error('fecha_nacimiento') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="direccion" class="form-label">Dirección</label>
                                    <textarea name="direccion" class="form-control" placeholder="Dirección...">{{ old('direccion') }}</textarea>
                                    @error('direccion') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="edad_valor" class="form-label">Edad</label>
                                    <div class="input-group">
                                        <input type="number" name="edad_valor" class="form-control" min="0" value="{{ old('edad_valor') }}" placeholder="">
                                        <select name="edad_unidad" class="form-select">
                                            <option value="">Unidad</option>
                                            <option value="años" {{ old('edad_unidad') == 'años' ? 'selected' : '' }}>Años</option>
                                            <option value="meses" {{ old('edad_unidad') == 'meses' ? 'selected' : '' }}>Meses</option>
                                            <option value="días" {{ old('edad_unidad') == 'días' ? 'selected' : '' }}>Días</option>
                                        </select>
                                    </div>
                                    @error('edad_valor') <small class="text-danger">{{ $message }}</small> @enderror
                                    @error('edad_unidad') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="sexo" class="form-label">Sexo</label>
                                    <select name="sexo" class="form-select">
                                        <option value="">Seleccione</option>
                                        <option value="1">Masculino</option>
                                        <option value="2">Femenino</option>
                                    </select>
                                    @error('sexo') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="telefono" class="form-label">Teléfono</label>
                                    <input type="text" name="telefono" class="form-control" value="{{ old('telefono') }}">
                                    @error('telefono') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="religion" class="form-label">Religión</label>
                                    <input type="text" name="religion" class="form-control" value="{{ old('religion') }}">
                                </div>
                            </div>

                            <hr class="my-4">

                            <h5 class="mb-3">Motivo de Consulta</h5>
                            <div class="mb-3">
                                <textarea name="antecedentes" class="form-control" rows="2" placeholder="A.P.P....">{{ old('antecedentes') }}</textarea>
                            </div>
                            <div class="mb-3">
                                <textarea name="descripcion_motivo" class="form-control" rows="2" placeholder="Describa el motivo de consulta...">{{ old('descripcion_motivo') }}</textarea>
                            </div>

                            <div class="mb-3">
                                <textarea name="historia_enfermedad_Actual" class="form-control" rows="2" placeholder="Historia de enfermedad actual (HEA)...">{{ old('historia_enfermedad_Actual') }}</textarea>
                            </div>

                            <div class="mb-3">
                                <textarea name="diagnostico" class="form-control" rows="2" placeholder="Diagnóstico...">{{ old('diagnostico') }}</textarea>
                            </div>

                            <div class="mb-3">
                                <textarea name="tratamiento" class="form-control" rows="2" placeholder="Tratamiento...">{{ old('tratamiento') }}</textarea>
                            </div>

                            <div class="mb-3">
                                <textarea name="examenes" class="form-control" rows="2" placeholder="Exámenes realizados...">{{ old('examenes') }}</textarea>
                            </div>



                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="fecha_siguiente_cita" class="form-label">Fecha de siguiente cita</label>
                                    <input type="date" name="fecha_siguiente_cita" class="form-control" value="{{ old('fecha_siguiente_cita') }}">
                                    @error('fecha_siguiente_cita') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="nombre_medico" class="form-label">Nombre del médico que realizó la consulta</label>
                                    <input type="text" name="nombre_medico" class="form-control" value="{{ old('nombre_medico') }}">
                                    @error('nombre_medico') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>

                            <button type="submit" class="btn btn-success btn-lg w-100 mt-3">
                                Guardar
                            </button>

                            @if($errors->any())
                                <div class="alert alert-danger mt-4">
                                    <ul class="mb-0">
                                        @foreach($errors->all() as $error)
                                            <li> {{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @if($errors->has('identidad'))
                                <!-- Modal Bootstrap -->
                                <div class="modal fade" id="identidadModal" tabindex="-1" aria-labelledby="identidadModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content border-danger">
                                            <div class="modal-header bg-danger text-white">
                                                <h5 class="modal-title" id="identidadModalLabel">Identidad duplicada</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                            </div>
                                            <div class="modal-body text-center">
                                                El número de identidad ya está registrado en el sistema.
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cerrar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Script para activar el modal -->
                                <script>
                                    document.addEventListener('DOMContentLoaded', function () {
                                        var modal = new bootstrap.Modal(document.getElementById('identidadModal'));
                                        modal.show();
                                    });
                                </script>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
