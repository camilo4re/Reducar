<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mi Reporte de Asistencias - {{ $materia->nombre }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href='https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap' rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('profesor/estilospaginico.css') }}">
</head>
<body>

<button id="abrirMenu">☰</button>

<nav id="menuLateral" class="cerrado">
    <button id="cerrarMenu">×</button>
    <ul>
        <li><a href="{{ route('materias.index') }}">Inicio <i class="fa-solid fa-house"></i></a></li>
        <li><a href="#">Horarios <i class="fa-solid fa-calendar"></i></a></li>
        <li>
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Cerrar Sesión <i class="fa-solid fa-right-from-bracket"></i>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
    </ul>
</nav>

<main class="content">
    <header>
        <div class="header-superior">
            <div class="titulo-izquierda">
                <span class="titulo-principal">{{ $materia->nombre }} - Mi Reporte Anual</span>
                <span class="subtitulo">{{ $materia->curso->año }} {{ $materia->curso->division }} - Año {{ $year }}</span>
            </div>
            <img src="/IMAGENES/LOGOTEC3.png" alt="Logo de la escuela" class="logo">
        </div>
        <div class="barras">
            <div class="barra-naranja"></div>
            <div class="barra-verde"></div>
        </div>
    </header>

    <div class="acciones" style="margin: 20px; text-align: center;">
        <a href="{{ route('asistencias.index', [$materia->id, 'year' => $year]) }}" class="boton">
            Volver a Asistencias
        </a>
        <button onclick="window.print()" class="boton editar">
            <i class="fa-solid fa-print"></i> Imprimir
        </button>
    </div>

    @php
        // Buscar solo la información del alumno logueado
        $miReporte = null;
        foreach($reportes as $reporte) {
            if($reporte['alumno']->id == auth()->id()) {
                $miReporte = $reporte;
                break;
            }
        }
    @endphp

    @if($miReporte)
        <!-- Resumen Principal usando las clases de tu CSS -->
        <div style="margin: 30px;">
            <ul class="clases" style="grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px;">
                <li class="cajas" style="background: linear-gradient(135deg, #007c00, #27ae60); color: white;">
                    <div style="padding: 20px; text-align: center; height: auto;">
                        <div style="font-size: 36px; font-weight: bold; margin-bottom: 5px;">{{ $miReporte['porcentaje'] }}%</div>
                        <div style="font-size: 16px;">Asistencia General</div>
                    </div>
                </li>
                <li class="cajas" style="background: linear-gradient(135deg, #007c00, #34d399); color: white;">
                    <div style="padding: 20px; text-align: center; height: auto;">
                        <div style="font-size: 36px; font-weight: bold; margin-bottom: 5px;">{{ $miReporte['presentes'] }}</div>
                        <div style="font-size: 16px;">Presentes</div>
                    </div>
                </li>
                <li class="cajas" style="background: linear-gradient(135deg, #e74c3c, #f87171); color: white;">
                    <div style="padding: 20px; text-align: center; height: auto;">
                        <div style="font-size: 36px; font-weight: bold; margin-bottom: 5px;">{{ $miReporte['ausentes'] }}</div>
                        <div style="font-size: 16px;">Faltas</div>
                    </div>
                </li>
                <li class="cajas" style="background: linear-gradient(135deg, #f39c12, #fbbf24); color: white;">
                    <div style="padding: 20px; text-align: center; height: auto;">
                        <div style="font-size: 36px; font-weight: bold; margin-bottom: 5px;">{{ $miReporte['tardanzas'] }}</div>
                        <div style="font-size: 16px;">Tardanzas</div>
                    </div>
                </li>
                <li class="cajas" style="background: linear-gradient(135deg, #2196f3, #60a5fa); color: white;">
                    <div style="padding: 20px; text-align: center; height: auto;">
                        <div style="font-size: 36px; font-weight: bold; margin-bottom: 5px;">{{ $miReporte['justificadas'] }}</div>
                        <div style="font-size: 16px;">Justificadas</div>
                    </div>
                </li>
            </ul>
        </div>

        <!-- Estado de Asistencia -->
        <div style="margin: 30px;">
            <div class="contnotis">
                <div class="notis" style="
                    @if($miReporte['porcentaje'] >= 80)
                        background: linear-gradient(135deg, #10b981, #34d399); color: white;
                    @elseif($miReporte['porcentaje'] >= 70)
                        background: linear-gradient(135deg, #f59e0b, #fbbf24); color: white;
                    @else
                        background: linear-gradient(135deg, #ef4444, #f87171); color: white;
                    @endif
                    text-align: center; padding: 25px; border-radius: 15px;">
                    <strong style="font-size: 24px; margin-bottom: 10px;">
                        @if($miReporte['porcentaje'] >= 80)
                            <i class="fa-solid fa-check-circle"></i> Estado: REGULAR
                        @elseif($miReporte['porcentaje'] >= 70)
                            <i class="fa-solid fa-exclamation-triangle"></i> Estado: EN RIESGO
                        @else
                            <i class="fa-solid fa-times-circle"></i> Estado: IRREGULAR
                        @endif
                    </strong>
                    <p style="margin: 10px 0 0 0; font-size: 16px; opacity: 0.9;">
                        @if($miReporte['porcentaje'] >= 80)
                            ¡Excelente! Mantén tu buen rendimiento.
                        @elseif($miReporte['porcentaje'] >= 70)
                            Necesitas mejorar tu asistencia para mantener un buen rendimiento.
                        @else
                            Tu asistencia está por debajo del mínimo requerido. Es importante que mejores.
                        @endif
                    </p>
                </div>
            </div>
        </div>

        <!-- Información Personal -->
        <div style="margin: 30px;">
            <div class="contnotis">
                <div class="notis" style="background: #f8f9fa; border-left: 5px solid #007c00;">
                    <strong style="color: #007c00; font-size: 20px;">{{ auth()->user()->name }}</strong>
                    <p><strong>Materia:</strong> {{ $materia->nombre }}</p>
                    <p><strong>Curso:</strong> {{ $materia->curso->año }} {{ $materia->curso->division }}</p>
                    <p><strong>Total de clases registradas:</strong> {{ $miReporte['total_dias'] }}</p>
                </div>
            </div>
        </div>

        <!-- Tabla Detallada -->
        <div class="tabla-container">
            <h2>Detalle de Mi Asistencia</h2>
            <div class="tabla-asistencias">
                <table>
                    <thead>
                        <tr>
                            <th>Concepto</th>
                            <th>Cantidad</th>
                            <th>Porcentaje</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong style="color: #007c00;">Presentes</strong></td>
                            <td style="color: #007c00; font-weight: bold;">{{ $miReporte['presentes'] }}</td>
                            <td>
                                <div class="barra-asistencia" style="width: {{ $miReporte['total_dias'] > 0 ? ($miReporte['presentes'] / $miReporte['total_dias']) * 100 : 0 }}%; margin-bottom: 5px;"></div>
                                {{ $miReporte['total_dias'] > 0 ? round(($miReporte['presentes'] / $miReporte['total_dias']) * 100, 1) : 0 }}%
                            </td>
                            <td>
                                <span style="color: #007c00; font-weight: bold;">✓ Excelente</span>
                            </td>
                        </tr>
                        <tr>
                            <td><strong style="color: #f39c12;">Tardanzas</strong></td>
                            <td style="color: #f39c12; font-weight: bold;">{{ $miReporte['tardanzas'] }}</td>
                            <td>
                                <div class="barra-asistencia" style="width: {{ $miReporte['total_dias'] > 0 ? ($miReporte['tardanzas'] / $miReporte['total_dias']) * 100 : 0 }}%; background: #f39c12; margin-bottom: 5px;"></div>
                                {{ $miReporte['total_dias'] > 0 ? round(($miReporte['tardanzas'] / $miReporte['total_dias']) * 100, 1) : 0 }}%
                            </td>
                            <td>
                                @if($miReporte['tardanzas'] == 0)
                                    <span style="color: #007c00; font-weight: bold;">✓ Perfecto</span>
                                @elseif($miReporte['tardanzas'] <= 3)
                                    <span style="color: #f39c12; font-weight: bold;">⚠ Aceptable</span>
                                @else
                                    <span style="color: #e74c3c; font-weight: bold;">⚠ Mejorar</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td><strong style="color: #2196f3;">Justificadas</strong></td>
                            <td style="color: #2196f3; font-weight: bold;">{{ $miReporte['justificadas'] }}</td>
                            <td>
                                <div class="barra-asistencia" style="width: {{ $miReporte['total_dias'] > 0 ? ($miReporte['justificadas'] / $miReporte['total_dias']) * 100 : 0 }}%; background: #2196f3; margin-bottom: 5px;"></div>
                                {{ $miReporte['total_dias'] > 0 ? round(($miReporte['justificadas'] / $miReporte['total_dias']) * 100, 1) : 0 }}%
                            </td>
                            <td>
                                <span style="color: #2196f3; font-weight: bold;">J Justificada</span>
                            </td>
                        </tr>
                        <tr style="background-color: #fee;">
                            <td><strong style="color: #d32f2f;">Ausentes</strong></td>
                            <td style="color: #d32f2f; font-weight: bold;">{{ $miReporte['ausentes'] }}</td>
                            <td>
                                <div class="barra-asistencia" style="width: {{ $miReporte['total_dias'] > 0 ? ($miReporte['ausentes'] / $miReporte['total_dias']) * 100 : 0 }}%; background: #d32f2f; margin-bottom: 5px;"></div>
                                {{ $miReporte['total_dias'] > 0 ? round(($miReporte['ausentes'] / $miReporte['total_dias']) * 100, 1) : 0 }}%
                            </td>
                            <td>
                                @if($miReporte['ausentes'] == 0)
                                    <span style="color: #007c00; font-weight: bold;">✓ Perfecto</span>
                                @elseif($miReporte['ausentes'] <= 2)
                                    <span style="color: #f39c12; font-weight: bold;">⚠ Cuidado</span>
                                @else
                                    <span style="color: #d32f2f; font-weight: bold;">✗ Crítico</span>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Gráfico de Progreso usando tu CSS -->
        <div style="margin: 30px;">
            <div class="horario-container">
                <div class="tabla-horario">
                    <h2 style="color: #007c00; margin-bottom: 20px;">Mi Progreso Visual</h2>
                    
                    <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 15px; padding: 10px;">
                        <span style="font-weight: 600; min-width: 120px; color: #007c00;">Presentes:</span>
                        <div style="flex: 1; background: #e0e0e0; border-radius: 10px; height: 25px; position: relative;">
                            <div class="barra-asistencia" style="height: 100%; width: {{ $miReporte['total_dias'] > 0 ? ($miReporte['presentes'] / $miReporte['total_dias']) * 100 : 0 }}%; border-radius: 10px;"></div>
                        </div>
                        <span style="font-weight: 600; color: #007c00; min-width: 80px;">{{ $miReporte['presentes'] }}/{{ $miReporte['total_dias'] }}</span>
                    </div>
                    
                    <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 15px; padding: 10px;">
                        <span style="font-weight: 600; min-width: 120px; color: #f39c12;">Tardanzas:</span>
                        <div style="flex: 1; background: #e0e0e0; border-radius: 10px; height: 25px;">
                            <div style="background: #f39c12; height: 100%; width: {{ $miReporte['total_dias'] > 0 ? ($miReporte['tardanzas'] / $miReporte['total_dias']) * 100 : 0 }}%; border-radius: 10px;"></div>
                        </div>
                        <span style="font-weight: 600; color: #f39c12; min-width: 80px;">{{ $miReporte['tardanzas'] }}/{{ $miReporte['total_dias'] }}</span>
                    </div>
                    
                    <div style="display: flex; align-items: center; gap: 15px; padding: 10px;">
                        <span style="font-weight: 600; min-width: 120px; color: #d32f2f;">Ausentes:</span>
                        <div style="flex: 1; background: #e0e0e0; border-radius: 10px; height: 25px;">
                            <div style="background: #d32f2f; height: 100%; width: {{ $miReporte['total_dias'] > 0 ? ($miReporte['ausentes'] / $miReporte['total_dias']) * 100 : 0 }}%; border-radius: 10px;"></div>
                        </div>
                        <span style="font-weight: 600; color: #d32f2f; min-width: 80px;">{{ $miReporte['ausentes'] }}/{{ $miReporte['total_dias'] }}</span>
                    </div>
                </div>
            </div>
        </div>

    @else
        <div style="margin: 50px;">
            <div class="contnotis">
                <div class="notis" style="text-align: center; padding: 40px; background: #f8f9fa;">
                    <i class="fa-solid fa-exclamation-triangle" style="font-size: 48px; color: #f39c12; margin-bottom: 20px;"></i>
                    <strong style="color: #374151; font-size: 20px;">No se encontraron registros de asistencia</strong>
                    <p style="color: #6b7280; margin-top: 10px;">Aún no tienes registros de asistencia para esta materia.</p>
                </div>
            </div>
        </div>
    @endif

    <div style="margin: 20px; font-size: 12px; color: #666; text-align: center;">
        <p>Reporte generado el {{ date('d/m/Y H:i') }}</p>
        <p><strong>Leyenda:</strong> ✓ Presente | ✗ Ausente | ⏰ Tardanza | J Justificada</p>
    </div>

</main>

<script>
const menu = document.getElementById('menuLateral');
const abrir = document.getElementById('abrirMenu');
const cerrar = document.getElementById('cerrarMenu');

abrir.addEventListener('click', () => {
    menu.classList.add('abierto');
    abrir.classList.add('oculto');
});

cerrar.addEventListener('click', () => {
    menu.classList.remove('abierto');
    abrir.classList.remove('oculto');
});
</script>

</body>
</html>