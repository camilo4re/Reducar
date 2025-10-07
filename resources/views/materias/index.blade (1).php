
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Pagina Inicial ()</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
       <link href='https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap' rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('profesor/estilospaginico.css') }}">
</head>
<body>
  
 
    <!-- /HEADER REDUCAR -->

    <!-- MENU REDUCAR -->
<button id="abrirMenu">☰</button>

    <nav id="menuLateral" class="cerrado">
    <button id="cerrarMenu">×</button>
    
    <ul>
    <li><a href="{{ route('perfil.create') }}"> Mis Datos <i class="fa-solid fa-user"></i></a></li>
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

     <!--HEADER REDUCAR -->
  <header>
  
      <div class="logo-derecha">
        <div class="titulo-izquierda">
      <span class="titulo-principal">Hola {{ Auth::user()->name }}</span>
    </div>
    <img src="{{ asset('/imagenes/LOGOTEC3.png') }}" alt="Logo de la escuela" class="logo">
      </div>
    <div class="barras">
        <div class="barra-naranja"></div>
        <div class="barra-verde"></div>
    </div>
  </header>
<!-- /MENU REDUCAR -->
    

    <main class="content">

      <div class="container" id="container">
    <!-- columna izquierda -->
<div class="columna izquierda" id="columnaNotificaciones">
  <h2>Notificaciones</h2>
  
  <div class="notificaciones">
      @forelse($notificaciones as $n)
          <div class="notificacion">
              <strong>{{ $n->titulo }}</strong><br>
              <small>{{ $n->created_at->format('d/m/Y H:i') }}</small>
              <p>{{ $n->mensaje }}</p>
          </div>
      @empty
          <p>No hay notificaciones.</p>
      @endforelse
  </div>
</div>


      <div class="botonestoggle">
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

<div class="botonestoggle">
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
      <span class="titulo">${r.titulo}</span>
      <span class="fecha">${r.fecha}</span>
      <div class="detalles">
        <p>${r.descripcion}</p>
        <div class="acciones">
          <button class="editar">Editar</button>
          <button class="eliminar">Eliminar</button>
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
    </main>
</body>
</html>