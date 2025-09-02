<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Materia 1 (Profesor)</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href='https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap' rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('profesor/estilospaginico.css') }}">
</head>
<body>

  <!-- MENU REDUCAR -->
<button id="abrirMenu">☰</button>

    <nav id="menuLateral" class="cerrado">
    <button id="cerrarMenu">×</button>
    
    <ul>
    <li><a href="{{ route ('materias.index')}}">Inicio <i class="fa-solid fa-house"></i></a></li>
    <li><a href="nuevohorario.html">Horarios <i class="fa-solid fa-calendar"></i></a></li>
    <!-- <li><a href="asistencias.html">Asistencias <i class="fa-solid fa-user-check"></i></a></li> -->
     <!--<li><a href="#">Notificaciones <i class="fa-solid fa-bell"></i></a></li>-->
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
      <span class="titulo-principal">{{ $materia->nombre }}</span>
      <span class="subtitulo"> {{ $materia->curso->año }} {{ $materia->curso->division }}</span> 
    </div>

    <img src="/IMAGENES/LOGOTEC3.png" alt="Logo de la escuela" class="logo">

  </div>

  <div class="barras">
    <div class="barra-naranja"></div>
    <div class="barra-verde"></div>
  </div>
</header>

<!-- /HEADER REDUCAR -->

<!-- NAV NUEVO -->
<nav class="header-centro">
  <div class="icono-header active" data-tooltip="Notificaciones">
    <i class="fa-solid fa-table-columns"></i>
  </div>
  <div class="icono-header" data-tooltip="Personas">
    <i class="fa-solid fa-users"></i>
  </div>
  <div class="icono-header" data-tooltip="Calificaciones">
    <a href="{{ route('notas.index', $materia->id) }}"><i class="fa-solid fa-clipboard-list"></i></a>
  </div>
  <div class="icono-header" data-tooltip="Asistencias">
    <i class="fa-solid fa-calendar-check"></i></a>
  </div>
</nav>
<!-- /NAV NUEVO -->
    <h2>Sistema de Notas por Cuatrimestre</h2>
    
    <div class="container">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Tarjetas de los periodos -->
        <ul class="clases">
            
            <!-- PRIMER CUATRIMESTRE -->
            <li class="cajas">
                <div class="titulo-caja">
                    Primer Cuatrimestre
                </div>
                <div class="cajafooter">
                     <button>
                    <a href="{{ route('notas.periodo', [$materia->id, 'primer_cuatrimestre']) }}">
                        Ver Trabajos
                    </a>
                </button>
                    @if(auth()->user()->role !== 'alumno')
                    <button>
                        <a href="{{ route('notas.crear-trabajo', [$materia->id, 'primer_cuatrimestre']) }}">
                            Crear Trabajo
                        </a>
                    </button>
                    @endif
                </div>
            </li>

            <!-- SEGUNDO CUATRIMESTRE -->
            <li class="cajas">
                <div class="titulo-caja">
                    Segundo Cuatrimestre
                </div>
                <div class="cajafooter">
                    <button>
                        <a href="{{ route('notas.periodo', [$materia->id, 'segundo_cuatrimestre']) }}">
                            Ver Trabajos
                        </a>
                    </button>
                    @if(auth()->user()->role !== 'alumno')
                     <button>
                        <a href="{{ route('notas.crear-trabajo', [$materia->id, 'segundo_cuatrimestre']) }}">
                            Crear Trabajo
                        </a>
                    </button>
                    @endif
                </div>
            </li>

            <!-- RECUPERATORIO -->
            <li class="cajas">
                <div class="titulo-caja">
                    Recuperatorio
                </div>
                <div class="cajafooter">
                    <button>
                    <a href="{{ route('notas.periodo', [$materia->id, 'recuperatorio']) }}">
                        Ver Trabajos
                    </a>
                    </button>
                    @if(auth()->user()->role !== 'alumno')
                    <button>
                        <a href="{{ route('notas.crear-trabajo', [$materia->id, 'recuperatorio']) }}">
                            Crear Trabajo
                        </a>
                    </button>
                    @endif
                </div>
            </li>
        <div>
            <button>
                <a href="{{ route('materias.show', $materia->id) }}" >Volver a la Materia</a>
            </button>
            @if(auth()->user()->role !== 'alumno')
            <button>
                <a href="{{ route('notas.promedios', $materia->id) }}" >Ver Promedios</a>
              </button>
            @endif
         </div>
        </ul>
      
    </div>
</main>
</body>
</html>