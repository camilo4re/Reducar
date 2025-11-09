<<<<<<< HEAD

=======
>>>>>>> FRONTEND
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
<<<<<<< HEAD
    <title>Asistencias - {{ $materia->nombre }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href='https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap' rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('profesor/estilospaginico.css') }}">
=======
    <title>Asistencias</title>
    <link rel="icon" type="image/x-icon" href="/IMAGENES/LOGOTECNICA3.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href='https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap' rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('profesor/estilospaginico.css') }}">
    <link rel="stylesheet" href="{{ asset('profesor/responsive.css') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
>>>>>>> FRONTEND
</head>
<body>

<button id="abrirMenu">☰</button>
<<<<<<< HEAD
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
=======

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
>>>>>>> FRONTEND
    </ul>
</nav>

<main class="content">
    <header>
        <div class="header-superior">
            <div class="titulo-izquierda">
<<<<<<< HEAD
                <span class="titulo-principal">{{ $materia->nombre }} - Asistencias</span>
=======
                <span class="titulo-principal">{{ $materia->nombre }}</span>
>>>>>>> FRONTEND
                <span class="subtitulo">{{ $materia->curso->año }} {{ $materia->curso->division }}</span>
            </div>
            <img src="/IMAGENES/LOGOTEC3.png" alt="Logo de la escuela" class="logo">
        </div>
        <div class="barras">
            <div class="barra-naranja"></div>
            <div class="barra-verde"></div>
        </div>
    </header>

<<<<<<< HEAD
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
<div class="containerr">
    <h2>Asistencias</h2>
    <div class="contnotis">
    <div class="filtro-cursos deasistencia">
    <form method="GET" action="{{ route('asistencias.index', $materia->id) }}">
        <label for="month">Mes:     </label>
        <select name="month" id="month" onchange="this.form.submit()">
            @php
                $meses = [
                    1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril',
                    5 => 'Mayo', 6 => 'Junio', 7 => 'Julio', 8 => 'Agosto',
                    9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre'//traduccion al español paaa
                ];
            @endphp
            @foreach($meses as $numero => $nombre)
                <option value="{{ $numero }}" {{ $month == $numero ? 'selected' : '' }}>
                    {{ $nombre }}
                </option>
            @endforeach
        </select>
        <a href="{{ route('asistencias.reporte', [$materia->id, 'year' => $year, 'month' => $month]) }}" class="boton"> Ver Reporte</a>
    </form>
</div>

    @if(auth()->user()->role === 'profesor' || auth()->user()->role === 'directivo')
    <div class="tabla-container deasistencia">
        <div class="tabla-asistencias ">
            <table>
                <thead>
                    <tr>
                        <th>Alumno</th>
                        @foreach($fechas as $fecha)
                            <th>{{ date('d', strtotime($fecha)) }}</th>
                        @endforeach
                        <th>%</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($asistencias as $userId => $data)
                        <tr>
                            <td><strong>{{ $data['alumno']->name }}</strong></td>
                            @foreach($fechas as $fecha)
                                <td class="asistencia-celda" 
                                    data-user="{{ $userId }}" 
                                    data-fecha="{{ $fecha }}" 
                                    data-estado="{{ $data['asistencias'][$fecha] ?? '' }}"
                                    onclick="mostrarPopover(this)">
                                    @if(isset($data['asistencias'][$fecha]) && $data['asistencias'][$fecha])
                                        @switch($data['asistencias'][$fecha])
                                            @case('presente')
                                                <span style="color: #007c00;"><i class="fas fa-check"></i></span>
                                                @break
                                            @case('ausente')
                                                <span style="color: #d32f2f;"><i class="fas fa-times"></i></span>
                                                @break
                                            @case('tardanza')
                                                <span style="color: #f39c12;"><i class="fas fa-clock"></i></span>
                                                @break
                                            @case('justificada')
                                                <span style="color: #2196f3;"><i class="fas fa-clipboard-check"></i></span>
                                                @break
                                        @endswitch
                                    @else
                                        <span style="color: #ccc;">-</span>
                                    @endif
                                </td>
                            @endforeach
                            <td>
                                <div class="barra-asistencia" style="width: {{ $data['porcentaje'] }}%"></div>
                                {{ $data['porcentaje'] }}%
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div id="popover" class="popover hidden">
        <button onclick="marcarAsistencia('presente')"> Presente <i class="fas fa-check"></i></button>
        <button onclick="marcarAsistencia('ausente')"> Ausente <i class="fas fa-times"></i></button>
        <button onclick="marcarAsistencia('tardanza')"> Tardanza <i class="fas fa-clock"></i></button>
        <button onclick="marcarAsistencia('justificada')"> Justificada <i class="fas fa-clipboard-check"></i></button>
        <button onclick="eliminarAsistencia()"> Limpiar <i class="fas fa-trash"></i></button>
    </div>
@endif
    @if (auth()->user()->role === 'alumno')

        <div class="tabla-container ">
            <h2>Mis Asistencias</h2>
            <div class="tabla-asistencias ">
                @php 
                    $miAsistencia = null;
                    foreach($asistencias as $data) {
                        if($data['user_id'] == auth()->id()) {
                            $miAsistencia = $data;
                            break;
                        }
                    }
                @endphp
                @if($miAsistencia)
                    <table>
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($fechas as $fecha)
                                @if($miAsistencia['asistencias'][$fecha])
                                <tr>
                                    <td>{{ date('d/m/Y', strtotime($fecha)) }}</td>
                                    <td>
                                        @switch($miAsistencia['asistencias'][$fecha])
                                            @case('presente')
                                                <span style="color: #007c00;"><i class="fas fa-check"></i> Presente</span>
                                                @break
                                            @case('ausente')
                                                <span style="color: #d32f2f;"><i class="fas fa-times"></i> Ausente</span>
                                                @break
                                            @case('tardanza')
                                                <span style="color: #f39c12;"><i class="fas fa-clock"></i> Tardanza</span>
                                                @break
                                            @case('justificada')
                                                <span style="color: #2196f3;"><i class="fas fa-clipboard-check"></i> Justificada</span>
                                                @break
                                        @endswitch
                                    </td>
                                </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                    <p><strong>Porcentaje de asistencia:</strong> {{ $miAsistencia['porcentaje'] }}%</p>
                @else
                    <p>No tienes registros de asistencia aún.</p>
                @endif
            </div>
        </div>
    @endif
    </div>
=======
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

    <div class="containerr">
        <h2>Asistencias</h2>
        <div class="contnotis">
            <div class="deasistencia">
                <form class="filtro-cursos" method="GET" action="{{ route('asistencias.index', $materia->id) }}">
                    <label for="month"><strong>Mes:</strong></label>
                    <select class="filtro-cursos" name="month" id="month" onchange="this.form.submit()">
                        @php
                            $meses = [
                                3 => 'Marzo', 4 => 'Abril', 5 => 'Mayo', 6 => 'Junio', 
                                7 => 'Julio', 8 => 'Agosto', 9 => 'Septiembre', 
                                10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre'
                            ];
                        @endphp
                        @foreach($meses as $numero => $nombre)
                            <option value="{{ $numero }}" {{ $month == $numero ? 'selected' : '' }}>
                                {{ $nombre }}
                            </option>
                        @endforeach
                    </select>
                </form>
                <a href="{{ route('asistencias.reporte', [$materia->id, 'year' => $year, 'month' => $month]) }}" class="boton">Ver Reporte</a>
            </div>

            @if(auth()->user()->role === 'profesor' || auth()->user()->role === 'directivo')
            <div class="tabla-asistencias">
                <table>
                    <thead>
                        <tr>
                            <th>Alumno</th>
                            @foreach($fechas as $fecha)
                                <th>{{ date('d', strtotime($fecha)) }}</th>
                            @endforeach
                            <th>%</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($asistencias as $userId => $data)
                            <tr>
                                <td><strong>{{ $data['alumno']->name }}</strong></td>
                                @foreach($fechas as $fecha)
                                    <td class="asistencia-celda" 
                                        data-user="{{ $userId }}" 
                                        data-fecha="{{ $fecha }}" 
                                        data-estado="{{ $data['asistencias'][$fecha] ?? '' }}"
                                        onclick="mostrarPopover(this)">
                                        @if(isset($data['asistencias'][$fecha]) && $data['asistencias'][$fecha])
                                            @switch($data['asistencias'][$fecha])
                                                @case('presente')
                                                    <span style="color: #007c00;"><i class="fas fa-check"></i></span>
                                                    @break
                                                @case('ausente')
                                                    <span style="color: #d32f2f;"><i class="fas fa-times"></i></span>
                                                    @break
                                                @case('tardanza')
                                                    <span style="color: #f39c12;"><i class="fas fa-clock"></i></span>
                                                    @break
                                                @case('justificada')
                                                    <span style="color: #2196f3;"><i class="fas fa-clipboard-check"></i></span>
                                                    @break
                                            @endswitch
                                        @else
                                            <span style="color: #ccc;">-</span>
                                        @endif
                                    </td>
                                @endforeach
                                <td>
                                    <div class="barra-asistencia" style="max-width: 72%; width: {{ $data['porcentaje'] }}%"></div>
                                    {{ $data['porcentaje'] }}%
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div id="popover" class="popover hidden">
                <button onclick="marcarAsistencia('presente')">Presente <i class="fas fa-check"></i></button>
                <button onclick="marcarAsistencia('ausente')">Ausente <i class="fas fa-times"></i></button>
                <button onclick="marcarAsistencia('tardanza')">Tardanza <i class="fas fa-clock"></i></button>
                <button onclick="marcarAsistencia('justificada')">Justificada <i class="fas fa-clipboard-check"></i></button>
                <button onclick="eliminarAsistencia()">Limpiar <i class="fas fa-trash"></i></button>
            </div>
            @endif

            @if (auth()->user()->role === 'alumno')
            <section>
                <h2>Mis Asistencias</h2>
                <div class="tabla-asistencias">
                    @php 
                        $miAsistencia = null;
                        foreach($asistencias as $data) {
                            if($data['user_id'] == auth()->id()) {
                                $miAsistencia = $data;
                                break;
                            }
                        }
                    @endphp
                    @if($miAsistencia)
                        <table>
                            <thead>
                                <tr>
                                    <th>Fecha</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($fechas as $fecha)
                                    @if($miAsistencia['asistencias'][$fecha])
                                    <tr>
                                        <td>{{ date('d/m/Y', strtotime($fecha)) }}</td>
                                        <td>
                                            @switch($miAsistencia['asistencias'][$fecha])
                                                @case('presente')
                                                    <span style="color: #007c00;"><i class="fas fa-check"></i> Presente</span>
                                                    @break
                                                @case('ausente')
                                                    <span style="color: #d32f2f;"><i class="fas fa-times"></i> Ausente</span>
                                                    @break
                                                @case('tardanza')
                                                    <span style="color: #f39c12;"><i class="fas fa-clock"></i> Tardanza</span>
                                                    @break
                                                @case('justificada')
                                                    <span style="color: #2196f3;"><i class="fas fa-clipboard-check"></i> Justificada</span>
                                                    @break
                                            @endswitch
                                        </td>
                                    </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                        <p><strong>Porcentaje de asistencia:</strong> {{ $miAsistencia['porcentaje'] }}%</p>
                    @else
                        <p>No tienes registros de asistencia aún.</p>
                    @endif
                </div>
            </section>
            @endif
        </div>
>>>>>>> FRONTEND
    </div>
</main>

<script>
let celdaActual = null;

function mostrarPopover(celda) {
    if ({{ auth()->user()->role === 'alumno' ? 'true' : 'false' }}) return;
    
    celdaActual = celda;
    const popover = document.getElementById('popover');
<<<<<<< HEAD
    
    const rect = celda.getBoundingClientRect();
    popover.style.left = (rect.left + window.scrollX) + 'px';
    popover.style.top = (rect.top + window.scrollY - 120) + 'px';
    
=======
    const rect = celda.getBoundingClientRect();
    
    popover.style.left = (rect.left + window.scrollX) + 'px';
    popover.style.top = (rect.top + window.scrollY - 120) + 'px';
>>>>>>> FRONTEND
    popover.classList.remove('hidden');
}

function marcarAsistencia(estado) {
    if (!celdaActual) return;
    
<<<<<<< HEAD
    const userId = celdaActual.dataset.user;
    const fecha = celdaActual.dataset.fecha;
    
=======
>>>>>>> FRONTEND
    fetch('{{ route("asistencias.marcar", $materia->id) }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
<<<<<<< HEAD
            user_id: userId,
            fecha: fecha,
=======
            user_id: celdaActual.dataset.user,
            fecha: celdaActual.dataset.fecha,
>>>>>>> FRONTEND
            estado: estado
        })
    })
    .then(response => response.json())
    .then(data => {
<<<<<<< HEAD
        if (data.success) {
            location.reload();
        }
=======
        if (data.success) location.reload();
>>>>>>> FRONTEND
    })
    .catch(error => console.error('Error:', error));
    
    document.getElementById('popover').classList.add('hidden');
}

function eliminarAsistencia() {
    if (!celdaActual) return;
    
<<<<<<< HEAD
    const userId = celdaActual.dataset.user;
    const fecha = celdaActual.dataset.fecha;
    
=======
>>>>>>> FRONTEND
    fetch('{{ route("asistencias.eliminar", $materia->id) }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
<<<<<<< HEAD
            user_id: userId,
            fecha: fecha
=======
            user_id: celdaActual.dataset.user,
            fecha: celdaActual.dataset.fecha
>>>>>>> FRONTEND
        })
    })
    .then(response => response.json())
    .then(data => {
<<<<<<< HEAD
        if (data.success) {
            location.reload();
        }
=======
        if (data.success) location.reload();
>>>>>>> FRONTEND
    })
    .catch(error => console.error('Error:', error));
    
    document.getElementById('popover').classList.add('hidden');
}

document.addEventListener('click', function(e) {
    if (!e.target.closest('.asistencia-celda') && !e.target.closest('#popover')) {
        document.getElementById('popover').classList.add('hidden');
    }
});

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