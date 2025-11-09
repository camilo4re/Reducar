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
    <li><a href="{{ route ('materias.index')}}">Inicio <i class="fa-solid fa-house"></i></a></li>
    @if (auth()->user()->role === 'alumno')
    <li><a href="{{ route('calendario.index') }}">Horarios <i class="fa-solid fa-calendar"></i></a></li>
    @endif
    @if (auth()->user()->role === 'alumno' || auth()->user()->role === 'profesor')
    <li><a href="{{ route('perfil.show', Auth::user()->id) }}"> Mis Datos <i class="fa-solid fa-user"></i></a></li>
    @endif
    @if (Auth::user()->role === 'directivo')
    <li><a href="{{ route('tokens.index') }}">Crear Usuarios <i class="fa-solid fa-ticket"></i></a></li>
    <li><a href="{{ route('tokens.listar') }}">Lista de Codigos Creados <i class="fa-solid fa-list"></i></a></li>
    <li><a href="{{ route('perfiles.index') }}">Perfiles de Usuarios<i class="fa-solid fa-user"></i></a></li>
    @endif
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
                <span class="subtitulo">{{ $materia->curso->año }} {{ $materia->curso->division }}</span>
            </div>
            <img src="/IMAGENES/LOGOTEC3.png" alt="Logo de la escuela" class="logo">
        </div>
        <div class="barras">
            <div class="barra-naranja"></div>
            <div class="barra-verde"></div>
        </div>
    </header>

    <div class="containerr">
        <div class="accioness">
            <a href="{{ route('asistencias.index', [$materia->id, 'year' => $year]) }}" class="boton">
                <i class="fa-solid fa-arrow-left"></i> Volver a Asistencias
            </a>
            <h2>Mi Reporte de Asistencia</h2>
            <button onclick="window.print()" class="boton editar">
                <i class="fa-solid fa-print"></i> Imprimir
            </button>
        </div>

        @php
            $miReporte = null;
            foreach($reportes as $reporte) {
                if($reporte['alumno']->id == auth()->id()) {
                    $miReporte = $reporte;
                    break;
                }
            }
        @endphp

        @if($miReporte)
        <div class="contnotis">
            <section class="info-card">
                <h3 class="info-titulo">{{ auth()->user()->name }}</h3>
                <div class="info-detalle">
                    <p><strong>Materia:</strong> {{ $materia->nombre }}</p>
                    <p><strong>Curso:</strong> {{ $materia->curso->año }} {{ $materia->curso->division }}</p>
                    <p><strong>Total de clases registradas:</strong> {{ $miReporte['total_dias'] }}</p>
                </div>
            </section>

            <section class="resumen-general">
                <h2 class="resumen-titulo">Resumen de Mi Asistencia</h2>
                <ul class="resumen-grid mi-reporte">
                    <li class="cajas stat-card">
                        <div class="stat-content">
                            <div class="stat-number">{{ $miReporte['porcentaje'] }}%</div>
                            <div class="stat-label">Asistencia General</div>
                        </div>
                    </li>
                    <li class="cajass stat-card presentes">
                        <div class="stat-content">
                            <div class="stat-number">{{ $miReporte['presentes'] }}</div>
                            <div class="stat-label">Presentes</div>
                            <i class="fa-solid fa-check"></i>
                        </div>
                    </li>
                    <li class="cajass stat-card ausentes">
                        <div class="stat-content">
                            <div class="stat-number">{{ $miReporte['ausentes'] }}</div>
                            <div class="stat-label">Faltas</div>
                            <i class="fa-solid fa-times"></i>
                        </div>
                    </li>
                    <li class="cajass stat-card tardanzas">
                        <div class="stat-content">
                            <div class="stat-number">{{ $miReporte['tardanzas'] }}</div>
                            <div class="stat-label">Tardanzas</div>
                            <i class="fa-solid fa-clock"></i>
                        </div>
                    </li>
                    <li class="cajass stat-card justificadas">
                        <div class="stat-content">
                            <div class="stat-number">{{ $miReporte['justificadas'] }}</div>
                            <div class="stat-label">Justificadas</div>
                            <i class="fa-solid fa-file-medical"></i>
                        </div>
                    </li>
                </ul>
            </section>

            <section class="estado-asistencia 
                @if($miReporte['porcentaje'] >= 80) estado-regular
                @elseif($miReporte['porcentaje'] >= 70) estado-riesgo  
                @else estado-irregular @endif">
                
                <div class="estado-icono">
                    @if($miReporte['porcentaje'] >= 80)
                        <i class="fa-solid fa-check-circle"></i>
                    @elseif($miReporte['porcentaje'] >= 70)
                        <i class="fa-solid fa-exclamation-triangle"></i>
                    @else
                        <i class="fa-solid fa-times-circle"></i>
                    @endif
                </div>
                
                <div>
                    <h3 class="estado-titulo">
                        @if($miReporte['porcentaje'] >= 80)
                            Estado: REGULAR
                        @elseif($miReporte['porcentaje'] >= 70)
                            Estado: EN RIESGO
                        @else
                            Estado: IRREGULAR
                        @endif
                    </h3>
                    <p class="estado-mensaje">
                        @if($miReporte['porcentaje'] >= 80)
                            ¡Excelente! Mantén tu buen rendimiento.
                        @elseif($miReporte['porcentaje'] >= 70)
                            Necesitas mejorar tu asistencia para mantener un buen rendimiento.
                        @else
                            Tu asistencia está por debajo del mínimo requerido. Es importante que mejores.
                        @endif
                    </p>
                </div>
            </section>

            <section>
                <h2 class="resumen-titulo">Detalle de Mi Asistencia</h2>
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
                            <tr class="fila-presentes">
                                <td class="concepto-presente"><strong>Presentes</strong></td>
                                <td class="cantidad-presente">{{ $miReporte['presentes'] }}</td>
                                <td>
                                    <div class="barra-progreso-container">
                                        <div class="barra-progreso barra-presente" 
                                             style="width: {{ $miReporte['total_dias'] > 0 ? ($miReporte['presentes'] / $miReporte['total_dias']) * 100 : 0 }}%;"></div>
                                    </div>
                                    <span class="porcentaje-texto">{{ $miReporte['total_dias'] > 0 ? round(($miReporte['presentes'] / $miReporte['total_dias']) * 100, 1) : 0 }}%</span>
                                </td>
                                <td class="estado-presente">✓ Excelente</td>
                            </tr>
                            
                            <tr class="fila-tardanzas">
                                <td class="concepto-tardanza"><strong>Tardanzas</strong></td>
                                <td class="cantidad-tardanza">{{ $miReporte['tardanzas'] }}</td>
                                <td>
                                    <div class="barra-progreso-container">
                                        <div class="barra-progreso barra-tardanza" 
                                             style="width: {{ $miReporte['total_dias'] > 0 ? ($miReporte['tardanzas'] / $miReporte['total_dias']) * 100 : 0 }}%;"></div>
                                    </div>
                                    <span class="porcentaje-texto">{{ $miReporte['total_dias'] > 0 ? round(($miReporte['tardanzas'] / $miReporte['total_dias']) * 100, 1) : 0 }}%</span>
                                </td>
                                <td class="estado-tardanza">
                                    @if($miReporte['tardanzas'] == 0)
                                        <span class="estado-perfecto">✓ Perfecto</span>
                                    @elseif($miReporte['tardanzas'] <= 3)
                                        <span class="estado-aceptable">⚠ Aceptable</span>
                                    @else
                                        <span class="estado-mejorar">⚠ Mejorar</span>
                                    @endif
                                </td>
                            </tr>
                            
                            <tr class="fila-justificadas">
                                <td class="concepto-justificada"><strong>Justificadas</strong></td>
                                <td class="cantidad-justificada">{{ $miReporte['justificadas'] }}</td>
                                <td>
                                    <div class="barra-progreso-container">
                                        <div class="barra-progreso barra-justificada" 
                                             style="width: {{ $miReporte['total_dias'] > 0 ? ($miReporte['justificadas'] / $miReporte['total_dias']) * 100 : 0 }}%;"></div>
                                    </div>
                                    <span class="porcentaje-texto">{{ $miReporte['total_dias'] > 0 ? round(($miReporte['justificadas'] / $miReporte['total_dias']) * 100, 1) : 0 }}%</span>
                                </td>
                                <td class="estado-justificada">J Justificada</td>
                            </tr>
                            
                            <tr class="fila-ausentes">
                                <td class="concepto-ausente"><strong>Ausentes</strong></td>
                                <td class="cantidad-ausente">{{ $miReporte['ausentes'] }}</td>
                                <td>
                                    <div class="barra-progreso-container">
                                        <div class="barra-progreso barra-ausente" 
                                             style="width: {{ $miReporte['total_dias'] > 0 ? ($miReporte['ausentes'] / $miReporte['total_dias']) * 100 : 0 }}%;"></div>
                                    </div>
                                    <span class="porcentaje-texto">{{ $miReporte['total_dias'] > 0 ? round(($miReporte['ausentes'] / $miReporte['total_dias']) * 100, 1) : 0 }}%</span>
                                </td>
                                <td class="estado-ausente">
                                    @if($miReporte['ausentes'] == 0)
                                        <span class="estado-perfecto">✓ Perfecto</span>
                                    @elseif($miReporte['ausentes'] <= 2)
                                        <span class="estado-cuidado">⚠ Cuidado</span>
                                    @else
                                        <span class="estado-critico">✗ Crítico</span>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>
        </div>

        @else
            <div class="contnotis">
                <div class="sin-datos">
                    <i class="fa-solid fa-exclamation-triangle sin-datos-icono"></i>
                    <strong class="sin-datos-titulo">No se encontraron registros de asistencia</strong>
                    <p class="sin-datos-texto">Aún no tienes registros de asistencia para esta materia.</p>
                </div>
            </div>
        @endif
    </div>

    <footer class="footer-info">
        <p>Reporte generado el {{ date('d/m/Y H:i') }}</p>
        <p class="leyenda"> ✓ Presente | ✗ Ausente | ⏰ Tardanza | J Justificada</p>
    </footer>
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