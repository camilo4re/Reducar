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

    <!-- BOXS DE MATERIAS-->
    <ul class="clases">
      <li class="cajas">
        <div class="titulo-caja">Materia 1</div>
        <div class="subtitulo-caja">Curso 1</div>
        <div class="cajafooter">
          <a href="materia1p.html" class="boton">Entrar</a>
        </div>            
      </li>
  
      <li class="cajas">
        <div class="titulo-caja">Materia 2</div>
        <div class="subtitulo-caja">Curso 2</div>
        <div class="cajafooter">
          <a href="materia1p.html" class="boton">Entrar</a>
        </div>
      </li>
  
      <li class="cajas">
        <div class="titulo-caja">Materia 3</div>
        <div class="subtitulo-caja">Curso 3</div>
        <div class="cajafooter">
          <a href="materia1p.html" class="boton">Entrar</a>
        </div>
      </li>

      <li class="cajas">
          <div class="titulo-caja">Materia 4</div>
          <div class="subtitulo-caja">Curso 4</div>
          <div class="cajafooter">
            <a href="materia1p.html" class="boton">Entrar</a>
          </div>
        </li>
        
        <!-- BOXS DE MATERIAS -->