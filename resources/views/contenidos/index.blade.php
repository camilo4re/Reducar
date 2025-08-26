<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Materia 1 (Profesor)</title>
    <link rel="stylesheet" href="{{ asset('profesor/estilospaginico.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

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
    <i class="fa-solid fa-clipboard-list"></i>
  </div>
  <div class="icono-header" data-tooltip="Asistencias">
    <i class="fa-solid fa-calendar-check"></i>
  </div>
</nav>
<!-- /NAV NUEVO -->

<section class="notificaciones">
  <h2>Crear Comunicado</h2>


<div class="container">
    <h1>{{ $materia->nombre }}</h1>
    <p><strong>Año:</strong> {{ $materia->curso->año }} - <strong>División:</strong> {{ $materia->curso->division }}</p>

    <hr>

<div class="container">
    <h1>Comunicados de {{ $materia->nombre }}</h1>
    <ul>
      @forelse($contenidos as $contenido)
            <li>
                <a href="{{ route('contenidos.show', [$materia->id, $contenido->id]) }}">
                    <strong>{{ $contenido->titulo }}</strong>
                </a>
                <small>({{ $contenido->created_at->format('d/m/Y') }})</small>
            </li>
        @empty
            <li>No hay comunicados.</li>
      @endforelse
    </ul>
    <a href="{{ route('materias.show', $materia->id) }}">Volver a la materia</a>
</div>

</main>

</body>
</html>