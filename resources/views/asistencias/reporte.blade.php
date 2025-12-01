<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Asistencias - {{ $materia->nombre }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=5.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="/IMAGENES/LOGOTECNICA3.png"/>
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
        <a href="#" 
          onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
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
                <span class="titulo-principal">{{ $materia->nombre }} - Reporte de Asistencias</span>
                <span class="subtitulo">{{ $materia->curso->año }} {{ $materia->curso->division }} - 
                    @if(isset($month))
                        {{ DateTime::createFromFormat('!m', $month)->format('F') }} {{ $year }}
                   @else
                        Año {{ $year }}
                    @endif
                </span>
            </div>
            <img src="/IMAGENES/LOGOTEC3.png" alt="Logo de la escuela" class="logo">
        </div>
        <div class="barras">
            <div class="barra-naranja"></div>
            <div class="barra-verde"></div>
        </div>
    </header>

    <!-- NAV NUEVO -->
    <nav class="header-centro">
        <div class="icono-header" data-tooltip="Notificaciones">
            <a href="{{ route('materias.show', $materia->id) }}"><i class="fa-solid fa-table-columns"></i></a>
        </div>
        <div class="icono-header" data-tooltip="Promedios">
            <a href="{{ route('notas.promedios', $materia->id) }}"><i class="fa-solid fa-users"></i></a>
        </div>
        <div class="icono-header" data-tooltip="Calificaciones">
            <a href="{{ route('notas.index', $materia->id) }}"><i class="fa-solid fa-clipboard-list"></i></a>
        </div>
        <div class="icono-header active" data-tooltip="Asistencias">
            <a href="{{ route('asistencias.index', $materia->id) }}"><i class="fa-solid fa-calendar-check"></i></a>
        </div>
    </nav>
    <!-- /NAV NUEVO -->

    <!-- REPORTE DE ASISTENCIAS -->
    <div class="containerr">
        <div class="accioness">
        <a href="{{ route('asistencias.index', [$materia->id, 'year' => $year]) }}" class="boton">
            <i class="fa-solid fa-arrow-left"></i> Volver a Asistencias
        </a>
        <h2>Asistencias</h2>
        <button onclick="window.print()" class="boton editar">
            <i class="fa-solid fa-print"></i> Imprimir
        </button>
    </div>

        @if(count($reportes) > 0)
         <!-- Resumen General -->
            @php
                $totalAlumnos = count($reportes);
                $alumnosRegulares = collect($reportes)->where('porcentaje', '>=', 80)->count();
                $alumnosEnRiesgo = collect($reportes)->whereBetween('porcentaje', [70, 79.9])->count();
                $alumnosIrregulares = collect($reportes)->where('porcentaje', '<', 70)->count();
                $promedioGeneral = collect($reportes)->avg('porcentaje');
            @endphp

            <div class="contnotis">
                <div class="resumen-general">
                    <h2 class="resumen-titulo">Resumen General del Curso</h2>

                    <ul class="resumen-grid">
                        <li class="cajas stat-card stat-total">
                            <div class="stat-content">
                                <div class="stat-number">{{ $totalAlumnos }}</div>
                                <div class="stat-label">Total Alumnos</div>
                            </div>
                        </li>
                        <li class="cajass stat-card regulares">
                            <div class="stat-content">
                                <div class="stat-number">{{ $alumnosRegulares }}</div>
                                <div class="stat-label">Regulares</div>
                                <i class="fa-solid fa-check"></i>
                            </div>
                        </li>
                        <li class="cajass stat-card riesgo">
                            <div class="stat-content">
                             <div class="stat-number">{{ $alumnosEnRiesgo }}</div>
                                <div class="stat-label">En Riesgo </div>
                                <i class="fa-solid fa-exclamation"></i>
                            </div>
                        </li>
                        <li class="cajass stat-card irregulares">
                            <div class="stat-content">
                                <div class="stat-number">{{ $alumnosIrregulares }}</div>
                                <div class="stat-label">Irregulares </div>
                                <i class="fa-solid fa-times"></i>
                            </div>
                        </li>
                        <li class="cajas stat-card stat-promedio">
                            <div class="stat-content">
                                <div class="stat-number">{{ round($promedioGeneral, 1) }}%</div>
                                <div class="stat-label">Promedio General</div>
                            </div>
                        </li>
                    </ul>
             </div>

                <!-- Tabla de Alumnos -->
                <h2 class="resumen-titulo">Listado Detallado de Alumnos</h2>
                <div class="tabla-asistencias">
                    <table id="tablaAlumnos">
                        <thead>
                            <tr>
                                    <th class="sortable" onclick="ordenarTabla('nombre')">
                                        Alumno <i class="fa-solid fa-sort"></i>
                                    </th>
                                    <th class="sortable" onclick="ordenarTabla('porcentaje')">
                                        % Asistencia <i class="fa-solid fa-sort"></i>
                                    </th>
                                    <th>Estado</th>
                                    <th class="sortable" onclick="ordenarTabla('presentes')">
                                        Presentes <i class="fa-solid fa-sort"></i>
                                    </th>
                                    <th class="sortable" onclick="ordenarTabla('ausentes')">
                                        Faltas <i class="fa-solid fa-sort"></i>
                                    </th>
                                    <th class="sortable" onclick="ordenarTabla('tardanzas')">
                                     Tardanzas <i class="fa-solid fa-sort"></i>
                                    </th>
                                    <th class="sortable" onclick="ordenarTabla('justificadas')">
                                        Justificadas <i class="fa-solid fa-sort"></i>
                                    </th>
                                    <th>Total Clases</th>
                                    <th>Progreso Visual</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($reportes as $reporte)
                                <tr class="fila-alumno" data-nombre="{{ strtolower($reporte['alumno']->name) }}" data-porcentaje="{{ $reporte['porcentaje'] }}">
                                    <td class="alumno-nombre">
                                        {{ $reporte['alumno']->name }}
                                    </td>
                                    <td class="porcentaje-asistencia 
                                        @if($reporte['porcentaje'] >= 80) porcentaje-regular
                                        @elseif($reporte['porcentaje'] >= 70) porcentaje-riesgo
                                        @else porcentaje-irregular @endif">
                                        {{ $reporte['porcentaje'] }}%
                                    </td>
                                    <td>
                                        @if($reporte['porcentaje'] >= 80)
                                         <span class="estado-badge estado-regular">
                                                REGULAR
                                            </span>
                                        @elseif($reporte['porcentaje'] >= 70)
                                            <span class="estado-badge estado-riesgo">
                                                RIESGO
                                            </span>
                                        @else
                                            <span class="estado-badge estado-irregular">
                                                IRREGULAR
                                            </span>
                                        @endif
                                    </td>
                                    <td class="numero-presentes">
                                        {{ $reporte['presentes'] }}
                                    </td>
                                    <td class="numero-ausentes">
                                        {{ $reporte['ausentes'] }}
                                    </td>
                                    <td class="numero-tardanzas">
                                        {{ $reporte['tardanzas'] }}
                                    </td>
                                    <td class="numero-justificadas">
                                        {{ $reporte['justificadas'] }}
                                    </td>
                                 <td class="total-clases">
                                        {{ $reporte['total_dias'] }}
                                    </td>
                                    <td class="progreso-visual">
                                        <div class="progreso-container">
                                            <div class="progreso-barra 
                                                @if($reporte['porcentaje'] >= 80) progreso-regular
                                                @elseif($reporte['porcentaje'] >= 70) progreso-riesgo
                                                @else progreso-irregular @endif"
                                                data-porcentaje="{{ $reporte['porcentaje'] }}"></div>
                                            <div class="progreso-texto">
                                                {{ $reporte['porcentaje'] }}%
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </section>

                <section class="distribucion-container">
                    <h2 class="resumen-titulo">Estadísticas por Estado</h2>
                    <div class="reporte">
                     <div class="distribucion-grid">
                            <article class="distribucion-card distribucion-regulares">
                                <h3>Alumnos Regulares</h3>
                                <p class="distribucion-numero">{{ $alumnosRegulares }}/{{ $totalAlumnos }}</p>
                                <p>{{ $totalAlumnos > 0 ? round(($alumnosRegulares / $totalAlumnos) * 100, 1) : 0 }}% del curso</p>
                            </article>
                            
                            <article class="distribucion-card distribucion-riesgo">
                                <h3>Alumnos en Riesgo</h3>
                                <p class="distribucion-numero">{{ $alumnosEnRiesgo }}/{{ $totalAlumnos }}</p>
                                <p>{{ $totalAlumnos > 0 ? round(($alumnosEnRiesgo / $totalAlumnos) * 100, 1) : 0 }}% del curso</p>
                            </article>
                            
                            <article class="distribucion-card distribucion-irregulares">
                                <h3>Alumnos Irregulares</h3>
                                <p class="distribucion-numero">{{ $alumnosIrregulares }}/{{ $totalAlumnos }}</p>
                                <p>{{ $totalAlumnos > 0 ? round(($alumnosIrregulares / $totalAlumnos) * 100, 1) : 0 }}% del curso</p>
                            </article>
                        </div>
                 </div>
                </section>
            </div>

        @else
            <div class="contnotis">
                <div class="sin-datos">
                    <i class="fa-solid fa-users-slash sin-datos-icono"></i>
                    <strong class="sin-datos-titulo">No hay registros de asistencia</strong>
                    <p class="sin-datos-texto">Aún no existen registros de asistencia para este período.</p>
                </div>
            </div>
        @endif
    </div>

    <footer class="footer-info">
      <p>Reporte generado el {{ date('d/m/Y H:i') }} por {{ auth()->user()->name }}</p>
        <p class="leyenda">Regular ≥80% | En Riesgo 70-79% | Irregular menor a 70%</p>
    </footer>
</main>

<script>
let ordenAscendente = true;

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

function ordenarTabla(campo) {
    const tbody = document.querySelector('#tablaAlumnos tbody');
    const filas = Array.from(document.querySelectorAll('.fila-alumno'));
    
    filas.sort((a, b) => {
        let valorA, valorB;
        
        switch(campo) {
            case 'nombre':
                valorA = a.dataset.nombre;
                valorB = b.dataset.nombre;
                break;
            case 'porcentaje':
                valorA = parseFloat(a.dataset.porcentaje);
                valorB = parseFloat(b.dataset.porcentaje);
                break;
            case 'presentes':
                valorA = parseInt(a.children[3].textContent);
                valorB = parseInt(b.children[3].textContent);
                break;
            case 'ausentes':
                valorA = parseInt(a.children[4].textContent);
                valorB = parseInt(b.children[4].textContent);
                break;
            case 'tardanzas':
                valorA = parseInt(a.children[5].textContent);
               valorB = parseInt(b.children[5].textContent);
                break;
            case 'justificadas':
                valorA = parseInt(a.children[6].textContent);
                valorB = parseInt(b.children[6].textContent);
                break;
            default:
                return 0;
        }
        
        if (typeof valorA === 'string') {
            return ordenAscendente ? valorA.localeCompare(valorB) : valorB.localeCompare(valorA);
        } else {
            return ordenAscendente ? valorA - valorB : valorB - valorA;
        }
    });
    
    filas.forEach(fila => tbody.appendChild(fila));
    ordenAscendente = !ordenAscendente;
}
</script>

</body>
</html>