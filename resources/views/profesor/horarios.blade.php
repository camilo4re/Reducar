<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Horarios (Profesor)</title>
  <link rel="stylesheet" href="/ALUMNO/estilospaginico.css">

</head>
<body>
  <header>
    <img src="/public/IMAGENES/LOGOTEC3.png" alt="Logo de la escuela" class="logo">
  </header>

  <div class="barras">
    <div class="barra-naranja"></div>
    <div class="barra-verde"></div>
  </div>

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

  <main class="horario-container">
    <h2>Horario Semanal</h2>
    <div class="semana-control" style="text-align: center; margin-bottom: 10px;">
      <button onclick="cambiarSemana(-1)">&larr;</button>
      <span id="mesSemana">ABRIL</span>
      <button onclick="cambiarSemana(1)">&rarr;</button>
    </div>
    <div class="tabla-horario">
      <table>
        <thead>
          <tr>
            <th>Hora</th>
            <th id="dia1">Lunes<br>8</th>
            <th id="dia2">Martes<br>9</th>
            <th id="dia3">Miércoles<br>10</th>
            <th id="dia4">Jueves<br>11</th>
            <th id="dia5">Viernes<br>12</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>7:20</td>
            <td>Materia 1</td>
            <td>Materia 2</td>
            <td>Materia 3</td>
            <td>Materia 4</td>
            <td>Materia 5</td>
          </tr>
          <tr>
            <td>9:40</td>
            <td>Materia 6</td>
            <td>Materia 7</td>
            <td>Materia 8</td>
            <td>Materia 9</td>
            <td>Materia 10</td>
          </tr>
          <tr>
            <td>13:00</td>
            <td>Materia 11</td>
            <td>Materia 12</td>
            <td>Materia 13</td>
            <td>Materia 14</td>
            <td>Materia 15</td>
          </tr>
          <tr>
            <td>15:20</td>
            <td>Materia 16</td>
            <td>Materia 17</td>
            <td>Materia 18</td>
            <td>Materia 19</td>
            <td>Materia 20</td>
          </tr>
        </tbody>
      </table>
    </div>
  </main>

  <script>
    const dias = ["Lunes", "Martes", "Miércoles", "Jueves", "Viernes"];
    let fechaBase = new Date(2025, 3, 8); // 8 de abril 2024 (mes 3 porque enero es 0)

    function cambiarSemana(direccion) {
      fechaBase.setDate(fechaBase.getDate() + direccion * 7);

      for (let i = 0; i < 5; i++) {
        const nuevaFecha = new Date(fechaBase);
        nuevaFecha.setDate(fechaBase.getDate() + i);

        const dia = nuevaFecha.getDate();
        const id = "dia" + (i + 1);
        document.getElementById(id).innerHTML = dias[i] + "<br>" + dia;
      }

      const opciones = { month: 'long' };
      const mesNombre = fechaBase.toLocaleDateString('es-ES', opciones).toUpperCase();
      document.getElementById("mesSemana").innerText = mesNombre;
    }
  </script>
</body>
</html>
