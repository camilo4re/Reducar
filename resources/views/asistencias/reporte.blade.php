<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Asistencias - {{ $materia->nombre }}</title>
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

    <div class="acciones" style="margin: 20px; text-align: center;">
        <a href="{{ route('asistencias.index', [$materia->id, 'year' => $year]) }}" class="boton">
            <i class="fa-solid fa-arrow-left"></i> Volver a Asistencias
        </a>
        <button onclick="window.print()" class="boton editar">
            <i class="fa-solid fa-print"></i> Imprimir
        </button>
        <button onclick="exportarExcel()" class="boton" style="background: linear-gradient(135deg, #10b981, #34d399);">
            <i class="fa-solid fa-file-excel"></i> Exportar Excel
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

        <div style="margin: 30px;">
            <h2 style="color: #007c00; margin-bottom: 20px; text-align: center;">Resumen General del Curso</h2>
            <ul class="clases" style="grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px;">
                <li class="cajas" style="background: linear-gradient(135deg, #3b82f6, #60a5fa); color: white;">
                    <div style="padding: 20px; text-align: center; height: auto;">
                        <div style="font-size: 36px; font-weight: bold; margin-bottom: 5px;">{{ $totalAlumnos }}</div>
                        <div style="font-size: 16px;">Total Alumnos</div>
                    </div>
                </li>
                <li class="cajas" style="background: linear-gradient(135deg, #10b981, #34d399); color: white;">
                    <div style="padding: 20px; text-align: center; height: auto;">
                        <div style="font-size: 36px; font-weight: bold; margin-bottom: 5px;">{{ $alumnosRegulares }}</div>
                        <div style="font-size: 16px;">Regulares (≥80%)</div>
                    </div>
                </li>
                <li class="cajas" style="background: linear-gradient(135deg, #f59e0b, #fbbf24); color: white;">
                    <div style="padding: 20px; text-align: center; height: auto;">
                        <div style="font-size: 36px; font-weight: bold; margin-bottom: 5px;">{{ $alumnosEnRiesgo }}</div>
                        <div style="font-size: 16px;">En Riesgo (70-79%)</div>
                    </div>
                </li>
                <li class="cajas" style="background: linear-gradient(135deg, #ef4444, #f87171); color: white;">
                    <div style="padding: 20px; text-align: center; height: auto;">
                        <div style="font-size: 36px; font-weight: bold; margin-bottom: 5px;">{{ $alumnosIrregulares }}</div>
                        <div style="font-size: 16px;">Irregulares (<70%)</div>
                    </div>
                </li>
                <li class="cajas" style="background: linear-gradient(135deg, #8b5cf6, #a78bfa); color: white;">
                    <div style="padding: 20px; text-align: center; height: auto;">
                        <div style="font-size: 36px; font-weight: bold; margin-bottom: 5px;">{{ round($promedioGeneral, 1) }}%</div>
                        <div style="font-size: 16px;">Promedio General</div>
                    </div>
                </li>
            </ul>
        </div>


        <!-- Tabla de Alumnos -->
        <div class="tabla-container">
            <h2>Listado Detallado de Alumnos</h2>
            <div class="tabla-asistencias">
                <table id="tablaAlumnos">
                    <thead>
                        <tr>
                            <th style="cursor: pointer;" onclick="ordenarTabla('nombre')">
                                Alumno <i class="fa-solid fa-sort"></i>
                            </th>
                            <th style="cursor: pointer;" onclick="ordenarTabla('porcentaje')">
                                % Asistencia <i class="fa-solid fa-sort"></i>
                            </th>
                            <th>Estado</th>
                            <th style="cursor: pointer;" onclick="ordenarTabla('presentes')">
                                Presentes <i class="fa-solid fa-sort"></i>
                            </th>
                            <th style="cursor: pointer;" onclick="ordenarTabla('ausentes')">
                                Faltas <i class="fa-solid fa-sort"></i>
                            </th>
                            <th style="cursor: pointer;" onclick="ordenarTabla('tardanzas')">
                                Tardanzas <i class="fa-solid fa-sort"></i>
                            </th>
                            <th style="cursor: pointer;" onclick="ordenarTabla('justificadas')">
                                Justificadas <i class="fa-solid fa-sort"></i>
                            </th>
                            <th>Total Clases</th>
                            <th>Progreso Visual</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reportes as $reporte)
                        <tr class="fila-alumno" data-nombre="{{ strtolower($reporte['alumno']->name) }}" data-porcentaje="{{ $reporte['porcentaje'] }}">
                            <td style="font-weight: 600; color: #374151;">
                                {{ $reporte['alumno']->name }}
                            </td>
                            <td style="font-weight: bold; font-size: 18px; 
                                @if($reporte['porcentaje'] >= 80) color: #10b981;
                                @elseif($reporte['porcentaje'] >= 70) color: #f59e0b;
                                @else color: #ef4444; @endif">
                                {{ $reporte['porcentaje'] }}%
                            </td>
                            <td>
                                @if($reporte['porcentaje'] >= 80)
                                    <span style="background: #10b981; color: white; padding: 4px 8px; border-radius: 12px; font-size: 12px; font-weight: 600;">
                                        ✓ REGULAR
                                    </span>
                                @elseif($reporte['porcentaje'] >= 70)
                                    <span style="background: #f59e0b; color: white; padding: 4px 8px; border-radius: 12px; font-size: 12px; font-weight: 600;">
                                        ⚠ RIESGO
                                    </span>
                                @else
                                    <span style="background: #ef4444; color: white; padding: 4px 8px; border-radius: 12px; font-size: 12px; font-weight: 600;">
                                        ✗ IRREGULAR
                                    </span>
                                @endif
                            </td>
                            <td style="color: #10b981; font-weight: bold; text-align: center;">
                                {{ $reporte['presentes'] }}
                            </td>
                            <td style="color: #ef4444; font-weight: bold; text-align: center;">
                                {{ $reporte['ausentes'] }}
                            </td>
                            <td style="color: #f59e0b; font-weight: bold; text-align: center;">
                                {{ $reporte['tardanzas'] }}
                            </td>
                            <td style="color: #3b82f6; font-weight: bold; text-align: center;">
                                {{ $reporte['justificadas'] }}
                            </td>
                            <td style="text-align: center; font-weight: 600;">
                                {{ $reporte['total_dias'] }}
                            </td>
                            <td style="width: 150px;">
                                <div style="background: #e5e7eb; border-radius: 10px; height: 20px; position: relative; overflow: hidden;">
                                    <div style="height: 100%; border-radius: 10px; width: {{ $reporte['porcentaje'] }}%; 
                                        @if($reporte['porcentaje'] >= 80) background: linear-gradient(90deg, #10b981, #34d399);
                                        @elseif($reporte['porcentaje'] >= 70) background: linear-gradient(90deg, #f59e0b, #fbbf24);
                                        @else background: linear-gradient(90deg, #ef4444, #f87171); @endif
                                        transition: width 0.3s ease;"></div>
                                    <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; display: flex; align-items: center; justify-content: center; font-size: 11px; font-weight: 600; color: #374151;">
                                        {{ $reporte['porcentaje'] }}%
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Gráfico de Distribución -->
        <div style="margin: 30px;">
            <div class="horario-container">
                <div class="tabla-horario">
                    <h2 style="color: #007c00; margin-bottom: 20px;">Distribución por Estado</h2>
                    
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px;">
                        <div style="padding: 20px; background: linear-gradient(135deg, #10b981, #34d399); border-radius: 15px; color: white;">
                            <h3 style="margin: 0 0 10px 0;">Alumnos Regulares</h3>
                            <div style="font-size: 32px; font-weight: bold;">{{ $alumnosRegulares }}/{{ $totalAlumnos }}</div>
                            <div style="opacity: 0.9;">{{ $totalAlumnos > 0 ? round(($alumnosRegulares / $totalAlumnos) * 100, 1) : 0 }}% del curso</div>
                        </div>
                        
                        <div style="padding: 20px; background: linear-gradient(135deg, #f59e0b, #fbbf24); border-radius: 15px; color: white;">
                            <h3 style="margin: 0 0 10px 0;">Alumnos en Riesgo</h3>
                            <div style="font-size: 32px; font-weight: bold;">{{ $alumnosEnRiesgo }}/{{ $totalAlumnos }}</div>
                            <div style="opacity: 0.9;">{{ $totalAlumnos > 0 ? round(($alumnosEnRiesgo / $totalAlumnos) * 100, 1) : 0 }}% del curso</div>
                        </div>
                        
                        <div style="padding: 20px; background: linear-gradient(135deg, #ef4444, #f87171); border-radius: 15px; color: white;">
                            <h3 style="margin: 0 0 10px 0;">Alumnos Irregulares</h3>
                            <div style="font-size: 32px; font-weight: bold;">{{ $alumnosIrregulares }}/{{ $totalAlumnos }}</div>
                            <div style="opacity: 0.9;">{{ $totalAlumnos > 0 ? round(($alumnosIrregulares / $totalAlumnos) * 100, 1) : 0 }}% del curso</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @else
        <div style="margin: 50px;">
            <div class="contnotis">
                <div class="notis" style="text-align: center; padding: 40px; background: #f8f9fa;">
                    <i class="fa-solid fa-users-slash" style="font-size: 48px; color: #6b7280; margin-bottom: 20px;"></i>
                    <strong style="color: #374151; font-size: 20px;">No hay registros de asistencia</strong>
                    <p style="color: #6b7280; margin-top: 10px;">Aún no existen registros de asistencia para este período.</p>
                </div>
            </div>
        </div>
    @endif

    <div style="margin: 20px; font-size: 12px; color: #666; text-align: center;">
        <p>Reporte generado el {{ date('d/m/Y H:i') }} por {{ auth()->user()->name }}</p>
        <p><strong>Leyenda:</strong> Regular ≥80% | En Riesgo 70-79% | Irregular <70%</p>
    </div>

</main>

<script>
// Variables globales
let ordenAscendente = true;
let datosOriginales = [];

// Inicialización
document.addEventListener('DOMContentLoaded', function() {
    // Guardar datos originales para filtros
    const filas = document.querySelectorAll('.fila-alumno');
    filas.forEach(fila => {
        datosOriginales.push({
            elemento: fila,
            nombre: fila.dataset.nombre,
            porcentaje: parseFloat(fila.dataset.porcentaje)
        });
    });
});

// Menú lateral
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

// Búsqueda de alumnos
document.getElementById('buscarAlumno').addEventListener('input', function() {
    filtrarTabla();
});

// Filtro por estado
document.getElementById('filtrarEstado').addEventListener('change', function() {
    filtrarTabla();
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
    
    // Reorganizar las filas
    filas.forEach(fila => tbody.appendChild(fila));
    
    // Cambiar orden para próxima vez
    ordenAscendente = !ordenAscendente;
}

function exportarExcel() {
    // Esta función requeriría una implementación más compleja en el backend
    alert('Funcionalidad de exportación en desarrollo');
}
</script>

</body>
</html>