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
  <div class="icono-header" data-tooltip="Promedios">
    <a href="{{ route('notas.promedios', $materia->id) }}"><i class="fa-solid fa-users"></i></a>
  </div>
  <div class="icono-header active" data-tooltip="Calificaciones">
    <a href="{{ route('notas.index', $materia->id) }}"><i class="fa-solid fa-clipboard-list"></i></a>
  </div>
  <div class="icono-header" data-tooltip="Asistencias">
    <a href="{{ route('asistencias.index', $materia->id) }}"><i class="fa-solid fa-calendar-check"></i></a>
  </div>
</nav>
<!-- /NAV NUEVO -->

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



<!-- /HEADER REDUCAR -->


<!-- /NAV NUEVO -->
    <h2> @if ($periodo=='intensificacion') <!--si no hacia este if iba a quedar como trabajos del intensificacion xd-->
            Trabajos de intensificacion
         @else Trabajos del {{ str_replace('_', ' ', $periodo) }}</h2> <!-- std replace es como el .replace del js -->
         @endif</h2>
        <div class="conteinerr">   
            <div class="contnotis" style="max-width: 800px;">
                <ul class="listanotis">
             @if(auth()->user()->role !== 'alumno')
            <a class="boton entrar" href="{{ route('notas.create', [$materia->id, $periodo]) }}">
               Crear Trabajo
            </a>
            @endif
        
            @forelse($trabajosNotas as $trabajoData)
        
                <li class="notis">
                    <div class="trabajos-arriba">
                        <div class="demo-izquierda">
                    <h3>{{ $trabajoData['trabajo']->trabajo_titulo }}</h3>
                    @if($trabajoData['trabajo']->trabajo_descripcion)
                        <p>{{ $trabajoData['trabajo']->trabajo_descripcion }}</p>
                        @endif
                        <h4>Fecha: {{ \Carbon\Carbon::parse($trabajoData['trabajo']->fecha)->format('d/m/Y') }}</h4>
                        </div>
                        @if(auth()->user()->role !== 'alumno')
                        <div class="acciones">
                            <a class="boton editar" href="{{ route('notas.edit', [$materia->id, $periodo, $trabajoData['trabajo']->trabajo_titulo]) }}">
                             Editar
                            </a>
                            <form 
                                  action="{{ route('notas.destroy', [$materia->id, $periodo, $trabajoData['trabajo']->trabajo_titulo]) }}" 
                                  method="POST" 
                                  onsubmit="return confirm('¿Estás seguro de eliminar este trabajo y todas sus notas?')">
                                @csrf
                                @method('DELETE')
                                <button class="boton eliminar" type="submit">
                                 Eliminar
                                </button>
                            </form>
                        </div>
                    @endif
                    </div>   
<div class="cajafooter">
    <a class="cabecera-trabajo" onclick="toggleNotas(this)">
      <i class="fa-solid fa-chevron-down flecha"></i>
    </a>

  <div class="tabla-notas">
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
  </div>

                </li>
            
        @empty

                <h3>No hay trabajos en este periodo</h3>

        @endforelse


        <!-- Navegación -->
                <a class="boton" href="{{ route('notas.index', $materia->id) }}">
                    Volver a Notas
                </a>
            </ul>
        </div>
    </div>


<script>
function toggleNotas(element) {
  const tabla = element.nextElementSibling;
  const flecha = element.querySelector('.flecha');
  
  tabla.classList.toggle('mostrar');
  flecha.classList.toggle('girada');
}

</script>

</main>
</body>
</html>