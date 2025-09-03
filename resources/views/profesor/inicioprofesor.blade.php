<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Pagina Inicial (Profesores)</title>
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
    <!-- NOTIFICACIONES (IZQUIERDA) -->
     <div class="columna-izquierda">
      <h2 class="notificaciones-titulo">Notificaciones</h2>
      <ul class="notificaciones-lista">
        <li class="notificacion-item">Notificación 1: Recordatorio de reunión.</li>
        <li class="notificacion-item">Notificación 2: Nuevo material disponible.</li>
        <li class="notificacion-item">Notificación 3: Actualización del horario.</li>
      </ul>
          </div>

    <!-- BOXS DE MATERIAS (CENTRO) -->
     <div class="columna-centro">
    <ul class="clases">
      <li class="cajas">
        <div class="titulo-caja">Materia 1</div>
        <div class="subtitulo-caja">Curso 1</div>
        <div class="cajafooter">
          <a href="materia1p.html" class="boton">Entrar</a>
        </div>            
      </li>
    </ul>    
    </div>
        <!-- HORARIOS (DERECHA) -->

         <div class="columna-derecha">
          <h2 class="horarios-titulo">Horarios</h2>
          <ul class="horarios-lista">
            <li class="horario-item">Lunes: 8:00 - 10:00</li>
            <li class="horario-item">Martes: 10:00 - 12:00</li>
            <li class="horario-item">Miércoles: 14:00 - 16:00</li>
          </ul>
        </div>

    </div>

    <script>

      
    </script>