<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Notificaciones</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="icon" type="image/x-icon" href="/IMAGENES/LOGOTECNICA3.png">
    <link href='https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap' rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('profesor/estilospaginico.css') }}">
    <link rel ="stylesheet" href="{{ asset('profesor/responsive.css') }}">
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
<nav class="header-centro active">
  <div class="icono-header" data-tooltip="Notificaciones">
    <a href="{{ route('materias.show', $materia->id) }}"><i class="fa-solid fa-table-columns"></i></a>
  </div>
  <div class="icono-header" data-tooltip="Promedios">
    <a href="{{ route('notas.promedios', $materia->id) }}"><i class="fa-solid fa-users"></i></a>
  </div>
  <div class="icono-header" data-tooltip="Calificaciones">
    <a href="{{ route('notas.index', $materia->id) }}"><i class="fa-solid fa-clipboard-list"></i></a>
  </div>
  <div class="icono-header" data-tooltip="Asistencias">
    <a href="{{ route('asistencias.index', $materia->id) }}"><i class="fa-solid fa-calendar-check"></i></a>
  </div>
</nav>
<!-- /NAV NUEVO -->
<section class="notificaciones">
  <h2>Notificaciones </h2>


<div class="contnotis">

    @if($materia->contenidos->isEmpty())
        <p>No hay comunicados aún.</p>
            @if (auth()->user()->role === 'profesor' || auth()->user()->role === 'directivo')
                  <a href="{{ route('contenidos.create', $materia->id) }}" class="boton">Nuevo comunicado</a>
            @endif
    @else
    @if (auth()->user()->role === 'profesor' || auth()->user()->role === 'directivo')
                      <a href="{{ route('contenidos.create', $materia->id) }}" class="boton">Nuevo comunicado</a>

    @endif

        <ul class="listanotis">

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
