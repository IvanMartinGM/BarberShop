<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Reporte de Barberos</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
            color: #1C1917;
            background: #FFFFFF;
            margin: 24px;
        }

        .header {
            border-bottom: 4px solid #DC2626;
            padding-bottom: 12px;
            margin-bottom: 18px;
        }

        .title {
            font-size: 26px;
            font-weight: bold;
            color: #1E3A8A;
            margin: 0;
        }

        .subtitle {
            font-size: 12px;
            color: #57534E;
            margin-top: 4px;
        }

        .meta {
            background: #F5F5F4;
            border: 1px solid #D6D3D1;
            padding: 10px 12px;
            margin-bottom: 18px;
        }

        .record {
            border: 1px solid #D6D3D1;
            margin-bottom: 18px;
            page-break-inside: avoid;
        }

        .record-header {
            background: #1E3A8A;
            color: #FFFFFF;
            padding: 10px 12px;
        }

        .record-title {
            font-size: 15px;
            font-weight: bold;
            margin: 0;
        }

        .record-subtitle {
            font-size: 10px;
            margin-top: 3px;
            color: #DBEAFE;
        }

        .section-title {
            background: #F5F5F4;
            color: #1E3560;
            font-weight: bold;
            padding: 7px 10px;
            border-top: 1px solid #D6D3D1;
            border-bottom: 1px solid #D6D3D1;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            border: 1px solid #E7E5E4;
            padding: 7px;
            vertical-align: top;
        }

        .label {
            width: 28%;
            color: #57534E;
            font-weight: bold;
            background: #FAFAF9;
        }

        .value {
            color: #1C1917;
        }

        .badge-active {
            color: #16A34A;
            font-weight: bold;
        }

        .badge-warning {
            color: #D97706;
            font-weight: bold;
        }

        .badge-danger {
            color: #DC2626;
            font-weight: bold;
        }

        .notes {
            padding: 10px;
            line-height: 1.5;
            border-top: 1px solid #E7E5E4;
        }

        .footer {
            margin-top: 20px;
            font-size: 9px;
            text-align: center;
            color: #78716C;
        }
    </style>

    <link rel="icon" type="image/svg+xml" href="{{ public_path('razor-electric.svg') }}">
</head>

<body>
    <div class="header">
        <h1 class="title">Reporte de Barberos</h1>
        <div class="subtitle">Sistema de Gestión para Barbería</div>
    </div>

    <div class="meta">
        <strong>Fecha y hora de generación:</strong> {{ $fechaGeneracion }} <br>
        <strong>Total de barberos:</strong> {{ $barberos->count() }} <br>
        <strong>Tipo de reporte:</strong> Información administrativa y laboral de barberos
    </div>

    @foreach ($barberos as $barbero)
        @php
            $user = $barbero->user;

            $nombreCompleto = trim(
                ($user?->nombres ?? '') . ' ' .
                ($user?->primer_apellido ?? '') . ' ' .
                ($user?->segundo_apellido ?? '')
            );

            $genero = $user?->genero;
            $estadoDisponibilidad = $barbero->estado_disponibilidad;
        @endphp

        <div class="record">
            <div class="record-header">
                <p class="record-title">
                    {{ $nombreCompleto !== '' ? $nombreCompleto : 'Barbero sin nombre registrado' }}
                </p>

                <div class="record-subtitle">
                    ID Barbero: {{ $barbero->id }} |
                    ID Usuario: {{ $barbero->id_usuario ?? 'No registrado' }} |
                    Especialidad: {{ $barbero->especialidad ?? 'No registrada' }}
                </div>
            </div>

            <div class="section-title">Información de cuenta</div>

            <table>
                <tr>
                    <td class="label">Correo electrónico</td>
                    <td class="value">{{ $user?->email ?? 'No registrado' }}</td>

                    <td class="label">Nombre de usuario</td>
                    <td class="value">{{ $user?->nombre_usuario ?? 'No registrado' }}</td>
                </tr>

                <tr>
                    <td class="label">Celular</td>
                    <td class="value">{{ $user?->celular ?? 'No registrado' }}</td>

                    <td class="label">Estado de usuario</td>
                    <td class="value">
                        @if ($user?->estado == 1)
                            <span class="badge-active">Activo</span>
                        @else
                            <span class="badge-danger">Inactivo</span>
                        @endif
                    </td>
                </tr>

                <tr>
                    <td class="label">Fecha de registro</td>
                    <td class="value">{{ $user?->fecha_registro ?? 'No registrada' }}</td>

                    <td class="label">Último acceso</td>
                    <td class="value">{{ $user?->ultimo_acceso ?? 'Sin acceso registrado' }}</td>
                </tr>
            </table>

            <div class="section-title">Información personal</div>

            <table>
                <tr>
                    <td class="label">Nombres</td>
                    <td class="value">{{ $user?->nombres ?? 'No registrado' }}</td>

                    <td class="label">Primer apellido</td>
                    <td class="value">{{ $user?->primer_apellido ?? 'No registrado' }}</td>
                </tr>

                <tr>
                    <td class="label">Segundo apellido</td>
                    <td class="value">{{ $user?->segundo_apellido ?? 'No registrado' }}</td>

                    <td class="label">Género</td>
                    <td class="value">
                        @if (!$genero)
                            No registrado
                        @elseif ($genero === 'M')
                            Masculino
                        @elseif ($genero === 'F')
                            Femenino
                        @else
                            Otro
                        @endif
                    </td>
                </tr>
            </table>

            <div class="section-title">Información laboral del barbero</div>

            <table>
                <tr>
                    <td class="label">Especialidad</td>
                    <td class="value">{{ $barbero->especialidad ?? 'No registrada' }}</td>

                    <td class="label">Estado disponibilidad</td>
                    <td class="value">
                        @if ($estadoDisponibilidad === 'disponible')
                            <span class="badge-active">Disponible</span>
                        @elseif ($estadoDisponibilidad === 'ocupado')
                            <span class="badge-warning">Ocupado</span>
                        @else
                            <span class="badge-danger">Inactivo</span>
                        @endif
                    </td>
                </tr>

                <tr>
                    <td class="label">Fecha contratación</td>
                    <td class="value">{{ $barbero->fecha_contratacion ?? 'No registrada' }}</td>

                    <td class="label">Experiencia</td>
                    <td class="value">{{ $barbero->experiencia_anos ?? 0 }} años</td>
                </tr>

                <tr>
                    <td class="label">Calificación promedio</td>
                    <td class="value">
                        {{ number_format((float) ($barbero->calificacion_promedio ?? 0), 2) }}
                    </td>

                    <td class="label">ID interno</td>
                    <td class="value">#{{ $barbero->id }}</td>
                </tr>
            </table>

            <div class="section-title">Biografía</div>

            <div class="notes">
                {{ $barbero->biografia ?? 'Este barbero aún no tiene biografía registrada.' }}
            </div>
        </div>
    @endforeach

    <div class="footer">
        Reporte generado automáticamente por el Sistema de Gestión para Barbería.
    </div>
</body>
</html>