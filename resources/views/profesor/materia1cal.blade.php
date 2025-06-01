<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Materia 1 (Profesor)</title>
    <link rel="stylesheet" href="/ALUMNO/estilospaginico.css">
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
    <a href="/PROFESOR/materia1p.html">Tablón</a>
    <a href="#">Personas</a>
    <a href="#" class="tab-activa">Calificaciones</a>
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

<!-- CALIFICACIONES (P) -->
<section class="tabla-calificaciones">
    <h2>Registro de Calificaciones</h2>
  
    <!-- Botones solo para agregar columnas -->
    <div class="acciones-tabla">
      <button onclick="agregarColumna('primer')">➕ Añadir Actividad Primer Cuatrimestre</button>
      <button onclick="agregarColumna('segundo')">➕ Añadir Actividad Segundo Cuatrimestre</button>
    </div>
  
    <div class="contenedor-tabla">
      <table id="calificaciones">
        <thead>
            <tr>
              <th>#</th>
              <th>Nombre del estudiante</th>
              <th id="cuatri1Header" colspan="2" class="cuatri1">Primer Cuatrimestre</th>
              <th id="cuatri2Header" colspan="2" class="cuatri2">Segundo Cuatrimestre</th>
              <th>Observaciones</th>
              <th>Promedio</th>
            </tr>
            <tr id="subtitulos">
              <th></th>
              <th></th>
              <th class="cuatri1" contenteditable="true">TP1</th>
              <th class="cuatri1" contenteditable="true">Prueba 1</th>
              <th class="cuatri2" contenteditable="true">TP2</th>
              <th class="cuatri2" contenteditable="true">Prueba 2</th>
              
            </tr>
          </thead>
          
          
        <tbody id="cuerpo-tabla">
          <!-- Estas filas se cargarán dinámicamente desde la base de datos -->
        </tbody>
      </table>
    </div>
  </section>
  

  <script>
    function agregarColumna(cuatrimestre) {
      const subtituloRow = document.getElementById("subtitulos");
      const nuevaColumna = document.createElement("th");
      nuevaColumna.setAttribute("contenteditable", "true");
      nuevaColumna.innerText = "Nueva actividad";
      nuevaColumna.classList.add(`cuatri${cuatrimestre === 'primer' ? '1' : '2'}`);
  
      // Botón de eliminar columna
      const botonEliminar = document.createElement("button");
      botonEliminar.innerText = "❌";
      botonEliminar.style.border = "none";
      botonEliminar.style.background = "transparent";
      botonEliminar.style.cursor = "pointer";
      botonEliminar.onclick = () => eliminarColumna(nuevaColumna);
  
      nuevaColumna.appendChild(botonEliminar);
  
      const filas = document.querySelectorAll("#cuerpo-tabla tr");
      const clase = `cuatri${cuatrimestre === 'primer' ? '1' : '2'}`;
  
      if (cuatrimestre === 'primer') {
        const referencia = Array.from(subtituloRow.children).findIndex(th => th.classList.contains("cuatri2"));
        subtituloRow.insertBefore(nuevaColumna, subtituloRow.children[referencia]);
        filas.forEach(fila => {
          const td = document.createElement("td");
          td.contentEditable = true;
          td.classList.add(clase);
          fila.insertBefore(td, fila.children[referencia]);
        });
  
        // Actualizar colspan
        const header = document.getElementById("cuatri1Header");
        header.colSpan = Number(header.colSpan) + 1;
  
      } else {
        subtituloRow.appendChild(nuevaColumna);
        filas.forEach(fila => {
          const td = document.createElement("td");
          td.contentEditable = true;
          td.classList.add(clase);
          fila.appendChild(td);
        });
  
        // Actualizar colspan
        const header = document.getElementById("cuatri2Header");
        header.colSpan = Number(header.colSpan) + 1;
      }
    }
  
    function eliminarColumna(columnaTh) {
      const index = Array.from(columnaTh.parentNode.children).indexOf(columnaTh);
      const cuatrimestre = columnaTh.classList.contains("cuatri1") ? "cuatri1" : "cuatri2";
  
      // Eliminar encabezado
      columnaTh.remove();
  
      // Eliminar celdas
      const filas = document.querySelectorAll("#cuerpo-tabla tr");
      filas.forEach(fila => {
        fila.children[index].remove();
      });
  
      // Actualizar colspan
      const header = document.getElementById(cuatrimestre + "Header");
      header.colSpan = Number(header.colSpan) - 1;
    }
  </script>

<!-- /CALIFICACIONES (P) -->

</body>
</html>
