<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Materia 1 (Profesor)</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href='https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap' rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('profesor/estilospaginico.css') }}">
</head>
<body>

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
  <div class="icono-header active" data-tooltip="Notificaciones">
    <i class="fa-solid fa-table-columns"></i>
  </div>
  <div class="icono-header" data-tooltip="Personas">
    <i class="fa-solid fa-users"></i>
  </div>
  <div class="icono-header" data-tooltip="Calificaciones">
    <a href="{{ route('notas.index', $materia->id) }}"><i class="fa-solid fa-clipboard-list"></i></a>
  </div>
  <div class="icono-header" data-tooltip="Asistencias">
    <i class="fa-solid fa-calendar-check"></i></a>
  </div>
</nav>
<!-- /NAV NUEVO -->

    <div>
        @if(session('success'))
            <div>
                {{ session('success') }}
            </div>
        @endif

        <div>
            <h2> @if ($periodo=='intensificacion') <!--si no hacia este if iba a quedar como trabajos del intensificacion xd-->
                Trabajos de intensificacion
            
             @else Trabajos del {{ $periodo=str_replace('-', ' ', $periodo) }}</h2> <!-- std replace es como el .replace del js -->
             @endif</h2>
            
            
             @if(auth()->user()->role !== 'alumno')
            <button>
                <a href="{{ route('notas.create', [$materia->id, $periodo]) }}">
                   Crear Trabajo
                </a>
                </button>
            @endif
        </div>

        @forelse($trabajosConNotas as $trabajoData)
            <div>
                <div>
                    <div>
                        <h3>{{ $trabajoData['trabajo']->trabajo_titulo }}</h3>
                        @if($trabajoData['trabajo']->trabajo_descripcion)
                            <p>
                                {{ $trabajoData['trabajo']->trabajo_descripcion }}
                            </p>
                        @endif
                    </div>
                    @if(auth()->user()->role !== 'alumno')
                        <div>
                            <button>
                            <a href="{{ route('notas.edit', [$materia->id, $periodo, $trabajoData['trabajo']->trabajo_titulo]) }}">
                             Editar
                            </a>

                        </button>
                            <form 
                                  action="{{ route('notas.destroy', [$materia->id, $periodo, $trabajoData['trabajo']->trabajo_titulo]) }}" 
                                  method="POST" 
                                  onsubmit="return confirm('¿Estás seguro de eliminar este trabajo y todas sus notas?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit">
                                 Eliminar
                                </button>
                            </form>
                        </div>
                    @endif
                </div>

                <table>
                    <thead>
                        <tr>
                            <th>Alumno</th>
                            <th>Nota</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($alumnos as $alumno)
                            @php
                                $nota = $trabajoData['notas'][$alumno->id] ?? null;
                                $claseNota = 'nota-vacia';
                                if ($nota !== null) {
                                    $claseNota = $nota >= 6 ? 'nota-aprobado' : 'nota-desaprobado';
                                }
                            @endphp
                            @if(auth()->user()->role !== 'alumno' || auth()->user()->id === $alumno->id)
                                <tr>
                                    <td>{{ $alumno->name }}</td>
                                    <td>
                                        <span class="nota-valor {{ $claseNota }}">
                                            {{ $nota ?? '-' }}
                                        </span>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        @empty
            <div>
                
                <h3>No hay trabajos en este periodo</h3>
                @if(auth()->user()->role !== 'alumno')
                <button>
                    <a href="{{ route('notas.create', [$materia->id, $periodo]) }}">
                        Crear primer trabajo
                    </a>
                </button>
                @endif
            </div>
        @endforelse

        <!-- Navegación -->
        <div>
            <button>
                <a href="{{ route('notas.index', $materia->id) }}">
                     Volver a Notas
                </a>
            </button>
        </div>
    </div>
</main>
</body>
</html>