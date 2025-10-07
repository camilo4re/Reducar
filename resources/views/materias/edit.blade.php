<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Materia</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
        <link rel="icon" type="image/x-icon" href="/IMAGENES/LOGOTECNICA3.png">
        <link href='https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap' rel="stylesheet">
    <link rel="stylesheet" href={{ asset("profesor/estilospaginico.css") }}>
        <link rel ="stylesheet" href={{ asset("profesor/responsive.css") }}>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<!--HEADER REDUCAR -->
<header>
    <div class="logo-derecha">
    <img src="/IMAGENES/LOGOTEC3.png" alt="Logo de la escuela" class="logo">
    </div>
    <div class="barras">
        <div class="barra-naranja"></div>
        <div class="barra-verde"></div>
    </div>
</header>

    <!-- /HEADER REDUCAR -->

    <!-- MENU REDUCAR -->
<button id="abrirMenu">☰</button>

    <nav id="menuLateral" class="cerrado">
    <button id="cerrarMenu">×</button>
    
    <ul>
            <li><a href="{{ route ('materias.index')}}">Inicio <i class="fa-solid fa-house"></i></a></li>

    @if (auth()->user()->role === 'alumno')
    <li><a href="{{ route('calendario.index') }}">Horarios <i class="fa-solid fa-calendar"></i></a></li>
    @endif
        @if (auth()->user()->role === 'alumno' || auth()->user()->role === 'profesor')
    <li><a href="{{ route('perfil.show', Auth::user()->id) }}"> Mis Datos <i class="fa-solid fa-user"></i></a></li>
        @endif
    @if (Auth::user()->role === 'directivo')
    <li><a href="{{ route('tokens.index') }}">Crear Usuarios <i class="fa-solid fa-ticket"></i></a></li>
    <li><a href="{{ route('tokens.listar') }}">Lista de Codigos Creados <i class="fa-solid fa-list"></i></a></li>
    <li><a href="{{ route('perfiles.index') }}">Perfiles de Usuarios<i class="fa-solid fa-user"></i></a></li>
    @endif
 
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
<!-- /MENU REDUCAR-->
    <ul class="clases">
        <li class="cajas">
        <form action="{{ route('materias.update', $materia->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="cajasuperior">
        <div class="titulo-caja">
        <label>Nombre de la materia:</label>
        <input class="inputt" type="text" name="nombre" value="{{ $materia->nombre }}">
        </div>
        <div class="accioness">
        <button class="boton editar" type="submit" >Actualizar</button>
        </div>
        </div>
        <!-- Agregar después del input de nombre -->
        <div class="cajafooter horarioss">
        <div id="horarios-container"> 
        <div class="titulo-caja">
        <label>Horarios de clase:</label>
        @forelse($materia->horarios as $index => $horario)
                <select class="filtro-cursos" name="horarios[{{ $index }}][dia_semana]" required>
                    <option value=""> Seleccionar día </option>
                    <option value="1" {{ $horario->dia_semana == 1 ? 'selected' : '' }}>Lunes</option>
                    <option value="2" {{ $horario->dia_semana == 2 ? 'selected' : '' }}>Martes</option>
                    <option value="3" {{ $horario->dia_semana == 3 ? 'selected' : '' }}>Miércoles</option>
                    <option value="4" {{ $horario->dia_semana == 4 ? 'selected' : '' }}>Jueves</option>
                    <option value="5" {{ $horario->dia_semana == 5 ? 'selected' : '' }}>Viernes</option>
                </select>
                <label>de:</label>
                <input class="inputt" type="time" name="horarios[{{ $index }}][hora_inicio]" value="{{ $horario->hora_inicio }}" required>
                <label>a:</label>
                <input class="inputt" type="time" name="horarios[{{ $index }}][hora_fin]" value="{{ $horario->hora_fin }}" required>
            </div>
        @empty
            <div class="horario-container">
                <select name="horarios[0][dia_semana]" required>
                    <option value="">-- Seleccionar día --</option>
                    <option value="1">Lunes</option>
                    <option value="2">Martes</option>
                    <option value="3">Miércoles</option>
                    <option value="4">Jueves</option>
                    <option value="5">Viernes</option>
                </select>
                <input class="inputt" type="time" name="horarios[0][hora_inicio]" required>
                <input class="inputt" type="time" name="horarios[0][hora_fin]" required>
                <button class="boton eliminar" type="button" onclick="eliminarHorario(this)">Eliminar</button>
            </div>
        @endforelse
            </div>
        

<script>
    let horarioIndex = 1;

    function agregarHorario() {
        const container = document.getElementById('horarios-container');
        const div = document.createElement('div');
        div.className = 'titulo-caja horario-item';
        div.innerHTML = `
            <select class="filtro-cursos" name="horarios[${horarioIndex}][dia_semana]" required>
                <option value=""> Seleccionar día </option>
                <option value="1">Lunes</option>
                <option value="2">Martes</option>
                <option value="3">Miércoles</option>
                <option value="4">Jueves</option>
                <option value="5">Viernes</option>
                <option value="6">Sábado</option>
            </select>
        <label>de:</label>
                <input class="inputt" type="time" name="horarios[0][hora_inicio]" required>
        <label>a:</label>
                <input class="inputt" type="time" name="horarios[0][hora_fin]" required>
            <button class="boton eliminar chico" type="button" onclick="eliminarHorario(this)">Eliminar</button>
        `;
        container.appendChild(div);
        horarioIndex++;
    }

    function eliminarHorario(button) {
        button.parentElement.remove();
    }
    </script>
        <button class="boton entrar chico" type="button" onclick="agregarHorario()">+ Agregar otro horario</button>
</div>
        </form>
    </li>
    </ul>

</main>
</body>
</html>