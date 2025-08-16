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
    <h1>

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
    <select name="curso_id" id="curso_id" required>
        <option value="">-- Seleccionar curso --</option>
        @foreach($cursos as $curso)
            <option value="{{ $curso->id }}">{{ $curso->año }} {{ $curso->division }}</option>
        @endforeach
    </select>

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
 </body>
</html>