<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Materia 1 (Profesor)</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href='https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap' rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('profesor/estilospaginico.css') }}">
 <link rel ="stylesheet" href="{{ asset('profesor/responsive.css') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

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
<!-- /MENU REDUCAR -->

<!-- HEADER REDUCAR -->
<header>
    <div class="header-superior">
        <div class="titulo-izquierda">
            <span class="titulo-principal">{{ $materia->nombre }}</span>
            <span class="subtitulo"> {{ $materia->curso->año }} {{ $materia->curso->division }}</span> 
        </div>
        <img src="/IMAGENES/LOGOTEC3.png" alt="Logo de la escuela" class="logo">
    </div>
    <div class="barras">
        <div class="barra-naranja"></div>
        <div class="barra-verde"></div>
    </div>
</header>

<!-- /HEADER REDUCAR -->

<!-- NAV NUEVO -->
<nav class="header-centro">
    <div class="icono-header" data-tooltip="Notificaciones">
        <a href="{{ route('materias.show', $materia->id) }}"><i class="fa-solid fa-table-columns"></i></a>
    </div>
    <div class="icono-header active" data-tooltip="Personas">
        <a href="{{ route('notas.promedios', $materia->id) }}"><i class="fa-solid fa-users"></i></a>
    </div>
    <div class="icono-header" data-tooltip="Calificaciones">
        <a href="{{ route('notas.index', $materia->id) }}"><i class="fa-solid fa-clipboard-list"></i></a>
    </div>
    <div class="icono-header" data-tooltip="Asistencias">
        <a href="{{ route('asistencias.index', $materia->id) }}"><i class="fa-solid fa-calendar-check"></i></a>
    </div>
</nav>
<!-- /NAV NUEVO -->
<div>
        
<div class="conteinerr">
    <h2>Promedios</h2>
    <div class="contnotis">
        <!-- Tabla de promedios -->
        <table id="tablaPromedios">
    <thead>
        <tr>
            <th>Alumno</th>
            <th>1° Cuatrimestre</th>
            <th>2° Cuatrimestre</th>
            <th>Intensificación</th>
            <th>Promedio General</th>
        </tr>
    </thead>
    <tbody>
        @if(Auth::user()->role === 'alumno')
            {{-- Si es alumno, solo mostrar SUS notas --}}
            @foreach($promedios as $promedio)
                @if($promedio['alumno']->id === Auth::user()->id)
                    <tr>
                        <td>
                            {{ $promedio['alumno']->name }}
                        </td>
                        <td>{{ $promedio['primer_cuatrimestre'] }}</td>
                        <td>{{ $promedio['segundo_cuatrimestre'] }}</td>
                        <td>{{ $promedio['intensificacion'] }}</td>
                        <td>{{ $promedio['general'] }}</td>
                    </tr>
                @endif
            @endforeach
        @elseif(Auth::user()->role === 'profesor' || Auth::user()->role === 'directivo')
            {{-- Si es profesor o directivo, mostrar TODOS los alumnos --}}
            @foreach($promedios as $promedio)
                <tr>
                    <td>
                        {{ $promedio['alumno']->name }}
                    </td>
                    <td>{{ $promedio['primer_cuatrimestre'] }}</td>
                    <td>{{ $promedio['segundo_cuatrimestre'] }}</td>
                    <td>{{ $promedio['intensificacion'] }}</td>
                    <td>{{ $promedio['general'] }}</td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>

<script>
let estadoOrdenamiento = {
    columna: -1,
    ascendente: false
};

// Función para ordenar tabla por columna
function ordenarTabla(indiceColumna) {
    const tabla = document.getElementById('tablaPromedios');
    const tbody = tabla.querySelector('tbody');
    const filas = Array.from(tbody.querySelectorAll('tr'));
    
    // Alternar entre descendente y ascendente si es la misma columna
    if (estadoOrdenamiento.columna === indiceColumna) {
        estadoOrdenamiento.ascendente = !estadoOrdenamiento.ascendente;
    } else {
        // Nueva columna, empezar con descendente (mayor a menor)
        estadoOrdenamiento.columna = indiceColumna;
        estadoOrdenamiento.ascendente = false;
    }
    
    // Ordenar las filas
    filas.sort((a, b) => {
        let valorA, valorB;
        
        if (indiceColumna === 0) {
            // Columna de nombres (alfabético)
            valorA = a.cells[indiceColumna].textContent.trim().toLowerCase();
            valorB = b.cells[indiceColumna].textContent.trim().toLowerCase();
            
            if (estadoOrdenamiento.ascendente) {
                return valorA.localeCompare(valorB);
            } else {
                return valorB.localeCompare(valorA);
            }
        } else {
            // Columnas numéricas
            let textoA = a.cells[indiceColumna].textContent.trim();
            let textoB = b.cells[indiceColumna].textContent.trim();
            
            // Convertir valores a números, tratando "-" como 0
            valorA = textoA === '-' ? -1 : parseFloat(textoA.replace(',', '.'));
            valorB = textoB === '-' ? -1 : parseFloat(textoB.replace(',', '.'));
            
            // Manejar valores NaN
            if (isNaN(valorA)) valorA = -1;
            if (isNaN(valorB)) valorB = -1;
            
            if (estadoOrdenamiento.ascendente) {
                return valorA - valorB;
            } else {
                return valorB - valorA;
            }
        }
    });
    
    // Reordenar las filas en el DOM
    filas.forEach(fila => tbody.appendChild(fila));
    
    // Actualizar indicadores visuales
    actualizarIndicadoresOrdenamiento(indiceColumna);
}

// Función para actualizar los indicadores visuales de ordenamiento
function actualizarIndicadoresOrdenamiento(columnaActiva) {
    const headers = document.querySelectorAll('#tablaPromedios thead th');
    
    headers.forEach((header, index) => {
        // Remover indicadores previos
        header.classList.remove('ordenado-asc', 'ordenado-desc');
        
        // Limpiar iconos previos
        const icono = header.querySelector('.icono-orden');
        if (icono) {
            icono.remove();
        }
        
        // Agregar indicador a la columna activa
        if (index === columnaActiva) {
            const iconoSpan = document.createElement('span');
            iconoSpan.className = 'icono-orden';
            
            if (estadoOrdenamiento.ascendente) {
                header.classList.add('ordenado-asc');
                iconoSpan.innerHTML = ' ↑';
            } else {
                header.classList.add('ordenado-desc');
                iconoSpan.innerHTML = ' ↓';
            }
            
            header.appendChild(iconoSpan);
        }
    });
}

// Inicializar event listeners cuando el DOM esté listo
document.addEventListener('DOMContentLoaded', function() {
    const headers = document.querySelectorAll('#tablaPromedios thead th');
    
    headers.forEach((header, index) => {
        // Hacer todas las columnas ordenables
        header.style.cursor = 'pointer';
        header.style.userSelect = 'none'; // Prevenir selección de texto
        
        // Agregar títulos descriptivos
        switch(index) {
            case 0:
                header.title = 'Clic para ordenar por nombre (A-Z / Z-A)';
                break;
            case 1:
                header.title = 'Clic para ordenar por 1° Cuatrimestre (Mayor-Menor / Menor-Mayor)';
                break;
            case 2:
                header.title = 'Clic para ordenar por 2° Cuatrimestre (Mayor-Menor / Menor-Mayor)';
                break;
            case 3:
                header.title = 'Clic para ordenar por Intensificación (Mayor-Menor / Menor-Mayor)';
                break;
            case 4:
                header.title = 'Clic para ordenar por Promedio General (Mayor-Menor / Menor-Mayor)';
                break;
        }
        
        // Agregar event listener
        header.addEventListener('click', () => {
            ordenarTabla(index);
        });
    });
    
    // Ordenar inicialmente por Promedio General (mayor a menor)
    ordenarTabla(4);
});

</script>

</main>
</body>
</html>