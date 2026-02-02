<x-busqueda_paciente-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xxl-center text-center w-100">
            HISTORIAL DE PACIENTE
        </h2>
    </x-slot>

    <div x-data="{ edit: false }" class="p-4 bg-white rounded shadow">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <hr>
            <button @click="edit = !edit" class="btn btn-primary py-3 w-100">
                <strong x-show="!edit">Editar</strong>
                <strong x-show="edit">Cancelar</strong>
            </button>
        </div>

        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12 col-md-10">
                    <form x-show="edit" action="{{ url('/pacientes/actualizarSoloPaciente/' . $paciente->id_paciente) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">Nombre completo</label>
                            <input type="text" name="nombre_completo" class="form-control" value="{{ $paciente->nombre_completo }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">DNI</label>
                            <input type="text" name="identidad" class="form-control" value="{{ $paciente->identidad }}">
                        </div>

                        <div class="row mb-3">
                            <label class="form-label">Fecha de nacimiento</label>

                            <div class="col-4">
                                <select name="dia" class="form-select">
                                    <option value="">Día</option>
                                    @for ($i = 1; $i <= 31; $i++)
                                        <option value="{{ $i }}" {{ $paciente->dia == $i ? 'selected' : '' }}>{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>

                            <div class="col-4">
                                <select name="mes" class="form-select">
                                    <option value="">Mes</option>
                                    <option value="1" {{ $paciente->mes == 1 ? 'selected' : '' }}>Enero</option>
                                    <option value="2" {{ $paciente->mes == 2 ? 'selected' : '' }}>Febrero</option>
                                    <option value="3" {{ $paciente->mes == 3 ? 'selected' : '' }}>Marzo</option>
                                    <option value="4" {{ $paciente->mes == 4 ? 'selected' : '' }}>Abril</option>
                                    <option value="5" {{ $paciente->mes == 5 ? 'selected' : '' }}>Mayo</option>
                                    <option value="6" {{ $paciente->mes == 6 ? 'selected' : '' }}>Junio</option>
                                    <option value="7" {{ $paciente->mes == 7 ? 'selected' : '' }}>Julio</option>
                                    <option value="8" {{ $paciente->mes == 8 ? 'selected' : '' }}>Agosto</option>
                                    <option value="9" {{ $paciente->mes == 9 ? 'selected' : '' }}>Septiembre</option>
                                    <option value="10" {{ $paciente->mes == 10 ? 'selected' : '' }}>Octubre</option>
                                    <option value="11" {{ $paciente->mes == 11 ? 'selected' : '' }}>Noviembre</option>
                                    <option value="12" {{ $paciente->mes == 12 ? 'selected' : '' }}>Diciembre</option>
                                </select>
                            </div>

                            <div class="col-4">
                                <select name="anio" class="form-select">
                                    <option value="">Año</option>
                                    @for ($i = now()->year; $i >= 1900; $i--)
                                        <option value="{{ $i }}" {{ $paciente->anio == $i ? 'selected' : '' }}>{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>



                        <div class="mb-3">
                            <label class="form-label">Dirección</label>
                            <textarea name="direccion" class="form-control">{{ $paciente->direccion }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Teléfono</label>
                            <input type="text" name="telefono" class="form-control" value="{{ $paciente->telefono }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Edad</label>
                            <div class="input-group">
                                <input type="number" name="edad_valor" id="edad_valor" class="form-control" min="0" value="{{ $paciente->edad_valor }}" placeholder="Ej: 3">
                                <select name="edad_unidad" id="edad_unidad" class="form-select">
                                    <option value="">Unidad</option>
                                    <option value="años" {{ $paciente->edad_unidad == 'años' ? 'selected' : '' }}>Años</option>
                                    <option value="meses" {{ $paciente->edad_unidad == 'meses' ? 'selected' : '' }}>Meses</option>
                                    <option value="días" {{ $paciente->edad_unidad == 'días' ? 'selected' : '' }}>Días</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Sexo</label>
                            <select name="sexo" class="form-control">
                                <option value="1" {{ $paciente->sexo == 1 ? 'selected' : '' }}>Masculino</option>
                                <option value="2" {{ $paciente->sexo == 2 ? 'selected' : '' }}>Femenino</option>
                                <option value="0" {{ $paciente->sexo == 0 ? 'selected' : '' }}>No definido</option>
                            </select>
                        </div>

                        <br>
                        <button type="submit" class="btn btn-success py-3 w-100 w-md-auto">Guardar cambios</button>
                    </form>

                    <div x-show="!edit">
                        <p class="fs-5"><strong>Nombre:</strong> {{ $paciente->nombre_completo }}</p>
                        <p class="fs-5"><strong>DNI:</strong> {{ $paciente->identidad }}</p>
                        <p class="fs-5">
                            <strong>Fecha Nacimiento:</strong>
                            {{ $paciente->dia }} de
                            {{ \Carbon\Carbon::create()->month($paciente->mes)->locale('es')->monthName }} de
                            {{ $paciente->anio }}
                        </p>
                        <p class="fs-5"><strong>Dirección:</strong> {{ $paciente->direccion }}</p>
                        <p class="fs-5"><strong>Teléfono:</strong> {{ $paciente->telefono }}</p>
                        <p class="fs-5"><strong>Edad:</strong> {{ $paciente->edad_valor }} {{ $paciente->edad_unidad }}</p>
                        <p class="fs-5"><strong>Sexo:</strong>
                            @if($paciente->sexo == 1)
                                Masculino
                            @elseif($paciente->sexo == 2)
                                Femenino
                            @else
                                No definido
                            @endif
                        </p>


                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-hover mt-4">
                        <thead class="table-dark">
                        <tr>
                            <th>Fecha</th>
                            <th>Temperatura</th>
                            <th>Presión</th>
                            <th>Frecuencia Cadiaca</th>
                            <th>Peso</th>
                            <th>Altura</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse(optional($signos)->signos ?? [] as $signo)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($signo->fecha_ingreso)->format('d/m/Y H:i') }}</td>
                                <td>{{ $signo->temperatura }} {{ $signo->unidad_temperatura }}</td>
                                <td>{{ $signo->presion }}</td>
                                <td>{{ $signo->frecuencia_cardiaca }}</td>
                                <td>{{ $signo->peso }} {{ $signo->unidad_peso }}</td>
                                <td>{{ $signo->altura }} {{ $signo->unidad_altura }}</td>
                                <td class="text-center">
                                    <div class="d-flex flex-column flex-md-row justify-content-center gap-2">
                                        <a href="{{ url('consultas/' . $signo->id_signos_vitales . '/edit_historial_enfermera') }}"
                                           class="btn btn-sm btn-warning w-100 w-md-auto">
                                            <i class="bi bi-pencil-square"></i> Ver
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">No hay consultas registradas.</td>
                            </tr>
                        @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid mt-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10">
                <hr class="my-4">
                <h5 class="mb-3">INFORMACIÓN DE SIGNOS VITALES</h5>
                <form action="{{ route('pacientes.formulario_historial_guardar') }}" method="POST">
                    @csrf
                    <input type="hidden" name="identidad" value="{{ $paciente->identidad }}">
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
                    <button type="submit" class="btn btn-success w-100 w-md-auto">Guardar Consulta</button>

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

@if(session('success'))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        Swal.fire({
            title: '¡Actualización exitosa!',
            text: '{{ session('success') }}',
            icon: 'success',
            confirmButtonText: 'Aceptar',
            confirmButtonColor: '#3085d6'
        });
    </script>
@endif