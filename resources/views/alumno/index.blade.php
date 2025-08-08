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
        <ul class="clases">
          <li class="cajas">
            <div class="titulo-caja">Materia 1</div>
            <div class="subtitulo-caja">Profesor 1</div>
            <div class="cajafooter">
              <a href="materia1.html" class="boton">Entrar</a>
            </div>            
          </li>
      
          <li class="cajas">
            <div class="titulo-caja">Materia 2</div>
            <div class="subtitulo-caja">Profesor 2</div>
            <div class="cajafooter">
              <a href="materia1.html" class="boton">Entrar</a>            </div>
          </li>
      
          <li class="cajas">
            <div class="titulo-caja">Materia 3</div>
            <div class="subtitulo-caja">Profesor 3</div>
            <div class="cajafooter">
              <a href="materia1.html" class="boton">Entrar</a>
            </div>
          </li>
  
          <li class="cajas">
              <div class="titulo-caja">Materia 4</div>
              <div class="subtitulo-caja">Profesor 4</div>
              <div class="cajafooter">
                <a href="materia1.html" class="boton">Entrar</a>              </div>
            </li>
  
          <li class="cajas">
              <div class="titulo-caja">Materia 5</div>
              <div class="subtitulo-caja">Profesor 5</div>
              <div class="cajafooter">
                <a href="materia1.html" class="boton">Entrar</a>              </div>
          </li>

          <li class="cajas">
            <div class="titulo-caja">Materia 6</div>
            <div class="subtitulo-caja">Profesor 6</div>
            <div class="cajafooter">
              <a href="materia1.html" class="boton">Entrar</a>            </div>
          </li>
      
          <li class="cajas">
            <div class="titulo-caja">Materia 7</div>
            <div class="subtitulo-caja">Profesor 7</div>
            <div class="cajafooter">
              <a href="materia1.html" class="boton">Entrar</a>            </div>
          </li>
      
          <li class="cajas">
            <div class="titulo-caja">Materia 8</div>
            <div class="subtitulo-caja">Profesor 8</div>
            <div class="cajafooter">
              <a href="materia1.html" class="boton">Entrar</a>            </div>
          </li>
  
          <li class="cajas">
              <div class="titulo-caja">Materia 9</div>
              <div class="subtitulo-caja">Profesor 9</div>
              <div class="cajafooter">
                <a href="materia1.html" class="boton">Entrar</a>              </div>
            </li>
  
          <li class="cajas">
              <div class="titulo-caja">Materia 10</div>
              <div class="subtitulo-caja">Profesor 10</div>
              <div class="cajafooter">
                <a href="materia1.html" class="boton">Entrar</a>              </div>
          </li>
          <li class="cajas">
            <div class="titulo-caja">Materia 11</div>
            <div class="subtitulo-caja">Profesor 11</div>
            <div class="cajafooter">
              <a href="materia1.html" class="boton">Entrar</a>            </div>
          </li>
      
          <li class="cajas">
            <div class="titulo-caja">Materia 12</div>
            <div class="subtitulo-caja">Profesor 12</div>
            <div class="cajafooter">
              <a href="materia1.html" class="boton">Entrar</a>            </div>
          </li>
      
          <li class="cajas">
            <div class="titulo-caja">Materia 13</div>
            <div class="subtitulo-caja">Profesor 13</div>
            <div class="cajafooter">
              <a href="materia1.html" class="boton">Entrar</a>            </div>
          </li>
  
          <li class="cajas">
              <div class="titulo-caja">Materia 14</div>
              <div class="subtitulo-caja">Profesor 14</div>
              <div class="cajafooter">
                <a href="materia1.html" class="boton">Entrar</a>              </div>
            </li>
  
          <li class="cajas">
              <div class="titulo-caja">Materia 15</div>
              <div class="subtitulo-caja">Profesor 15</div>
              <div class="cajafooter">
                <a href="materia1.html" class="boton">Entrar</a>              </div>
          </li>
      </ul>
      <!-- /BOXS DE MATERIAS-->

  </body>
</html>