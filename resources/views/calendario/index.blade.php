<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Horarios</title>
    <link rel="icon" type="image/x-icon" href="/IMAGENES/LOGOTECNICA3.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href='https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap' rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('profesor/estilospaginico.css') }}">
    <link rel="stylesheet" href="{{ asset('profesor/responsive.css') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

    <!-- MENU REDUCAR -->
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

<main class="content">
<!-- /MENU REDUCAR -->

<!-- HEADER REDUCAR -->
<header>
    <div class="header-superior">
    <div class="titulo-izquierda">
        <span class="titulo-principal">Calendario</span>
    </div>
    
    <img src="/IMAGENES/LOGOTEC3.png" alt="Logo de la escuela" class="logo">
    
    </div>
    
    <div class="barras">
    <div class="barra-naranja"></div>
    <div class="barra-verde"></div>
    </div>
</header>
    
<!-- /HEADER REDUCAR -->
    
<!-- HORARIO REDUCAR -->
<div class="containerr">
    <h2>Horarios</h2>
    <div class="tabla-horario">
    <div class="semana-control">
        <button onclick="cambiarSemana(-1)">&larr;</button>
        <span id="mesSemana">SEPTIEMBRE</span>
        <button onclick="cambiarSemana(1)">&rarr;</button>
    </div>
    <table class="calendario-table">
        <thead>
            <tr class="fila-superior">
                <th>Turnos</th>
                @foreach($dias as $numerodia => $nombreDia)
                    <th id="dia{{ $numerodia }}">{{ $nombreDia }}<br> </th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            <!-- TURNO MAÑANA -->
            <tr class="fila-mañana">
                <td class="mañana">
                    <span>Mañana</span>
                </td>
                @foreach($dias as $numerodia => $nombreDia)
                    <td class="celda-mañana">
                        @if(isset($horariosPorDia[$numerodia]))
                            @php
                                $materiasMañana = $horariosPorDia[$numerodia]->filter(function($horario) {
                                    $horaInicio = substr($horario->hora_inicio, 0, 5);
                                    return $horaInicio >= '07:20' && $horaInicio <= '11:40';
                                })->sortBy('hora_inicio');
                            @endphp
                            
                            @if($materiasMañana->count() > 0)
                                @foreach($materiasMañana as $horario)
                                    <div class="materia-bloque mañana">
                                        <strong>{{ $horario->materia->nombre }}</strong><br>
                                        <small>{{ substr($horario->hora_inicio,0,5) }} - {{ substr($horario->hora_fin,0,5) }}</small>
                                    </div>
                                @endforeach
                            @else
                                <p> - </p>
                            @endif
                        @else
                            
                        @endif
                    </td>
                @endforeach
            </tr>

            <!-- TURNO TARDE -->
            <tr class="fila-tarde">
                <td class="tarde">
                    <span>Tarde</span>
                </td>
                @foreach($dias as $numerodia => $nombreDia)
                    <td class="celda-tarde">
                        @if(isset($horariosPorDia[$numerodia]))
                            @php
                                $materiasTarde = $horariosPorDia[$numerodia]->filter(function($horario) {
                                    $horaInicio = substr($horario->hora_inicio, 0, 5);
                                    return $horaInicio >= '12:30' && $horaInicio <= '17:20';
                                })->sortBy('hora_inicio');
                            @endphp
                            
                            @if($materiasTarde->count() > 0)
                                @foreach($materiasTarde as $horario)
                                    <div class="materia-bloque tarde">
                                        <strong>{{ $horario->materia->nombre }}</strong><br>
                                        <small>{{ substr($horario->hora_inicio,0,5) }} - {{ substr($horario->hora_fin,0,5) }}</small>
                                    </div>
                                @endforeach
                            @endif
                        @else
                            <p>Sin clases</p>
                        @endif
                    </td>
                @endforeach
            </tr>

            <!-- TURNO NOCHE -->
            <tr class="fila-noche">
                <td class="noche">
                    <span>Noche</span>
                </td>
                @foreach($dias as $numerodia => $nombreDia)
                    <td>
                        @if(isset($horariosPorDia[$numerodia]))
                            @php
                                $materiasNoche = $horariosPorDia[$numerodia]->filter(function($horario) {
                                    $horaInicio = substr($horario->hora_inicio, 0, 5);
                                    return $horaInicio >= '17:30' && $horaInicio <= '22:30';
                                })->sortBy('hora_inicio');
                            @endphp
                            
                            @if($materiasNoche->count() > 0)
                                @foreach($materiasNoche as $horario)
                                    <div class="materia-bloque noche">
                                        <strong>{{ $horario->materia->nombre }}</strong><br>
                                        <small>{{ substr($horario->hora_inicio,0,5) }} - {{ substr($horario->hora_fin,0,5) }}</small>
                                    </div>
                                @endforeach
                            @else
                                <p class="sin-clases">Sin clases</p>
                            @endif
                        @else
                            <p class="sin-clases">Sin clases</p>
                        @endif
                    </td>
                @endforeach
            </tr>
        </tbody>
    </table>
</div>

  <script>
    const dias = ["Lunes", "Martes", "Miércoles", "Jueves", "Viernes"];
let fechaBase = new Date(); // ahora arranca en HOY dinámicamente

function cambiarSemana(direccion) {
  // mover semanas según flechas
  fechaBase.setDate(fechaBase.getDate() + direccion * 7);

  for (let i = 0; i < 5; i++) {
    const nuevaFecha = new Date(fechaBase);
    nuevaFecha.setDate(fechaBase.getDate() + i);

    const dia = nuevaFecha.getDate();
    const id = "dia" + (i + 1);
    document.getElementById(id).innerHTML = dias[i] + "<br>" + dia;
  }

  const opciones = { month: 'long' };
  const mesNombre = fechaBase.toLocaleDateString('es-ES', opciones).toUpperCase();
  document.getElementById("mesSemana").innerText = mesNombre;
}

// inicializar al cargar
document.addEventListener("DOMContentLoaded", function() {
  cambiarSemana(0);
});

  </script>
<!-- /HORARIO REDUCAR -->

</main>
</body>
</html>