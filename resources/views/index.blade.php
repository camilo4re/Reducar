<!DOCTYPE html>
<html lang="es">
<head>
  <title>REDUCAR</title>
  <link rel="stylesheet" href="{{ asset("inicio.css") }}">
<link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
 <header>

    <div class="logo-del-titulo">
      <img src="{{ asset("imagenes/LOGOTEC3.png") }}" alt="Logo" class="logo">
    </div>
  
    <nav>
    <a href="login">Inicio de sesión</a>
    <a href="register">Registrarme</a>
  </nav>

    <div class="barras">

    <div class="barra-naranja"></div>
    <div class="barra-verde"></div>

    </div>
  </header>

<!-- MENU REDUCAR -->
<button id="abrirMenu">☰</button>
<nav id="menuLateral" class="cerrado">
  <button id="cerrarMenu">×</button>
  <ul>
    <li><a href="/paginicio.html">Inicio</a></li>
    <li><a href="/ALUMNO/nuevohorario.html">Horarios</a></li>
    <li><a href="/PROFESOR/inicioprofesor.html">Materias/Cursos</a></li>
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
<!-- /MENU REDUCAR -->

<div class="contenedor-principal">

 <section class="hero">
    <div class="mensaje fade-in-section">
    <h1 class="typewriter-text" id="tituloAnimado"></h1>
    </div>
  </section>

  </div>
   
    <main class="contenido">
        <section class="fade-in-section info-destacada">
          <div class="texto">

      <h2>¿Quienes Somos?</h2>
      <p>
La Escuela de Educación Secundaria N.º 3 de San Antonio de Padua es una institución comprometida con la formación integral de jóvenes, brindando una educación pública, gratuita y de calidad, con enfoque en los valores, el pensamiento crítico y la preparación para el mundo profesional y ciudadano.
      </p>
      </div>
      <div class="imagen">
      <img src="{{ asset("imagenes/DIV1.jpg") }}" alt="ejemplo1" class="section-image">
      </div>
        </section>

        <section class="fade-in-section info-destacada">
  <div class="texto">
    <h2>Oferta Educativa</h2>
    <p>
      Brindamos formación técnica en informática, preparando a los jóvenes para un mundo digital en constante evolución.
    </p>
  </div>
  <div class="imagen">
    <img src="{{ asset("imagenes/LOGOTEC3.png") }}" alt="Oferta Educativa" class="section-image">
  </div>
</section>

  <section class="fade-in-section info-destacada">
  <div class="texto">
    <h2>Perfil de Estudiantes</h2>
    <p>
La Educación Técnico Profesional brinda títulos técnicos en diferentes especialidades, siguiendo las normas nacionales y adaptándose a las necesidades de cada región.

Nuestra escuela, con muchos años de historia en San Antonio de Padua (Merlo), siempre se ha destacado por formar técnicos bien preparados, tanto en lo profesional como en lo humano, sabiendo que el conocimiento abre muchas puertas en la vida.
   </p>
  </div>
  <div class="imagen">
    <img src="{{ asset("imagenes/LOGOTEC3.png") }}" alt="Oferta Educativa" class="section-image">
  </div>
</section>


  </main>

    <footer class="footer-con-fondo">
  <div class="overlay">
    <div class="footer-contenido">
      <div class="columna">
        <h4>Institución</h4>
        <a href="#">Pautas Institucionales</a>
        <a href="#">Autoridades</a>
        <a href="#">Cooperadora</a>
      </div>
      <div class="columna">
        <h4>Contacto</h4>
        <a href="#">Teléfono</a>
        <a href="#">Correo</a>
        <a href="#">Ubicación</a>
      </div>
      <div class="columna">
        <h4>Redes</h4>
        <a href="#">Facebook</a>
        <a href="#">Instagram</a>
        <a href="#">YouTube</a>
      </div>
    </div>
    <div class="footer-copy">
      © 2025 Reducar - Todos los derechos reservados
    </div>
  </div>
  
</footer>

     <script src="{{ asset("script.js") }}"></script> 

 

  <script>
  const sections = document.querySelectorAll('.fade-in-section');

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('visible');
      }
    });
  }, {
    threshold: 0.1
  });

  sections.forEach(section => {
    observer.observe(section);
  });
</script>

</body>
</html>