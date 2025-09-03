<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Pagina Inicial (Profesores)</title>
           <link href='https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap' rel="stylesheet">
    <link rel="stylesheet" href="{{ asset("profesor/estilospaginico.css") }}">
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
    <button id="abrirMenu">☰</button>

    <nav id="menuLateral" class="cerrado">
    <button id="cerrarMenu">×</button>
    
    <ul>
    <li><a href="/paginicio.html">Inicio</a></li>
    <li><a href="horarios.html">Horarios</a></li>
    <li><a href="inicioprofesor.html">Materias/Cursos</a></li>
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

  <div class="container" id="container">
    <!-- columna izquierda -->
      <div class="columna izquierda">
      <button class="toggle-btn btn-left" onclick="toggleLeft()">⮞</button>
      <h2>Notificaciones</h2>
      </div>
    <!-- columna centro -->
      <div class="columna centro">

      
  <li class="cajas">
    <div class="titulo-caja"> Materia</div>
    <div class="subtitulo-caja"> Profesor </div>
    <div class="subsubtitulo-caja"> Curso </div>

    <div class="cajafooter">
        <a class="boton editar" href="#" >Editar</a>

        <form action="#" method="POST" style="display:inline;" onsubmit="return confirm('¿Seguro que querés eliminar esta materia?');">

          <button class="boton eliminar" type="submit" >Eliminar</button>
        </form>

      <a class="boton entrar" href="#">Entrar</a>
    </div>
  </li>

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

</body>
</html>