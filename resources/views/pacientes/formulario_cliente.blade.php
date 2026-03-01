<x-busqueda_paciente-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xxl-center text-gray-800 dark:text-neutral-950 leading-tight">
            INGRESEN SUS DATOS GENERALES PORFAVOR
        </h2>
    </x-slot>

    <div class="container py-4" style="max-width: 100%">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-8">
                <div class="card shadow-lg w-100">
                    <div class="card-header bg-primary text-white text-center">
                        <h4 class="mb-0">INGRESE DATOS DE PACIENTE</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('pacientes.formulario_guardar') }}" method="POST">
                            @csrf

                            {{-- Campos del formulario --}}
                            <div class="row">
                                {{-- Identidad --}}
                                <div class="mb-3">
                                    <label for="identidad" class="form-label">Número de Identidad</label>
                                    <input type="text" id="identidad" name="identidad" class="form-control" value="{{ old('identidad') }}">
                                    @error('identidad') <small class="text-danger">{{ $message }}</small> @enderror
                                    <small id="identidad-error" class="text-danger"></small>
                                    <small id="identidad-correcto" style="color:green"></small>
                                </div>

                                {{-- Nombre completo --}}
                                <div class=" mb-3">
                                    <label for="nombre_completo" class="form-label">Nombre completo</label>
                                    <input type="text" name="nombre_completo" class="form-control" value="{{ old('nombre_completo') }}">
                                    @error('nombre_completo') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                                {{-- Fecha de nacimiento, dirección, edad --}}

                                <div class="row mb-3">
                                    <label class="form-label">Fecha de nacimiento</label>

                                    <div class="col-4">
                                        <select name="dia" class="form-select">
                                            @for ($i = 1; $i <= 31; $i++)
                                                <option value="{{ $i }}" {{ old('dia') == $i ? 'selected' : '' }}>
                                                    {{ $i }}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>

                                    <div class="col-4">
                                        <select name="mes" class="form-select">
                                            <option value="1" {{ old('mes') == 1 ? 'selected' : '' }}>Enero</option>
                                            <option value="2" {{ old('mes') == 2 ? 'selected' : '' }}>Febrero</option>
                                            <option value="3" {{ old('mes') == 3 ? 'selected' : '' }}>Marzo</option>
                                            <option value="4" {{ old('mes') == 4 ? 'selected' : '' }}>Abril</option>
                                            <option value="5" {{ old('mes') == 5 ? 'selected' : '' }}>Mayo</option>
                                            <option value="6" {{ old('mes') == 6 ? 'selected' : '' }}>Junio</option>
                                            <option value="7" {{ old('mes') == 7 ? 'selected' : '' }}>Julio</option>
                                            <option value="8" {{ old('mes') == 8 ? 'selected' : '' }}>Agosto</option>
                                            <option value="9" {{ old('mes') == 9 ? 'selected' : '' }}>Septiembre</option>
                                            <option value="10" {{ old('mes') == 10 ? 'selected' : '' }}>Octubre</option>
                                            <option value="11" {{ old('mes') == 11 ? 'selected' : '' }}>Noviembre</option>
                                            <option value="12" {{ old('mes') == 12 ? 'selected' : '' }}>Diciembre</option>
                                        </select>
                                    </div>

                                    <div class="col-4">
                                        <select name="anio" class="form-select">
                                            @for ($i = now()->year; $i >= 1900; $i--)
                                                <option value="{{ $i }}" {{ old('anio') == $i ? 'selected' : '' }}>
                                                    {{ $i }}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="direccion" class="form-label">Dirección</label>
                                    <textarea name="direccion" class="form-control" placeholder="Dirección...">{{ old('direccion') }}</textarea>
                                    @error('direccion') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                                <div class="col mb-3">
                                    <label for="edad_valor" class="form-label">Edad</label>
                                    <div class="input-group">
                                        <input type="number" id="edad_valor" name="edad_valor" class="form-control" min="0" value="{{ old('edad_valor') }}" placeholder="">
                                        <select id="edad_unidad" name="edad_unidad" class="form-select">
                                            <option value="años" {{ old('edad_unidad') == 'años' ? 'selected' : '' }}>Años</option>
                                            <option value="meses" {{ old('edad_unidad') == 'meses' ? 'selected' : '' }}>Meses</option>
                                            <option value="días" {{ old('edad_unidad') == 'días' ? 'selected' : '' }}>Días</option>
                                        </select>
                                    </div>
                                    @error('edad_valor') <small class="text-danger">{{ $message }}</small> @enderror
                                    @error('edad_unidad') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                                {{-- Sexo, teléfono, religión --}}
                                <div class="col mb-3">
                                    <label for="sexo" class="form-label">Sexo</label>
                                    <select name="sexo" class="form-select">
                                        <option value="">Seleccione</option>
                                        <option value="1">Masculino</option>
                                        <option value="2">Femenino</option>
                                    </select>
                                    @error('sexo') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="telefono" class="form-label">Teléfono</label>
                                    <input type="text" name="telefono" class="form-control" value="{{ old('telefono') }}">
                                    @error('telefono') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>

                            <hr class="my-4">
                            <h5 class="mb-3">INFORMACIÓN DE SIGNOS VITALES</h5>
                            <label for="temperatura_valor" class="form-label">Temperatura:</label>
                            <div class="input-group">
                                <input type="number" id="temperatura" name="temperatura" class="form-control" step="any" value="{{ old('temperatura') }}" placeholder="">
                                <select id="unidad_temperatura" name="unidad_temperatura" class="form-select">

                                    <option value="Celsius" {{ old('unidad_temperatura') == 'Celsius' ? 'selected' : '' }}>Celsius</option>
                                </select>
                            </div>
                            @error('temperatura') <small class="text-danger">{{ $message }}</small> @enderror
                            @error('unidad_temperatura') <small class="text-danger">{{ $message }}</small> @enderror
                            <br>
                            <div class="mb-3">
                                <label for="presion" class="form-label">Presión: </label>
                                <input type="text" id="presion" name="presion" class="form-control" rows="2">{{ old('presion') }}</input>
                            </div>
                            <div class="mb-3">
                                <label for="frecuencia_cardiaca" class="form-label">Frecuencia Cardiaca: </label>
                                <input type="text" id="frecuencia_cardiaca" name="frecuencia_cardiaca" class="form-control" rows="2">{{ old('frecuencia_cardiaca') }}</input>
                            </div>

                            <label for="peso" class="form-label">Peso</label>
                            <div class="input-group">
                                <input type="number" id="peso" name="peso" class="form-control" step="any" value="{{ old('peso') }}" placeholder="">
                                <select id="unidad_peso" name="unidad_peso" class="form-select">
                                    <option value="kilogramos" {{ old('unidad_peso') == 'kilogramos' ? 'selected' : '' }}>Kilogramos</option>
                                </select>
                            </div>
                            @error('presion') <small class="text-danger">{{ $message }}</small> @enderror
                            @error('unidad_presion') <small class="text-danger">{{ $message }}</small> @enderror
                            <label for="altura" class="form-label">Altura</label>
                            <div class="input-group">
                                <input type="number" step="0.01" id="altura" name="altura" class="form-control" value="{{ old('altura') }}" placeholder="">
                                <select id="unidad_altura" name="unidad_altura" class="form-select">
                                    <option value="Metros" {{ old('unidad_altura') == 'Metros' ? 'selected' : '' }}>Metros</option>
                                </select>
                            </div>



                            <label for="saturacion_oxigeno" class="form-label">Saturación Oxigeno: </label>

                            <div class="input-group">
                                <input type="number" step="0.01" id="saturacion_oxigeno" name="saturacion_oxigeno" class="form-control" value="{{ old('saturacion_oxigeno') }}" placeholder="">
                                <select id="unidad_saturacion_oxigeno" name="unidad_saturacion_oxigeno" class="form-select">
                                    <option value="%" {{ old('unidad_saturacion_oxigeno') == '%' ? 'selected' : '' }}>%</option>
                                </select>
                            </div>
                            @error('saturacion_oxigeno') <small class="text-danger">{{ $message }}</small> @enderror
                            @error('unidad_saturacion_oxigeno') <small class="text-danger">{{ $message }}</small> @enderror

                            <label for="glucometria" class="form-label">Glucometria: </label>

                            <div class="input-group">
                                <input type="number" step="0.01" id="glucometria" name="glucometria" class="form-control" value="{{ old('glucometria') }}" placeholder="">
                                <select id="unidad_glucometria" name="unidad_glucometria" class="form-select">
                                    <option value="mg/dl" {{ old('unidad_glucometria') == 'mg/dl' ? 'selected' : '' }}>mg/dl</option>
                                </select>
                            </div>
                            @error('glucometria') <small class="text-danger">{{ $message }}</small> @enderror
                            @error('unidad_glucometria') <small class="text-danger">{{ $message }}</small> @enderror

                            <label for="indice_masa_corporal" class="form-label">Indice Masa Corporal: </label>

                            <div class="input-group">
                                <input type="number" id="indice_masa_corporal" step="0.01" name="indice_masa_corporal" class="form-control" value="{{ old('indice_masa_corporal') }}" readonly>
                                <select id="unidad_indice_masa_corporal" name="unidad_indice_masa_corporal" class="form-select">
                                    <option value="kg/m2" {{ old('unidad_indice_masa_corporal') == 'kg/m2' ? 'selected' : '' }}>kg/m2</option>
                                </select>
                            </div>
                            @error('indice_masa_corporal') <small class="text-danger">{{ $message }}</small> @enderror
                            @error('unidad_indice_masa_corporal') <small class="text-danger">{{ $message }}</small> @enderror


                            <br>
                            @error('altura') <small class="text-danger">{{ $message }}</small> @enderror
                            @error('unidad_altura') <small class="text-danger">{{ $message }}</small> @enderror
                            
                            <label for="plan_medico" class="form-label">Plan Medico:</label>
                            <div class="input-group">
                                <select id="plan_medico" name="plan_medico" class="form-select">
                                    <option value="si" {{ old('plan_medico') == 'si' ? 'selected' : '' }}>si</option>
                                    <option value="no" {{ old('plan_medico') == 'no' ? 'selected' : '' }}>no</option>
                                </select>
                            </div>
                            <br>
                            <div class="mb-3">
                                <label for="usuario_id" class="form-label">Asignar a Doctor:</label>
                                <select name="usuario_id" id="usuario_id" class="form-select" required>
                                    @foreach ($usuarios->where('rol','admin') as $usuario)
                                        <option value="{{ $usuario->id }}">{{ $usuario->name }}</option>
                                    @endforeach
                                </select>
                                @error('usuario_id') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <button type="submit" class="btn btn-success btn-lg w-100 mt-3">
                                Guardar
                            </button>

                            {{-- Errores generales --}}
                            @if($errors->any())
                                <div class="alert alert-danger mt-4">
                                    <ul class="mb-0">
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
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
                            {{-- Modal si hay error de identidad --}}


                        </form>
                        <script>
                            document.getElementById('identidad').addEventListener('blur', function() {
                                let identidad = this.value;

                                if (identidad.length > 0) {
                                    fetch('/validar-identidad?identidad=' + identidad)
                                        .then(response => response.json())
                                        .then(data => {
                                            if (data.exists) {
                                                document.getElementById('identidad-error').textContent = 'El número de identidad ya está registrado';
                                            } else {
                                                document.getElementById('identidad-correcto').textContent = 'Esta identidad si la puedes colocar';
                                            }
                                        });
                                }
                            });
                        </script>

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
