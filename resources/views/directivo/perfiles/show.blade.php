<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Perfil de {{ $user->name }}</title>
    <link rel="icon" type="image/x-icon" href="/IMAGENES/LOGOTECNICA3.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href='https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap' rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('profesor/estilospaginico.css') }}">
    <link rel="stylesheet" href="{{ asset('profesor/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('profesor/perfil.css') }}">
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
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
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
        <header>
            <div class="header-superior">
                <div class="titulo-izquierda">
                    <h1 class="titulo-principal">Perfil de {{ $user->name }}</h1>
                    <p class="subtitulo">Información completa del alumno/profesor</p>
                </div>
                <div class="logo-derecha">
                    <img src="/IMAGENES/LOGOTEC3.png" alt="Logo de la escuela" class="logo">
                </div>
            </div>
            <div class="barras">
                <div class="barra-naranja"></div>
                <div class="barra-verde"></div>
            </div>
        </header>

        @if(session('success'))
            <div class="contnotis contnotis-success">
                <div class="notis notis-success">
                    <strong>✓ {{ session('success') }}</strong>
                </div>
            </div>
        @endif

        <div class="contnotis perfil-container">
            <!-- Información general -->
            <div class="notis perfil-info">
                <strong>Información del Usuario</strong>
                <div class="perfil-grid">
                    <div><strong>Nombre:</strong><p>{{ $user->name }}</p></div>
                    <div><strong>Email:</strong><p>{{ $user->email }}</p></div>
                    <div><strong>Rol:</strong><p class="capitalize">{{ $user->role }}</p></div>
                    <div><strong>Estado:</strong><p>{{ $perfil->bloqueado ? '🔒 Bloqueado' : '🔓 Editable' }}</p></div>
                </div>
            </div>

            <!-- Datos básicos -->
            <div class="notis seccion">
                <strong class="titulo-seccion">Datos Básicos</strong>
                <div class="dato"><strong>Domicilio:</strong><p>{{ $perfil->domicilio }}</p></div>
                <div class="dato"><strong>Número de Emergencia:</strong><p>{{ $perfil->numero_emergencia }}</p></div>
            </div>

            <!-- Datos del padre -->
            @if($perfil->nombre_padre || $perfil->telefono_padre || $perfil->dni_padre)
            <div class="notis seccion">
                <strong class="titulo-seccion">Datos del Padre</strong>
                @if($perfil->nombre_padre)
                    <div class="dato"><strong>Nombre:</strong><p>{{ $perfil->nombre_padre }}</p></div>
                @endif
                @if($perfil->telefono_padre)
                    <div class="dato"><strong>Teléfono:</strong><p>{{ $perfil->telefono_padre }}</p></div>
                @endif
                @if($perfil->dni_padre)
                    <div class="dato"><strong>DNI:</strong><p>{{ $perfil->dni_padre }}</p></div>
                @endif
            </div>
            @endif

            <!-- Datos de la madre -->
            @if($perfil->nombre_madre || $perfil->telefono_madre || $perfil->dni_madre)
            <div class="notis seccion">
                <strong class="titulo-seccion">Datos de la Madre</strong>
                @if($perfil->nombre_madre)
                    <div class="dato"><strong>Nombre:</strong><p>{{ $perfil->nombre_madre }}</p></div>
                @endif
                @if($perfil->telefono_madre)
                    <div class="dato"><strong>Teléfono:</strong><p>{{ $perfil->telefono_madre }}</p></div>
                @endif
                @if($perfil->dni_madre)
                    <div class="dato"><strong>DNI:</strong><p>{{ $perfil->dni_madre }}</p></div>
                @endif
            </div>
            @endif

            <!-- Datos del tutor -->
            @if($perfil->nombre_tutor || $perfil->telefono_tutor || $perfil->dni_tutor)
            <div class="notis seccion">
                <strong class="titulo-seccion">Datos del Tutor</strong>
                @if($perfil->nombre_tutor)
                    <div class="dato"><strong>Nombre:</strong><p>{{ $perfil->nombre_tutor }}</p></div>
                @endif
                @if($perfil->telefono_tutor)
                    <div class="dato"><strong>Teléfono:</strong><p>{{ $perfil->telefono_tutor }}</p></div>
                @endif
                @if($perfil->dni_tutor)
                    <div class="dato"><strong>DNI:</strong><p>{{ $perfil->dni_tutor }}</p></div>
                @endif
            </div>
            @endif

            <!-- Personas autorizadas -->
            @if($perfil->personas_autorizadas && count($perfil->personas_autorizadas) > 0)
            <div class="notis seccion">
                <strong class="titulo-seccion">Personas Autorizadas a Retirar</strong>
                @foreach($perfil->personas_autorizadas as $index => $persona)
                    <div class="persona">
                        <strong class="subtitulo-persona">Persona {{ $index + 1 }}</strong>
                        <div><strong>Nombre:</strong><p>{{ $persona['nombre'] }}</p></div>
                        <div><strong>DNI:</strong><p>{{ $persona['dni'] }}</p></div>
                        @if(isset($persona['telefono']) && $persona['telefono'])
                            <div><strong>Teléfono:</strong><p>{{ $persona['telefono'] }}</p></div>
                        @endif
                    </div>
                @endforeach
            </div>
            @endif

            <!-- Acciones -->
            <div class="notis acciones">
                @if($perfil->bloqueado)
                    <p class="texto-bloqueado">Este perfil está bloqueado. El usuario no puede editarlo.</p>
                    <form action="{{ route('perfiles.reset', $user) }}" method="POST" class="form-reset">
                        @csrf
                        <button type="submit" class="boton editar" onclick="return confirm('¿Seguro que querés desbloquear este perfil?')">
                            🔓 Reestablecer Perfil (permitir edición)
                        </button>
                    </form>
                @else
                    <p class="texto-desbloqueado">⚠️ Este perfil está desbloqueado. El usuario puede editarlo.</p>
                @endif
                <a href="{{ route('perfiles.index') }}" class="boton volver">← Volver a la lista</a>
            </div>
        </div>
    </main>
</body>
</html>
