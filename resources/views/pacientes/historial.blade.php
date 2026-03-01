<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xxl-center text-center w-100">
            HISTORIAL DE PACIENTE
        </h2>
    </x-slot>

    <div x-data="{ edit: false }" class="p-4 bg-white rounded shadow">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <hr>
            <button @click="edit = !edit" class="btn btn-primary py-3 w-100">
                <span x-show="!edit">Editar</span>
                <span x-show="edit">Cancelar</span>
            </button>
        </div>

        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12 col-md-10">
                    <form x-show="edit" action="{{ url('/pacientes/actualizarHistorial/' . $paciente->id_paciente) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">Nombre completo</label>
                            <input type="text" name="nombre_completo" class="form-control" value="{{ $paciente->nombre_completo }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">DNI</label>
                            <input type="text" name="identidad" class="form-control" value="{{$paciente->identidad}}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Fecha de nacimiento</label>
                            <div class="row">
                                <div class="col-4">
                                    <select name="dia" class="form-select">
                                        <option value="">Día</option>
                                        @for ($i = 1; $i <= 31; $i++)
                                            <option value="{{ $i }}" {{ $i == $paciente->dia ? 'selected' : '' }}>{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>

                                <div class="col-4">
                                    <select name="mes" class="form-select">
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
                                            <option value="{{ $i }}" {{ $i == $paciente->anio ? 'selected' : '' }}>{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
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
                        <label for="temperatura_valor" class="form-label">Temperatura:</label>
                        <div class="input-group">
                            <input type="number" id="temperatura" name="temperatura" class="form-control" step="any" value="{{$signos?->temperatura}}" placeholder="">
                            <select id="unidad_temperatura" name="unidad_temperatura" class="form-select">

                                <option value="Celsius" {{ $signos?->unidad_temperatura == 'Celsius' ? 'selected' : '' }}>Celsius</option>
                            </select>
                        </div>
                        @error('temperatura') <small class="text-danger">{{ $message }}</small> @enderror
                        @error('unidad_temperatura') <small class="text-danger">{{ $message }}</small> @enderror
                        <br>
                        <div class="mb-3">
                            <label for="presion" class="form-label">Presión: </label>
                            <input type="text" id="presion" name="presion" class="form-control" rows="2" placeholder="150/170" value="{{ $signos?->presion }}"></input>
                        </div>
                        <div class="mb-3">
                            <label for="frecuencia_cardiaca" class="form-label">Frecuencia Cardiaca: </label>
                            <input type="text" id="frecuencia_cardiaca" name="frecuencia_cardiaca" class="form-control" value="{{ $signos?->frecuencia_cardiaca }}"></input>
                        </div>

                        <label for="peso" class="form-label">Peso</label>
                        <div class="input-group">
                            <input type="number" id="peso" name="peso" class="form-control" min="0" value="{{ $signos?->peso }}" placeholder="">
                            <select id="unidad_peso" name="unidad_peso" class="form-select">
                                <option value="kilogramos" {{ $signos?->unidad_peso == 'kilogramos' ? 'selected' : '' }}>Kilogramos</option>
                            </select>
                        </div>
                        @error('presion') <small class="text-danger">{{ $message }}</small> @enderror
                        @error('unidad_presion') <small class="text-danger">{{ $message }}</small> @enderror
                        <br>
                        <label for="altura" class="form-label">Altura</label>
                        <div class="input-group">
                            <input type="number" step="0.01" id="altura" name="altura" class="form-control" value="{{ $signos?->altura }}" placeholder="">
                            <select id="unidad_altura" name="unidad_altura" class="form-select">
                                <option value="Metros" {{ $signos?->unidad_altura == 'Metros' ? 'selected' : '' }}>Metros</option>
                            </select>
                        </div>
                        @error('altura') <small class="text-danger">{{ $message }}</small> @enderror
                        @error('unidad_altura') <small class="text-danger">{{ $message }}</small> @enderror

                        <label for="saturacion_oxigeno" class="form-label">Saturación Oxigeno: </label>

                        <div class="input-group">
                            <input type="number" step="0.01" id="saturacion_oxigeno" name="saturacion_oxigeno" class="form-control" value="{{ $signos?->saturacion_oxigeno }}" placeholder="">
                            <select id="unidad_saturacion_oxigeno" name="unidad_saturacion_oxigeno" class="form-select">
                                <option value="%" {{ $signos?->unidad_saturacion_oxigeno == '%' ? 'selected' : '' }}>%</option>
                            </select>
                        </div>
                        @error('saturacion_oxigeno') <small class="text-danger">{{ $message }}</small> @enderror
                        @error('unidad_saturacion_oxigeno') <small class="text-danger">{{ $message }}</small> @enderror

                        <label for="glucometria" class="form-label">Glucometria: </label>

                        <div class="input-group">
                            <input type="number" step="0.01" id="glucometria" name="glucometria" class="form-control" value="{{ $signos?->glucometria }}" placeholder="">
                            <select id="unidad_glucometria" name="unidad_glucometria" class="form-select">
                                <option value="mg/dl" {{ $signos?->unidad_glucometria == 'mg/dl' ? 'selected' : '' }}>mg/dl</option>
                            </select>
                        </div>
                        @error('glucometria') <small class="text-danger">{{ $message }}</small> @enderror
                        @error('unidad_glucometria') <small class="text-danger">{{ $message }}</small> @enderror

                        <label for="indice_masa_corporal" class="form-label">Indice Masa Corporal: </label>

                        <div class="input-group">
                            <input type="number" id="indice_masa_corporal" step="0.01" name="indice_masa_corporal" class="form-control" value="{{ $signos?->indice_masa_corporal }}" readonly>
                            <select id="unidad_indice_masa_corporal" name="unidad_indice_masa_corporal" class="form-select">
                                <option value="kg/m2" {{ $signos?->unidad_indice_masa_corporal == 'kg/m2' ? 'selected' : '' }}>kg/m2</option>
                            </select>
                        </div>
                        @error('indice_masa_corporal') <small class="text-danger">{{ $message }}</small> @enderror
                        @error('unidad_indice_masa_corporal') <small class="text-danger">{{ $message }}</small> @enderror



                        <label for="plan_medico" class="form-label">Plan Medico:</label>
                        <div class="input-group">
                            <select id="plan_medico" name="plan_medico" class="form-select">
                                <option value="si" {{ $signos?->plan_medico == 'Talla' ? 'selected' : '' }}>si</option>
                                <option value="no" {{ $signos?->plan_medico == 'Talla' ? 'selected' : '' }}>no</option>
                            </select>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-success w-100 w-md-auto">Guardar cambios</button>
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

                        <hr>
                        <p class="fs-5"><strong>Temperatura:</strong> {{ $signos?->temperatura }} {{$signos?->unidad_temperatura}}</p>
                        <p class="fs-5"><strong>Presión: </strong> {{ $signos?->presion }}</p>
                        <p class="fs-5"><strong>Frecuencia Cardiaca: </strong> {{ $signos?->frecuencia_cardiaca }}</p>
                        <p class="fs-5"><strong>Peso: </strong> {{ $signos?->peso }} {{$signos?->unidad_peso}}</p>
                        <p class="fs-5"><strong>Altura: </strong> {{ $signos?->altura }} {{$signos?->unidad_altura}}</p>
                        <p class="fs-5"><strong>Saturación Oxigeno: </strong> {{ $signos?->saturacion_oxigeno }} {{$signos?->unidad_saturacion_oxigeno}}</p>
                        <p class="fs-5"><strong>Glucometria: </strong> {{ $signos?->glucometria }} {{$signos?->unidad_glucometria}}</p>
                        <p class="fs-5"><strong>Indice Masa Corporal: </strong> {{ $signos?->indice_masa_corporal }} {{$signos?->unidad_indice_masa_corporal}}</p>
                        <p class="fs-5"><strong>Plan Medico: </strong> {{ $signos?->plan_medico }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-bordered mt-4">
                        <thead class="table-dark">
                        <tr>
                            <th>Fecha</th>
                            <th>HEA</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($paciente->consultas as $consulta)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($consulta->fecha_actual)->format('d/m/Y H:i') }}</td>
                                <td>{{ $consulta->diagnostico }}</td>
                                <td>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalConsulta{{$consulta->id_consulta}}">
                                            Mostrar
                                        </button>
                                        <!-- Modal encargado de mostrar la consulta de esa fecha-->
                                        <div class="modal fade" id="modalConsulta{{$consulta->id_consulta}}" tabindex="-1" aria-labelledby="modalLabel{{$consulta->id_consulta}}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="modalLabel{{$consulta->id_consulta}}">Consulta del {{ \Carbon\Carbon::parse($consulta->fecha_actual)->format('d/m/Y H:i') }}</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col">
                                                                    <strong>Historia Enfermedad Actual</strong>
                                                                    <p><{{ $consulta->historia_enfermedad_Actual }}</p>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col">
                                                                    <strong>Antecedentes</strong>
                                                                    <p>{{ $consulta->antecedentes }}</p>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col">
                                                                    <strong>Diagnostico</strong>
                                                                    <p>{{ $consulta->diagnostico }}</p>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col">
                                                                    <strong>Tratamiento</strong>
                                                                    <p>{{ $consulta->tratamiento }}</p>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col">
                                                                    <strong>Examenes</strong>
                                                                    <p>{{ $consulta->examenes }}</p>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div>
                                                                    <strong>Nombre del Medico</strong>
                                                                    <p>{{ $consulta->nombre_medico }}</p>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col">
                                                                    <strong>Fecha Siguiente Cita</strong>
                                                                    <p>{{ $consulta->fecha_siguiente_cita ? \Carbon\Carbon::parse($consulta->fecha_siguiente_cita)->format('d/m/Y') : 'Sin cita' }}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col">
                                                                <div class="d-flex flex-column flex-md-row justify-content-center gap-2">
                                                                    <!-- Botón para abrir el modal de archivos -->
                                                                    <button type="button" class="btn btn-sm btn-info w-100 w-md-auto" data-bs-toggle="modal" data-bs-target="#modalArchivos{{ $consulta->id_consulta }}">
                                                                        <i class="bi bi-images"></i> Archivos
                                                                    </button>

                                                                    <a href="{{ route('consultas.edit', $consulta->id_consulta) }}" class="btn btn-sm btn-warning w-100 w-md-auto">
                                                                        <i class="bi bi-pencil-square"></i> Editar
                                                                    </a>

                                                                    <form action="{{ route('consultas.destroy', $consulta->id_consulta) }}" method="POST" class="w-100 w-md-auto">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit" class="btn btn-sm btn-danger w-100 w-md-auto" onclick="return confirm('¿Eliminar esta consulta?')">
                                                                            <i class="bi bi-trash"></i> Eliminar
                                                                        </button>
                                                                    </form>

                                                                    <a href="{{ route('pacientes.reporte', $consulta->id_consulta) }}" class="btn btn-sm btn-success w-100 w-md-auto" target="_blank">
                                                                        <i class="bi bi-file-earmark-pdf"></i> Reporte
                                                                    </a>

                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                </td>
                            </tr>


                            <!-- Modal único para esta consulta -->
                            <div class="modal fade" id="modalArchivos{{ $consulta->id_consulta }}" tabindex="-1" aria-labelledby="modalArchivosLabel{{ $consulta->id_consulta }}" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalArchivosLabel{{ $consulta->id_consulta }}">Archivos de la consulta #{{ $consulta->id_consulta }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                        </div>
                                        <div class="modal-body">
                                            @if($consulta->archivos->count() > 0)
                                                <div id="carousel{{ $consulta->id_consulta }}" class="carousel slide" data-bs-ride="carousel">
                                                    <div class="carousel-inner">
                                                        @foreach($consulta->archivos as $index => $archivo)
                                                            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                                                @if(Str::endsWith($archivo->ruta, ['.jpg','.jpeg','.png']))
                                                                    <img src="{{ asset($archivo->ruta) }}" class="d-block w-100" alt="Archivo {{ $index+1 }}">
                                                                @else
                                                                    <div class="text-center p-5">
                                                                        <a href="{{ asset($archivo->ruta) }}" target="_blank" class="btn btn-outline-info">
                                                                            Descargar archivo {{ $index+1 }}
                                                                        </a>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                    <button class="carousel-control-prev" type="button" data-bs-target="#carousel{{ $consulta->id_consulta }}" data-bs-slide="prev">
                                                        <span class="carousel-control-prev-icon"></span>
                                                    </button>
                                                    <button class="carousel-control-next" type="button" data-bs-target="#carousel{{ $consulta->id_consulta }}" data-bs-slide="next">
                                                        <span class="carousel-control-next-icon"></span>
                                                    </button>
                                                </div>
                                            @else
                                                <p class="text-muted">No hay archivos asociados a esta consulta.</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                <hr>
                <h4>Agregar nueva consulta</h4>
                <form action="{{ route('consultas.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id_signos_vitales" value="{{ $signos?->id_signos_vitales }}">
                    <input type="hidden" name="id_paciente" value="{{ $paciente->id_paciente }}">
                    <input type="hidden" name="identidad" value="{{ $paciente->identidad }}">
                    <textarea name="antecedentes" class="form-control mb-2" placeholder="A.P.P..."></textarea>
                    <textarea name="descripcion_motivo" class="form-control mb-2" placeholder="Motivo de consulta..."></textarea>
                    <textarea name="historia_enfermedad_Actual" class="form-control mb-2" placeholder="HEA..."></textarea>
                    <textarea name="diagnostico" class="form-control mb-2" placeholder="Diagnóstico..."></textarea>
                    <textarea name="tratamiento" class="form-control mb-2" placeholder="Tratamiento..."></textarea>
                    <textarea name="examenes" class="form-control mb-2" placeholder="Exámenes..."></textarea>
                    <div class="mb-3">
                        <div id="fileInputs">
                            <input type="file" name="archivos[]" class="form-control mb-2">
                        </div>
                        <button type="button" class="btn btn-success" onclick="addFileInput()">Cargar Otra Imagen</button>
                    </div>

                    <div class="mb-3">
                        <label for="fecha_siguiente_cita" class="form-label">Fecha Próxima Cita</label>
                        <input type="date" name="fecha_siguiente_cita" class="form-control mb-3">
                        @error('fecha_siguiente_cita') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="nombre_medico" class="form-label">Nombre del médico que realizó la consulta</label>
                        <input type="text" name="nombre_medico" class="form-control" value="{{ old('nombre_medico') }}">
                        @error('nombre_medico') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <button type="submit" class="btn btn-success w-100 w-md-auto">Guardar Consulta</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    function addFileInput() {
        const div = document.getElementById('fileInputs');
        const input = document.createElement('input');
        input.type = 'file';
        input.name = 'archivos[]';
        input.classList.add('form-control','mb-2');
        div.appendChild(input);
    }

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
            title: '¡Enhorabuena!',
            text: '{{ session('success') }}',
            icon: 'success',
            confirmButtonText: 'Aceptar',
            confirmButtonColor: '#3085d6'
        });
    </script>
@endif