<x-busqueda_paciente-layout>
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

                        <form action="{{ url('/pacientes/actualizarHistorialSignos', $consulta->id_signos_vitales . '/' . $consulta->id_paciente) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <label for="temperatura_valor" class="form-label">Temperatura:</label>
                            <div class="input-group">
                                <input type="number" id="temperatura" name="temperatura" class="form-control" step="any" value="{{$consulta->temperatura}}" placeholder="">
                                <select id="unidad_temperatura" name="unidad_temperatura" class="form-select">

                                    <option value="Celsius" {{ $consulta->unidad_temperatura == 'Celsius' ? 'selected' : '' }}>Celsius</option>
                                </select>
                            </div>
                            @error('temperatura') <small class="text-danger">{{ $message }}</small> @enderror
                            @error('unidad_temperatura') <small class="text-danger">{{ $message }}</small> @enderror
                            <br>
                            <div class="mb-3">
                                <label for="presion" class="form-label">Presión: </label>
                                <input type="text" id="presion" name="presion" class="form-control" rows="2" placeholder="150/170" value="{{ $consulta->presion }}"></input>
                            </div>
                            <div class="mb-3">
                                <label for="frecuencia_cardiaca" class="form-label">Frecuencia Cardiaca: </label>
                                <input type="text" id="frecuencia_cardiaca" name="frecuencia_cardiaca" class="form-control" value="{{ $consulta->frecuencia_cardiaca }}"></input>
                            </div>

                            <label for="peso" class="form-label">Peso</label>
                            <div class="input-group">
                                <input type="number" id="peso" name="peso" class="form-control" min="0" value="{{ $consulta->peso }}" placeholder="">
                                <select id="unidad_peso" name="unidad_peso" class="form-select">


                                    <option value="kilogramos" {{ $consulta->unidad_peso == 'kilogramos' ? 'selected' : '' }}>Kilogramos</option>
                                </select>
                            </div>
                            @error('presion') <small class="text-danger">{{ $message }}</small> @enderror
                            @error('unidad_presion') <small class="text-danger">{{ $message }}</small> @enderror
                            <br>
                            <label for="altura" class="form-label">Altura</label>
                            <div class="input-group">
                                <input type="number" step="0.01" id="altura" name="altura" class="form-control" min="0" value="{{ $consulta->altura }}" placeholder="">
                                    <select id="unidad_altura" name="unidad_altura" class="form-select">
                                        <option value="Metros" {{ $consulta->unidad_altura == 'Metros' ? 'selected' : '' }}>Metros</option>
                                    </select>
                            </div>
                            @error('altura') <small class="text-danger">{{ $message }}</small> @enderror
                            @error('unidad_altura') <small class="text-danger">{{ $message }}</small> @enderror



                            <label for="saturacion_oxigeno" class="form-label">Saturación Oxigeno: </label>

                            <div class="input-group">
                                <input type="number" step="0.01" id="saturacion_oxigeno" name="saturacion_oxigeno" class="form-control" value="{{ $consulta->saturacion_oxigeno }}" placeholder="">
                                <select id="unidad_saturacion_oxigeno" name="unidad_saturacion_oxigeno" class="form-select">
                                    <option value="%" {{ $consulta->unidad_saturacion_oxigeno == '%' ? 'selected' : '' }}>%</option>
                                </select>
                            </div>
                            @error('saturacion_oxigeno') <small class="text-danger">{{ $message }}</small> @enderror
                            @error('unidad_saturacion_oxigeno') <small class="text-danger">{{ $message }}</small> @enderror

                            <label for="glucometria" class="form-label">Glucometria: </label>

                            <div class="input-group">
                                <input type="number" step="0.01" id="glucometria" name="glucometria" class="form-control" value="{{ $consulta->glucometria }}" placeholder="">
                                <select id="unidad_glucometria" name="unidad_glucometria" class="form-select">
                                    <option value="mg/dl" {{ $consulta->unidad_glucometria == 'mg/dl' ? 'selected' : '' }}>mg/dl</option>
                                </select>
                            </div>
                            @error('glucometria') <small class="text-danger">{{ $message }}</small> @enderror
                            @error('unidad_glucometria') <small class="text-danger">{{ $message }}</small> @enderror

                            <label for="indice_masa_corporal" class="form-label">Indice Masa Corporal: </label>

                            <div class="input-group">
                                <input type="number" id="indice_masa_corporal" step="0.01" name="indice_masa_corporal" class="form-control" value="{{ $consulta->indice_masa_corporal }}" readonly>
                                <select id="unidad_indice_masa_corporal" name="unidad_indice_masa_corporal" class="form-select">
                                    <option value="kg/m2" {{ $consulta->unidad_indice_masa_corporal == 'kg/m2' ? 'selected' : '' }}>kg/m2</option>
                                </select>
                            </div>
                            @error('indice_masa_corporal') <small class="text-danger">{{ $message }}</small> @enderror
                            @error('unidad_indice_masa_corporal') <small class="text-danger">{{ $message }}</small> @enderror



                            <label for="plan_medico" class="form-label">Plan Medico:</label>
                            <div class="input-group">
                                <select id="plan_medico" name="plan_medico" class="form-select">
                                    <option value="si" {{ old('plan_medico') == 'si' ? 'selected' : '' }}>si</option>
                                    <option value="no" {{ old('plan_medico') == 'no' ? 'selected' : '' }}>no</option>
                                </select>
                            </div>
                            <br>
                            <br>

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
</x-busqueda_paciente-layout>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const pesoInput = document.getElementById('peso');
        const alturaInput = document.getElementById('altura');
        const imcInput = document.getElementById('indice_masa_corporal');

        function calcularIMC() {
            const peso = parseFloat(pesoInput.value) || 0;
            const altura = parseFloat(alturaInput.value) || 0;

            if (peso > 0 && altura > 0) {
                imcInput.value = (peso / (altura * altura)).toFixed(2);
            } else {
                imcInput.value = '';
            }
        }

        pesoInput.addEventListener('input', calcularIMC);
        alturaInput.addEventListener('input', calcularIMC);
    });
</script>
