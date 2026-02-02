<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte del Paciente</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
<div>
    <img src="{{ public_path('images/para_pdf.jpg') }}" alt="Logo" width="50"
         style="display:inline-block; vertical-align:middle; margin-right:10px;">
    <h2 style="display:inline-block; vertical-align:middle; margin:0;">CLINICA MEDICA - Expediente</h2>
</div>

<hr>
@if($paciente->consultas->isEmpty())
    <p>No hay</p>
@else

        <table style="border:none; padding:5px;">
            <td style="border:none; padding:5px;">Fecha: {{ $consulta->created_at->format('d/m/Y') }}</td>
            <td style="border:none; padding-right:140px;"> </td>
            <td style="border:none; padding:5px;">Medico: {{ $consulta->nombre_medico }}</td>

        </table>
@endif
<h4>Información General</h4>
<table style="border:none; padding:5px;">
    <tr style="font-size:12px ">
        <th style="border:none;">DNI</th>
        <th style="border:none;">Nombre</th>
        <th style="border:none;">Telefono</th>
        <th style="border:none;">Dirección</th>
        <th style="border:none;">Edad</th>
    </tr>
    <tr style="font-size:12px ">
        <td style="border:none;">{{ $paciente->identidad }}</td>
        <td style="border:none;">{{ $paciente->nombre_completo }}</td>
        <td style="border:none;">{{ $paciente->telefono }}</td>
        <td style="border:none;">{{ $paciente->direccion }}</td>
        <td style="border:none;">{{ $paciente->edad_valor }} {{ $paciente->edad_unidad }}</td>
    </tr>
</table>

<h4>Últimos Signos Vitales</h4>
@if($signos)
        <table style="border:none; padding:5px;">
            <tr style="font-size:12px ">
                <th style="border:none;">Temperatura</th>
                <th style="border:none;">Presión</th>
                <th style="border:none;">Frecuencia Cardiaca</th>
                <th style="border:none;">Peso</th>
                <th style="border:none;">Altura</th>
            </tr>
            <tr style="font-size:12px ">
                <td style="border:none;">{{ $signos->temperatura }} {{ $signos->unidad_temperatura }}</td>
                <td style="border:none;">{{ $signos->presion }}</td>
                <td style="border:none;">{{ $signos->frecuencia_cardiaca }}</td>
                <td style="border:none;">{{ $signos->peso }} {{ $signos->unidad_peso }}</td>
                <td style="border:none;">{{ $signos->altura }} {{ $signos->unidad_altura }}</td>
            </tr>
        </table>
@else
    <p>No se registraron signos vitales en la fecha de la consulta</p>
@endif
<h3>Motivos de Consulta</h3>
@if($paciente->consultas->isEmpty())
    <p>No hay motivos de consulta registrados.</p>
@else

            <table style="border:none; padding:5px;">
                <tr style="font-size:12px ">
                    <th style="border:none;">Descripción Motivo</th>

                </tr>
                <tr style="font-size:12px ">
                    <td style="border:none;">{{ $consulta->descripcion_motivo }}</td>
                </tr>
                <tr style="font-size:12px ">
                    <th style="border:none;">Historial Enfermedad Actual</th>
                </tr>
                <tr style="font-size:12px ">
                    <td style="border:none;">{{ $consulta->historia_enfermedad_Actual }}</td>
                </tr>
                <tr style="font-size:12px ">
                    <th style="border:none;">Diagnostico</th>
                </tr>
                <tr style="font-size:12px ">
                    <td style="border:none;">{{ $consulta->diagnostico }}</td>
                </tr>
                <tr style="font-size:12px ">
                    <th style="border:none;">Tratamiento</th>
                </tr>
                <tr style="font-size:12px ">
                    <td style="border:none;">{{ $consulta->tratamiento }}</td>
                </tr>
                <tr style="font-size:12px ">
                    <th style="border:none;">Examenes</th>
                </tr>
                <tr style="font-size:12px ">
                    <td style="border:none;">{{ $consulta->examenes }}</td>
                </tr>
                <tr style="font-size:12px ">
                    <th style="border:none;">Antecedentes</th>
                </tr>
                <tr style="font-size:12px ">
                    <td style="border:none;">{{ $consulta->antecedentes }}</td>
                </tr>
                <tr style="font-size:12px ">
                    <th style="border:none;">Fecha De Siguiente Cita</th>
                </tr>
                <tr style="font-size:12px ">
                    <td style="border:none;">{{ $consulta->fecha_siguiente_cita }}</td>
                </tr>
            </table>
@endif
</body>
</html>