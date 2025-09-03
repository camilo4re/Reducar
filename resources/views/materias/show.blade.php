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
    <li><a href="{{ route ('materias.index') }}">Inicio <i class="fa-solid fa-house"></i></a></li>
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
<!-- /MENU REDUCAR -->

<main class="content">

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
  <h2>Notificaciones </h2>


<div class="contnotis">

    @if($materia->contenidos->isEmpty())
       <a href="{{ route('contenidos.create', $materia->id) }}" class="boton">Nuevo comunicado</a>
        <p>No hay comunicados aún.</p>
    @else
        <ul class="listanotis">
    @if(auth()->user()->role === 'profesor' || auth()->user()->role === 'directivo')
        <a href="{{ route('contenidos.create', $materia->id) }}" class="boton">Nuevo comunicado</a>
    @endif
            @foreach($materia->contenidos->sortByDesc('created_at') as $contenido)
                <li class="notis">
                     <small>Publicado por: {{ $contenido->user->name }} ({{ $contenido->created_at->format('d/m/Y H:i') }})</small>
                       <strong>{{ $contenido->titulo }}</strong>
                          <p>{{ $contenido->descripcion }}</p>
                          <div class="acciones">
                        @if(auth()->id() === $contenido->user_id || auth()->user()->role === 'directivo')
                            <a href="{{ route('contenidos.edit', [$materia->id, $contenido->id]) }}" class="boton editar">Editar</a>

                        <form action="{{ route('contenidos.destroy', [$materia->id, $contenido->id]) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="boton eliminar">Eliminar</button>
                        </form>
                    @endif
                          </div>
                </li>
            @endforeach
        </ul>
    @endif

</div>
<!-- /NOTIFICACIONES REDUCAR  -->

</main>
</body>
</html>
