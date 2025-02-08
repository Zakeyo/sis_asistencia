<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte de Asistencias</title>
    <link rel="stylesheet" href="{{ public_path('css/reportes/styles.css') }}">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .details {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }
        .table-container {
            width: 100%;
            border-collapse: collapse;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            text-align: center;
        }
        .table th, .table td {
            border: 1px solid black;
            padding: 8px;
            font-size: 14px;
        }
        .table th {
            background-color: #f2f2f2;
        }
        .firma {
            height: 40px;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ public_path('images/encabezado.png') }}" alt="Encabezado" width="100%" height="10%">
    </div>
    
    <h2 style="text-align: center;">ASISTENCIA PERSONAL: {{ strtoupper($cargo) }}</h2>
    
    <div class="details">
        <table style="width: 100%; text-align: center;">
            <tr>
                <td style="width: 33,3%; text-align: left;"><strong>Rango de Fechas:</strong> Todas</td>
                <td style="width: 33,3%; text-align: center;"><strong>Turno:</strong> {{ $turno }}</td>
                <td style="width: 33,3%; text-align: right;"><strong>Fecha de Expedición:</strong> {{ \Carbon\Carbon::parse($fecha)->format('d/m/Y') }}</td>
            </tr>
        </table>
    </div>
    
    <div class="table-container">
        <table class="table">
            <thead>
                <tr>
                    <th style="width: 15%;">Nombre y Apellido</th>
                    <th style="width: 10%;">Cédula</th>
                    {{-- Si el cargo es Docente, agregar columnas extras --}}
                    @if(strtoupper($cargo) == 'DOCENTE')
                        <th style="width: 14%;">Materia</th>
                        <th style="width: 9%;">Tray-Sem</th>
                        <th style="width: 6%;">Sec</th>
                        <th style="width: 6%;">Aula</th>
                    @endif
                    <th style="width: 10%;">Hora de Entrada</th>
                    <th style="width: 10%;">Hora de Salida</th>
                    <th style="width: 8%;">Firma</th>
                    <th style="width: 15%;">Observación</th>
                </tr>
            </thead>
    
            <tbody>
                @foreach ($asistencias as $asistencia)
                    <tr>
                        <td>{{ $asistencia->miembro->nombre_apellido }}</td>
                        <td>{{ number_format($asistencia->miembro->cedula, 0, '.', '.') }}</td>
                        {{-- Si el cargo es Docente, agregar campos en blanco --}}
                        @if(strtoupper($cargo) == 'DOCENTE')
                            <td></td> {{-- Materia --}}
                            <td></td> {{-- Tray-Sem --}}
                            <td></td> {{-- Sec --}}
                            <td></td> {{-- Aula --}}
                        @endif
                        <td>{{ $asistencia->hora_entrada ? \Carbon\Carbon::parse($asistencia->hora_entrada)->format('g:i A') : 'N/A' }}</td>
                        <td>{{ $asistencia->hora_salida ? \Carbon\Carbon::parse($asistencia->hora_salida)->format('g:i A') : 'N/A' }}</td>
                        <td class="firma"></td>
                        <td></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
