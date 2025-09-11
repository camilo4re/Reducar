<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Pagina Inicial (Alumnos)</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

        <link href='https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap' rel="stylesheet">
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



    <main class="content">

    <ul class="clases">
          <li class="cajas">
    <form action="{{ route('materias.store') }}" method="POST">
    @csrf
    <div class="titulo-caja">
      <label for="nombre">Nombre de la materia:</label>
      <input type="text" name="nombre" id="nombre" required>
    </div>
    <div class="titulo-caja">
    <label for="curso_id">Curso:</label>
    </div>
    <div class="cajafooter">
    <select name="curso_id" id="curso_id" required>
        <option value="">-- Seleccionar curso --</option>
        @foreach($cursos as $curso)
            <option value="{{ $curso->id }}">{{ $curso->año }} {{ $curso->division }}</option>
        @endforeach
    </select>
<!-- Agregar después del select de curso_id -->
<div class="titulo-caja">
    <label>Horarios de clase:</label>
    <div id="horarios-container">
        <div class="horario-item">
            <select name="horarios[0][dia_semana]" required>
                <option value="">-- Seleccionar día --</option>
                <option value="1">Lunes</option>
                <option value="2">Martes</option>
                <option value="3">Miércoles</option>
                <option value="4">Jueves</option>
                <option value="5">Viernes</option>
                <option value="6">Sábado</option>
            </select>
            <input type="time" name="horarios[0][hora_inicio]" required>
            <input type="time" name="horarios[0][hora_fin]" required>
            <button type="button" onclick="eliminarHorario(this)">Eliminar</button>
        </div>
    </div>
    <button type="button" onclick="agregarHorario()">+ Agregar otro horario</button>
</div>

<script>
let horarioIndex = 1;

function agregarHorario() {
    const container = document.getElementById('horarios-container');
    const div = document.createElement('div');
    div.className = 'horario-item';
    div.innerHTML = `
        <select name="horarios[${horarioIndex}][dia_semana]" required>
            <option value="">-- Seleccionar día --</option>
            <option value="1">Lunes</option>
            <option value="2">Martes</option>
            <option value="3">Miércoles</option>
            <option value="4">Jueves</option>
            <option value="5">Viernes</option>
            <option value="6">Sábado</option>
        </select>
        <input type="time" name="horarios[${horarioIndex}][hora_inicio]" required>
        <input type="time" name="horarios[${horarioIndex}][hora_fin]" required>
        <button type="button" onclick="eliminarHorario(this)">Eliminar</button>
    `;
    container.appendChild(div);
    horarioIndex++;
}

function eliminarHorario(button) {
    button.parentElement.remove();
}
</script>
    <button class="boton" type="submit">Crear materia</button>
       @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
</form>
    </li></ul>
        </div>
</main>
