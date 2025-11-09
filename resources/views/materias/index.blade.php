
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
      <div class="contnotis">
        @if(Auth::user()->role === 'directivo')
        <a class="boton"> + Nuevo comunicado</a>
        @endif
        <ul class="listanotis">

                            <li class="notis">
                      <small>Publicado por: Directora (19/09/2025 15:07)</small>
                        <strong> Entrega de Mercaderia</strong>
                          <p>Familias: Anuncio Importante!! Lunes 22 de septiembre se realiza la entrega  de mercaderia. 9:40 a 11 hs /14 a 16 hs /18 a 21hs . Por favor respetar los horarios. Pueden venir a retirar en cualquiera de los turnos.</p>
                          <div class="acciones">
                              @if(Auth::user()->role === 'directivo')
                          <a href="http://reducar.test/materias/8/contenidos/6/edit" class="boton editar">Editar</a>
                        <form action="http://reducar.test/materias/8/contenidos/6" method="POST" style="display:inline;">
                            <input type="hidden" name="_token" value="RSAmPB3O3h3gw6tfhSAw2dgFYg2hlz0v9UEHLtpq" autocomplete="off">                            <input type="hidden" name="_method" value="DELETE">                            <button type="submit" class="boton eliminar">Eliminar</button>
                        </form>
                        @endif
                            </div>
                </li>
                            <li class="notis">
                      <small>Publicado por: Directora (15/09/2025 08:45)</small>
                        <strong> Dia del Estudiante</strong>
                          <p>Familias :El día martes 23/9 celebramos el día del estudiante y el día de la primavera. En el turno mañana asistirán solo los estudiantes de 1ero,2do y 3er año de ambos turnos, no tienen ni teoría ni taller solo asisten de 7:20 a 11:40hs a la recreación. En el turno tarde de 13 a 17:20hs  asisten los estudiantes de 4to, 5to, 6to y 7mo año de ambas modalidades. En el turno vespertino si van a tener taller los estudiantes de ciclo superior.Cualquier inquietud nos pueden consultar.</p>
                          
                            <div class="acciones">
                              @if(Auth::user()->role === 'directivo')
                          <a href="http://reducar.test/materias/8/contenidos/6/edit" class="boton editar">Editar</a>
                        <form action="http://reducar.test/materias/8/contenidos/6" method="POST" style="display:inline;">
                            <input type="hidden" name="_token" value="RSAmPB3O3h3gw6tfhSAw2dgFYg2hlz0v9UEHLtpq" autocomplete="off">                            <input type="hidden" name="_method" value="DELETE">                            <button type="submit" class="boton eliminar">Eliminar</button>
                        </form>
                        @endif
                            </div>
                        
                </li>

                <li class="notis">
                      <small>Publicado por: Directora (15/09/2025 08:45)</small>
                        <strong> Expo-Tecnica 2025</strong>
                          <p>Familias y Estudiantes: Queriamos avisarles que la fecha de la Expo-Tecnica 2025 todavia no esta confirmada por problemas de agenda, pero podemos confirmarle que sera a mediados del 15 al 21 de Noviembre. Saludos!!.</p>
                          <div class="acciones">
                              @if(Auth::user()->role === 'directivo')
                          <a href="http://reducar.test/materias/8/contenidos/6/edit" class="boton editar">Editar</a>
                        <form action="http://reducar.test/materias/8/contenidos/6" method="POST" style="display:inline;">
                            <input type="hidden" name="_token" value="RSAmPB3O3h3gw6tfhSAw2dgFYg2hlz0v9UEHLtpq" autocomplete="off">                            <input type="hidden" name="_method" value="DELETE">                            <button type="submit" class="boton eliminar">Eliminar</button>
                        </form>
                        @endif
                            </div>
                </li>
                    </ul>
      </div>
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
  <div class="contnotis">
  <div class="notis">
  <form id="formRecordatorio" onsubmit="agregarRecordatorio(event)">
    <input class="inputt" type="text" id="tituloNuevo" placeholder="Título del recordatorio" required>
    <textarea class="inputt" id="descripcionNuevo" placeholder="Descripción"></textarea>
    <input class="inputt" type="date" id="fechaNuevo">
    <select class="filtro-cursos" id="prioridadNuevo" required>
      <option value="verde">Baja</option>
      <option value="naranja">Media</option>
      <option value="rojo">Alta</option>
    </select>
    <button class="boton" type="submit">Agregar</button>
  </form>
  </div>
  <div class="recordatorios-lista" id="listaRecordatorios"></div>
</div>

<script>
  const listaRecordatorios = document.getElementById("listaRecordatorios");

// Cargar recordatorios desde LocalStorage
let recordatorios = JSON.parse(localStorage.getItem("recordatorios")) || [];

function guardarLocalStorage() {
  localStorage.setItem("recordatorios", JSON.stringify(recordatorios));
}

// Mostrar recordatorios
function mostrarRecordatorios() {
  listaRecordatorios.innerHTML = "";
  recordatorios.forEach((r, index) => {
    const div = document.createElement("div");
    div.classList.add("recordatorio");
    div.setAttribute("data-prioridad", r.prioridad);

    // Contenido básico: titulo y fecha (si no está expandido)
    div.innerHTML = `
      <h3 class="titulo">${r.titulo}</h3>
      <div class="subsubtitulo">${r.fecha}</div>
      <div class="detalles">
        <p>${r.descripcion}</p>
        <div class="acciones">
          <a class="boton editar">Editar</a>
          <a class="boton eliminar">Eliminar</a>
        </div>
      </div>
    `;

    // Click para expandir solo cuando la columna está expandida
    div.addEventListener("click", function(e) {
      if(e.target.tagName !== "BUTTON" && document.querySelector(".container").classList.contains("expand-right")) {
        this.classList.toggle("expanded");
      }
    });

    // Botones
    div.querySelector(".eliminar").addEventListener("click", function(e){
      e.stopPropagation();
      recordatorios.splice(index,1);
      guardarLocalStorage();
      mostrarRecordatorios();
    });

    div.querySelector(".editar").addEventListener("click", function(e){
      e.stopPropagation();
      const nuevoTitulo = prompt("Editar título", r.titulo);
      const nuevaDescripcion = prompt("Editar descripción", r.descripcion);
      const nuevaFecha = prompt("Editar fecha (YYYY-MM-DD)", r.fecha);
      if(nuevoTitulo) r.titulo = nuevoTitulo;
      if(nuevaDescripcion) r.descripcion = nuevaDescripcion;
      if(nuevaFecha) r.fecha = nuevaFecha;
      guardarLocalStorage();
      mostrarRecordatorios();
    });

    listaRecordatorios.appendChild(div);
  });
}

// Agregar nuevo recordatorio
function agregarRecordatorio(event) {
  event.preventDefault();
  const titulo = document.getElementById("tituloNuevo").value;
  const descripcion = document.getElementById("descripcionNuevo").value;
  const fecha = document.getElementById("fechaNuevo").value;
  const prioridad = document.getElementById("prioridadNuevo").value;

  recordatorios.unshift({ titulo, descripcion, fecha, prioridad });
  guardarLocalStorage();
  mostrarRecordatorios();
  document.getElementById("formRecordatorio").reset();
}

// Inicial
mostrarRecordatorios();
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