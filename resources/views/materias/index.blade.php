<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Pagina Inicial (Alumnos)</title>
    <link rel="stylesheet" href={{ asset("profesor/estilospaginico.css") }}>
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
    <h1>

    <!-- MENU REDUCAR-->
    <button id="abrirMenu">☰</button>

    <nav id="menuLateral" class="cerrado">
    <button id="cerrarMenu">×</button>
    
    <ul>
    <li><a href="/paginicio.html">Inicio</a></li>
    <li><a href="nuevohorario.html">Horarios</a></li>
    <li><a href="asistencias.html">Asistencias</a></li>
    <li><a href="#">Notificaciones</a></li>
    <li><a href="#">Cerrar sesión</a></li>
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
    
    <!-- /MENU REDUCAR-->

        <!-- BOXS DE MATERIAS-->
        @if((Auth()->user()->role==='profesor')||(Auth()->user()->role==='directivo'))
        <ul class="clases">
          <li class="cajas">
            <div class="titulo-caja">Nombre de la materia</div>
            <div class="subtitulo-caja">Profesor {{ Auth::user()->name }} </div>
            <div class="cajafooter">
            <div class="titulo-caja"><a href="{{ route('materias.create') }}" class="boton">Crear nueva materia +</a></div>            
          </li>
          @endif


          @foreach($materias as $materia)                            
              @csrf
              <li class="cajas">
                <div class="titulo-caja">{{ $materia->nombre }}</div>
                    <div class="subtitulo-caja">Profesor {{ Auth::user()->name }}</div>
                    <div class="subtitulo-caja">Curso {{ $materia->curso_id }}</div>
                        <div class="cajafooter">
                          @if((Auth()->user()->role==='profesor')||(Auth()->user()->role==='directivo'))
                            <a href="{{ route('materias.edit', $materia->id) }}" class="boton" style="background-color: yellow">Editar</a>
                          @endif
                          @if((Auth()->user()->role==='profesor')||(Auth()->user()->role==='directivo'))
                             <form action="{{ route('materias.destroy', $materia->id) }}" method="POST" style="display:inline;">
                                @method('DELETE')
                                <button class="boton" style="background-color: red" type="submit">Eliminar</button>
                              </form>
                          @endif
                          <a href="materia1p.html" class="boton">Entrar</a>
                        </div>
                </div>
                          
          @endforeach
  </body>
</html>