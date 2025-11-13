
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Pagina Inicial</title>
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

<!-- HEADER REDUCAR -->
<header>
  <div class="header-superior">
    <div class ="titulo-izquierda">
          <h1 class="typewriter-text" id="tituloAnimado"></h1>
        </div>
    <div class="logo-derecha">
      <img src="/IMAGENES/LOGOTEC3.png" alt="Logo de la escuela" class="logo">
    </div>
    </div>
      <div class="barras">
        <div class="barra-naranja"></div>
        <div class="barra-verde"></div>
      </div>
</header>
<script>
 const frases = [
  "Hola {{ Auth::user()->name }} ...",
  "Bienvenido a Reducar ...",
];
let i = 0;
let j = 0;
let escribiendo = true;
const velocidadEscritura = 200;
const velocidadBorrado = 100;
const pausaEntreFrases = 1000;  

const titulo = document.getElementById("tituloAnimado");

function animarTexto() {
  if (escribiendo) {
    if (j < frases[i].length) {
      titulo.textContent += frases[i][j];
      j++;
      setTimeout(animarTexto, velocidadEscritura);
    } else {
      escribiendo = false;
      setTimeout(animarTexto, pausaEntreFrases);
    }

  } else {
    if (j > 0) {
      titulo.textContent = frases[i].substring(0, j - 1);
      j--;
      setTimeout(animarTexto, velocidadBorrado);
    } else {
      escribiendo = true;
      i = (i + 1) % frases.length;
      setTimeout(animarTexto, 500);
    }
  }
}

document.addEventListener("DOMContentLoaded", animarTexto);
</script>
<!-- /HEADER REDUCAR -->

<div class="container" id="container">
    <!-- columna izquierda -->
<div class="columna izquierda" id="columnaNotificaciones">
  <h2>Notificaciones</h2>
    
    @if(Auth::user()->role === 'directivo')
    <div class="notis">
      <form action="{{ route('notificaciones.store') }}" method="POST">
        @csrf
        <input class="inputt" type="text" name="titulo" placeholder="Título de la notificación" required>
        <textarea class="inputt" name="contenido" placeholder="Contenido de la notificación" required></textarea>
        <button class="boton" type="submit">Publicar Notificación</button>
      </form>
    </div>
    @endif

    <ul class="listanotis">
      @forelse($notificaciones as $notificacion)
        <li class="notis">
          <small>Publicado por: {{ $notificacion->user->name }} ({{ $notificacion->created_at->format('d/m/Y H:i') }})</small>
          <strong>{{ $notificacion->titulo }}</strong>
          <p>{{ $notificacion->contenido }}</p>
          
          @if(Auth::user()->role === 'directivo')
          <div class="acciones">
            <form action="{{ route('notificaciones.destroy', $notificacion->id) }}" method="POST" style="display:inline;">
              @csrf
              @method('DELETE')
              <button type="submit" class="boton eliminar" onclick="return confirm('¿Eliminar esta notificación?')">Eliminar</button>
            </form>
          </div>
          @endif
        </li>
      @empty
        <li class="notis">
          <p>No hay notificaciones disponibles.</p>
        </li>
      @endforelse
    </ul>
</div>

<div class="botonestoggle izq">
  <button class="toggle-btn btn-left" onclick="toggleLeft()">⮞</button>
</div>
    <!-- columna centro -->
<div class="columna centro">
    <h2>Materias</h2>

    {{-- Mostrar solo al directivo --}}
    @if(Auth::user()->role === 'directivo')
        <form class="filtro-cursos" method="GET" action="{{ route('materias.index') }}">
            <label for="curso_id"><strong>Filtrar por curso:</strong></label>
            <select name="curso_id" id="curso_id" onchange="this.form.submit()">
                <option value="">Todos los cursos</option>
                @foreach($cursos as $curso)
                    <option value="{{ $curso->id }}" {{ request('curso_id') == $curso->id ? 'selected' : '' }}>
                        {{ $curso->año }}º {{ $curso->division }}
                    </option>
                @endforeach
            </select>
        </form>
    @endif

    @if((Auth()->user()->role==='profesor')||(Auth()->user()->role==='directivo'))            
        <div class="crear-materia">
            <a href="{{ route('materias.create') }}" class="boton">Crear nueva materia +</a>
        </div>
    @endif

    @forelse($materias->sortByDesc('created_at') as $materia)
        <ul class="clases">
            <li class="cajas">
                <div class="titulo-caja">{{ $materia->nombre }}</div>
              <div class="subtitulo-caja">Profesor {{ $materia->user->name }}</div>
              <div class="subtitulo-caja">Curso {{ $materia->curso->año }} {{ $materia->curso->division }}</div>
              <div class="subtitulo-caja">
                  @if($materia->horarios->count() > 0)
                      @foreach($materia->horarios as $horario)
                        {{ $horario->nombre_dia }} {{ date('H:i', strtotime($horario->hora_inicio)) }}-{{ date('H:i', strtotime($horario->hora_fin)) }}
                      @endforeach
                  @else
                    <span class="sin-horarios">Sin horarios configurados</span>
                  @endif
                </div>
                <div class="cajafooter">
                    <a class="boton entrar" href="{{ route('materias.show', $materia->id) }}">Entrar</a>

                    @if(Auth::user()->role=='profesor'||Auth::user()->role=='directivo')
                        <a class="boton editar" href="{{ route('materias.edit', $materia) }}">Editar</a>
                        <form action="{{ route('materias.destroy', $materia) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Seguro que querés eliminar esta materia?');">
                            @csrf
                            @method('DELETE')
                            <button class="boton eliminar" type="submit">Eliminar</button>
                        </form>
                    @endif
                </div>
            </li>
        </ul>
    @empty
        <p>No hay materias disponibles.</p>
    @endforelse
</div>

<div class="botonestoggle der">
    <button class="toggle-btn btn-right" onclick="toggleRight()">⮜</button>
</div>

    <!-- columna derecha -->
<div class="columna derecha" id="columnaRecordatorios">
  <h2>Recordatorios</h2>

    <div class="notis">
      <form action="{{ route('recordatorios.store') }}" method="POST">
        @csrf
        <input class="inputt" type="text" name="titulo" placeholder="Título del recordatorio" required>

        <textarea class="inputt" name="descripcion" placeholder="Descripción"></textarea>

        <input class="inputt" type="date" name="fecha" required>

        <select class="filtro-cursos" name="prioridad" required>
          <option value="verde">Baja</option>
          <option value="naranja">Media</option>
          <option value="rojo">Alta</option>
        </select>

        <button class="boton entrar" type="submit">Agregar</button>
      </form>
    </div>

    <ul class="listanotis" id="listaRecordatorios">
      @forelse ($recordatorios as $recordatorio)
        <li class="notis {{ $recordatorio->prioridad }}">
          <small>Vence el: {{ \Carbon\Carbon::parse($recordatorio->fecha)->format('d/m/Y') }}</small>
          <strong>{{ $recordatorio->titulo }}</strong>
          <p>{{ $recordatorio->descripcion }}</p>
          
<div class="acciones">
          <form action="{{ route('recordatorios.destroy', $recordatorio->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button class="boton eliminar" type="submit">Eliminar</button>
          </form>
</div>
        </li>
      @empty
        <p>No hay recordatorios.</p>
      @endforelse
    </ul>
</div>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const recordatorios = document.querySelectorAll('.recordatorio');
    
    recordatorios.forEach(recordatorio => {
      recordatorio.addEventListener('click', function(e) {
        
        if(e.target.tagName !== 'BUTTON' && e.target.tagName !== 'FORM') {
          this.classList.toggle('expanded');
        }
      });
    });
  });
</script>
    </div>

  <script>
    const container = document.getElementById("container");
    const btnLeft = document.querySelector(".btn-left");
    const btnRight = document.querySelector(".btn-right");

    function toggleLeft() {
      if (container.classList.contains("expand-left")) {
        container.classList.remove("expand-left");
        btnLeft.innerHTML = "⮞"; // vuelve a mirar a la derecha
      } else {
        container.classList.remove("expand-right");
        container.classList.add("expand-left");
        btnLeft.innerHTML = "⮜"; // ahora mira a la izquierda
      }
    }

    function toggleRight() {
      if (container.classList.contains("expand-right")) {
        container.classList.remove("expand-right");
        btnRight.innerHTML = "⮜"; // vuelve a mirar a la izquierda
      } else {
        container.classList.remove("expand-left");
        container.classList.add("expand-right");
        btnRight.innerHTML = "⮞"; // ahora mira a la derecha
      }
    }
  </script>
</div>
    </main>
</body>
</html>