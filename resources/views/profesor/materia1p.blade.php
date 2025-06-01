<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Materia 1 (Profesor)</title>
    <link rel="stylesheet" href="estilospaginico.css">
</head>
<body>

<!-- HEADER REDUCAR -->
<header class="encabezado">
  <div class="header-superior">
    <div class="titulo-izquierda">
      <span class="titulo-principal">PP 7° 2° - T3</span>
      <span class="subtitulo">7° 2° TECIP</span>
    </div>
    <img src="/IMAGENES/LOGOTEC3.png" alt="Logo de la escuela" class="logo">
  </div>

  <div class="barras">
    <div class="barra-naranja"></div>
    <div class="barra-verde"></div>
  </div>

  <nav class="tabs-nav">
    <a href="#" class="tab-activa">Tablón</a>
    <a href="#">Personas</a>
    <a href="materia1cal.html">Calificaciones</a>
    <a href="#">Asistencias</a>
  </nav>
</header>
<!-- /HEADER REDUCAR -->

<!-- MENU REDUCAR -->
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
<!-- /MENU REDUCAR -->

<!-- NOTIFICACIONES REDUCAR -->

<section class="notificaciones">
  <h2>Notificaciones</h2>

  <div class="notificacion-nueva">
    <textarea id="textoNotificacion" placeholder="Anuncia algo a tu clase"></textarea>
    <div class="acciones-noti">
      <button class="boton" onclick="publicarNotificacion()">Publicar</button>
    </div>
  </div>

  <div id="listaNotificaciones" class="notificaciones-lista"></div>
</section>

<script>
  const listaNotificaciones = document.getElementById("listaNotificaciones");

  function publicarNotificacion() {
    const texto = document.getElementById("textoNotificacion").value.trim();
    if (texto === "") return;

    const fecha = new Date().toLocaleString("es-ES");
    const notificacion = { texto, fecha };

    // Guardar en localStorage (modo prueba, luego sería en base de datos)
    const todas = JSON.parse(localStorage.getItem("notificacionesReducar") || "[]");
    todas.unshift(notificacion);
    localStorage.setItem("notificacionesReducar", JSON.stringify(todas));

    document.getElementById("textoNotificacion").value = "";
    mostrarNotificaciones();
  }

  function mostrarNotificaciones() {
    const todas = JSON.parse(localStorage.getItem("notificacionesReducar") || "[]");
    listaNotificaciones.innerHTML = "";
    todas.forEach(noti => {
      const box = document.createElement("div");
      box.classList.add("notificacion-publicada");
      box.innerHTML = `
        <div>${noti.texto}</div>
        <div class="notificacion-fecha">${noti.fecha}</div>
      `;
      listaNotificaciones.appendChild(box);
    });
  }

  mostrarNotificaciones();
</script>


<!-- /NOTIFICACIONES REDUCAR  -->

</body>
</html>
