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
    <h1>

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
<!-- /MENU REDUCAR -->
<!-- /MENU REDUCAR-->
    <main class="content">

    <ul class="clases">
      <li class="cajas">
        <div class="titulo-caja">Editar Materia</div>
        <div class="titulo-caja">
        <form action="{{ route('materias.update', $materia->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label style="color: black">Nombre:</label>
        
        <input type="text" name="nombre" value="{{ $materia->nombre }}">
        <!-- Agregar después del input de nombre -->
<div class="titulo-caja">
    <label style="color: black">Horarios:</label>
    <div id="horarios-container">
        @forelse($materia->horarios as $index => $horario)
            <div class="horario-item">
                <select name="horarios[{{ $index }}][dia_semana]" required>
                    <option value="">-- Seleccionar día --</option>
                    <option value="1" {{ $horario->dia_semana == 1 ? 'selected' : '' }}>Lunes</option>
                    <option value="2" {{ $horario->dia_semana == 2 ? 'selected' : '' }}>Martes</option>
                    <option value="3" {{ $horario->dia_semana == 3 ? 'selected' : '' }}>Miércoles</option>
                    <option value="4" {{ $horario->dia_semana == 4 ? 'selected' : '' }}>Jueves</option>
                    <option value="5" {{ $horario->dia_semana == 5 ? 'selected' : '' }}>Viernes</option>
                    <option value="6" {{ $horario->dia_semana == 6 ? 'selected' : '' }}>Sábado</option>
                </select>
                <input type="time" name="horarios[{{ $index }}][hora_inicio]" value="{{ $horario->hora_inicio }}" required>
                <input type="time" name="horarios[{{ $index }}][hora_fin]" value="{{ $horario->hora_fin }}" required>
                <button type="button" onclick="eliminarHorario(this)">Eliminar</button>
            </div>
        @empty
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
        @endforelse
    </div>
    <button type="button" onclick="agregarHorario()">+ Agregar otro horario</button>
</div>

<!-- Mismo JavaScript que en create -->
        </div>
        <div class="cajafooter">
        <button type="submit" class="boton editar">Actualizar</button>
        </form>
        </div>
      </li>
    </ul>

</main>
</body>
</html>