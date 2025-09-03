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
<div class="container">
        
        <form action="{{ route('notas.update', [$materia->id, $periodo, $trabajo->trabajo_titulo]) }}" method="POST" class="formulario-trabajo">
            @csrf
            @method('PUT')
            <div>
                <label for="trabajo_titulo">
                     Título del Trabajo
                </label>
                <input type="text" 
                       id="trabajo_titulo" 
                       name="trabajo_titulo" 
                       value="{{ $trabajo->trabajo_titulo }}" 
                       readonly>
                <small>El título no se puede modificar una vez creado el trabajo.</small>
            </div>

            <div>
                <label for="trabajo_descripcion">
                     Descripción
                </label>
                <textarea id="trabajo_descripcion" 
                          name="trabajo_descripcion" 
                          rows="3" 
                          placeholder="Descripción adicional del trabajo...">{{ old('trabajo_descripcion', $trabajo->trabajo_descripcion) }}</textarea>
            </div>

            <h3> Notas de los Alumnos</h3>
            <p>Modifica las notas según sea necesario. Deja vacío para eliminar una nota.</p>

            <table class="tabla-alumnos">
                <thead>
                    <tr>
                        <th> Alumno</th>
                        <th>
                             Nota (1-10)
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($alumnos as $alumno)
                        <tr>
                            <td>
                                {{ $alumno->name }}
                            </td>
                            <td style="text-align: center;">
                                <input type="number" 
                                       name="notas[{{ $alumno->id }}]" 
                                       min="1" 
                                       max="10" 
                                       step="0.01"
                                       value="{{ old("notas.{$alumno->id}", $notasActuales[$alumno->id]) }}"
                                       placeholder="-">
                                @error("notas.{$alumno->id}")
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            @error('notas')
                <div class="error-message" style="margin-top: 10px; text-align: center;">
                    {{ $message }}
                </div>
            @enderror

            <div class="botones-accion">
                <button type="submit" >
                     Actualizar Trabajo
                </button>
                <button>
                <a href="{{ route('notas.periodo', [$materia->id, $periodo]) }}">
                     Cancelar
                </a>
                </button>
            </div>
        </form>
    </div>
</section>

</main>
</body>
</html>