<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Materia 1 (Profesor)</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href='https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap' rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('profesor/estilospaginico.css') }}">
     <link rel ="stylesheet" href="{{ asset('profesor/responsive.css') }}">
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
  <div class="icono-header" data-tooltip="Notificaciones">
    <a href="{{ route('materias.show', $materia->id) }}"><i class="fa-solid fa-table-columns"></i></a>
  </div>
  <div class="icono-header" data-tooltip="Promedios">
    <a href="{{ route('notas.promedios', $materia->id) }}"><i class="fa-solid fa-users"></i></a>
  </div>
  <div class="icono-header active" data-tooltip="Calificaciones">
    <a href="{{ route('notas.index', $materia->id) }}"><i class="fa-solid fa-clipboard-list"></i></a>
  </div>
  <div class="icono-header" data-tooltip="Asistencias">
    <a href="{{ route('asistencias.index', $materia->id) }}"><i class="fa-solid fa-calendar-check"></i></a>
  </div>
</nav>


<!-- /NAV NUEVO -->


    <div class="container">
        
        <form action="{{ route('notas.guardar-trabajo', [$materia->id, $periodo]) }}" method="POST" class="formulario-trabajo">
            @csrf
            
            <div class="campo-grupo">
                <label for="trabajo_titulo">
                     Título del Trabajo 
                </label>
                <input type="text" 
                       id="trabajo_titulo" 
                       name="trabajo_titulo" 
                       value="{{ old('trabajo_titulo') }}" 
                       placeholder="Ej: Parcial 1, TP Integrador, Examen Final..." 
                       required>
                @error('trabajo_titulo')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="campo-grupo">
                <label for="trabajo_descripcion">
                    <i ></i> Descripción (opcional)
                </label>
                <textarea id="trabajo_descripcion" 
                          name="trabajo_descripcion" 
                          rows="3" 
                          placeholder="Descripción adicional del trabajo...">{{ old('trabajo_descripcion') }}</textarea>
            </div>

            <h3> Notas de los Alumnos</h3>
            <table >
                <thead>
                    <tr>
                        <th> Alumno</th>
                        <th> Nota (1-10)</th>
                    </tr>
                </thead>
                
                    @foreach($alumnos as $alumno)
                        <tr>
                            <td>
                                {{ $alumno->name }}
                            </td>
                            <td >
                                <input type="number" 
                                       name="notas[{{ $alumno->id }}]" 
                                       class="input-nota"
                                       min="1" 
                                       max="10" 
                                       step="0.01"
                                       value="{{ old("notas.{$alumno->id}") }}"
                                       placeholder="-">
                                @error("notas.{$alumno->id}")
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </td>
                        </tr>
                    @endforeach
                
            </table>

            @error('notas')
                <div>
                    {{ $message }}
                </div>
            @enderror

            <div>
                <button type="submit">
                 Guardar Trabajo
                </button>
                <button>
                <a href="{{ route('notas.periodo', [$materia->id, $periodo]) }}">
                     Cancelar
                </a></button>
            </div>
        </form>
        
    </div>
</main>
</body>