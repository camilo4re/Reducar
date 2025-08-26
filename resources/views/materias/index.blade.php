
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
  
  <!--HEADER REDUCAR -->
  <header>
    <img src="/IMAGENES/LOGOTEC3.png" alt="Logo de la escuela" class="logo">

    <div class="barras">
        <div class="barra-naranja"></div>
        <div class="barra-verde"></div>
    </div>
  </header>

    <!-- /HEADER REDUCAR -->

    <!-- MENU REDUCAR-->
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
    <!-- /MENU REDUCAR-->
      <div class="container" id="container">
    <!-- columna izquierda -->
      <div class="columna izquierda">
      <button class="toggle-btn btn-left" onclick="toggleLeft()">⮞</button>
      <h2>Notificaciones</h2>
      </div>

    <!-- columna centro -->
      <div class="columna centro">
        <!-- BOXS DE MATERIAS-->
                          <h2>Materias</h2>
        @if((Auth()->user()->role==='profesor')||(Auth()->user()->role==='directivo'))            
        <div class="crear-materia"><a href="{{ route('materias.create') }}" class="boton">Crear nueva materia +</a></div>            
          </li>
        </ul>
          @endif


                  
    @forelse($materias->sortByDesc('created_at') as $materia)
      <ul class="clases">
        <li class="cajas">
        <div class="titulo-caja">{{ $materia->nombre }}</div>
        <div class="subtitulo-caja">Profesor {{ $materia->user->name }}</div>
        <div class="subsubtitulo-caja">Curso {{ $materia->curso->año }} {{ $materia->curso->division }}</div>
        <div class="cajafooter">
            @if(Auth::user()->role=='profesor'||Auth::user()->role=='directivo')
              <a class="boton editar" href="{{ route('materias.edit', $materia) }}" >Editar</a>
                <form action="{{ route('materias.destroy', $materia) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Seguro que querés eliminar esta materia?');">
                  @csrf
                  @method('DELETE')
                  <button class="boton eliminar" type="submit" >Eliminar</button>
                </form>
            @endif
            <a class="boton entrar" href="{{ route('materias.show', $materia->id) }}" class="btn btn-primary">Entrar</a>

        </div>
        </li>
      </ul>
      @empty
        <p>No hay materias disponibles.</p>
    @endforelse

              </div>
    <!-- columna derecha -->
    <div class="columna derecha">
    <button class="toggle-btn btn-right" onclick="toggleRight()">⮜</button>
    <h2>Horario Semanal</h2>
    </div>
    
  </div>

  <script>
    const container = document.getElementById("container");

    function toggleLeft() {
      if (container.classList.contains("expand-left")) {
        container.classList.remove("expand-left");
      } else {
        container.classList.remove("expand-right");
        container.classList.add("expand-left");
      }
    }

    function toggleRight() {
      if (container.classList.contains("expand-right")) {
        container.classList.remove("expand-right");
      } else {
        container.classList.remove("expand-left");
        container.classList.add("expand-right");
      }
    }
  </script>
    </main> 
</body>
</html>