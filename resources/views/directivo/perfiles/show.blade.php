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
        <!-- HEADER REDUCAR -->
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
            <div class="contnotis" style="max-width: 900px; margin: 20px auto;">
                <div class="notis" style="background: #e8f5e9; border-left: 5px solid #007c00;">
                    <strong style="color: #007c00;">✓ {{ session('success') }}</strong>
                </div>
            </div>
        @endif

        <div class="contnotis" style="max-width: 900px;">
            <!-- Info del usuario -->
            <div class="notis" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
                <strong style="font-size: 20px;">Información del Usuario</strong>
                
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px; margin-top: 15px;">
                    <div>
                        <strong style="opacity: 0.9;">Nombre:</strong>
                        <p style="margin: 5px 0; font-size: 16px;">{{ $user->name }}</p>
                    </div>

                    <div>
                        <strong style="opacity: 0.9;">Email:</strong>
                        <p style="margin: 5px 0; font-size: 16px;">{{ $user->email }}</p>
                    </div>

                    <div>
                        <strong style="opacity: 0.9;">Rol:</strong>
                        <p style="margin: 5px 0; font-size: 16px; text-transform: capitalize;">{{ $user->role }}</p>
                    </div>

                    <div>
                        <strong style="opacity: 0.9;">Estado:</strong>
                        <p style="margin: 5px 0; font-size: 16px;">
                            {{ $perfil->bloqueado ? '🔒 Bloqueado' : '🔓 Editable' }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Datos basicos -->
            <div class="notis">
                <strong style="font-size: 18px; color: #007c00;">Datos Básicos</strong>
                
                <div style="margin: 10px 0; padding: 8px; background: #f9f9f9; border-radius: 5px;">
                    <strong>Domicilio:</strong>
                    <p style="margin: 5px 0; font-size: 14px;">{{ $perfil->domicilio }}</p>
                </div>

                <div style="margin: 10px 0; padding: 8px; background: #f9f9f9; border-radius: 5px;">
                    <strong>Número de Emergencia:</strong>
                    <p style="margin: 5px 0; font-size: 14px;">{{ $perfil->numero_emergencia }}</p>
                </div>
            </div>

            <!-- Datos del padre -->
            @if($perfil->nombre_padre || $perfil->telefono_padre || $perfil->dni_padre)
            <div class="notis">
                <strong style="font-size: 18px; color: #007c00;">Datos del Padre</strong>
                
                @if($perfil->nombre_padre)
                <div style="margin: 10px 0; padding: 8px; background: #f9f9f9; border-radius: 5px;">
                    <strong>Nombre:</strong>
                    <p style="margin: 5px 0; font-size: 14px;">{{ $perfil->nombre_padre }}</p>
                </div>
                @endif

                @if($perfil->telefono_padre)
                <div style="margin: 10px 0; padding: 8px; background: #f9f9f9; border-radius: 5px;">
                    <strong>Teléfono:</strong>
                    <p style="margin: 5px 0; font-size: 14px;">{{ $perfil->telefono_padre }}</p>
                </div>
                @endif

                @if($perfil->dni_padre)
                <div style="margin: 10px 0; padding: 8px; background: #f9f9f9; border-radius: 5px;">
                    <strong>DNI:</strong>
                    <p style="margin: 5px 0; font-size: 14px;">{{ $perfil->dni_padre }}</p>
                </div>
                @endif
            </div>
            @endif

            <!-- Datos de la madre -->
            @if($perfil->nombre_madre || $perfil->telefono_madre || $perfil->dni_madre)
            <div class="notis">
                <strong style="font-size: 18px; color: #007c00;">Datos de la Madre</strong>
                
                @if($perfil->nombre_madre)
                <div style="margin: 10px 0; padding: 8px; background: #f9f9f9; border-radius: 5px;">
                    <strong>Nombre:</strong>
                    <p style="margin: 5px 0; font-size: 14px;">{{ $perfil->nombre_madre }}</p>
                </div>
                @endif

                @if($perfil->telefono_madre)
                <div style="margin: 10px 0; padding: 8px; background: #f9f9f9; border-radius: 5px;">
                    <strong>Teléfono:</strong>
                    <p style="margin: 5px 0; font-size: 14px;">{{ $perfil->telefono_madre }}</p>
                </div>
                @endif

                @if($perfil->dni_madre)
                <div style="margin: 10px 0; padding: 8px; background: #f9f9f9; border-radius: 5px;">
                    <strong>DNI:</strong>
                    <p style="margin: 5px 0; font-size: 14px;">{{ $perfil->dni_madre }}</p>
                </div>
                @endif
            </div>
            @endif

            <!-- Datos del tutor -->
            @if($perfil->nombre_tutor || $perfil->telefono_tutor || $perfil->dni_tutor)
            <div class="notis">
                <strong style="font-size: 18px; color: #007c00;">Datos del Tutor</strong>
                
                @if($perfil->nombre_tutor)
                <div style="margin: 10px 0; padding: 8px; background: #f9f9f9; border-radius: 5px;">
                    <strong>Nombre:</strong>
                    <p style="margin: 5px 0; font-size: 14px;">{{ $perfil->nombre_tutor }}</p>
                </div>
                @endif

                @if($perfil->telefono_tutor)
                <div style="margin: 10px 0; padding: 8px; background: #f9f9f9; border-radius: 5px;">
                    <strong>Teléfono:</strong>
                    <p style="margin: 5px 0; font-size: 14px;">{{ $perfil->telefono_tutor }}</p>
                </div>
                @endif

                @if($perfil->dni_tutor)
                <div style="margin: 10px 0; padding: 8px; background: #f9f9f9; border-radius: 5px;">
                    <strong>DNI:</strong>
                    <p style="margin: 5px 0; font-size: 14px;">{{ $perfil->dni_tutor }}</p>
                </div>
                @endif
            </div>
            @endif

            <!-- Personas autorizadas -->
            @if($perfil->personas_autorizadas && count($perfil->personas_autorizadas) > 0)
            <div class="notis">
                <strong style="font-size: 18px; color: #007c00;">Personas Autorizadas a Retirar</strong>
                
                @foreach($perfil->personas_autorizadas as $index => $persona)
                <div style="margin: 15px 0; padding: 10px; background: #f9f9f9; border-radius: 5px; border-left: 3px solid #007c00;">
                    <strong style="color: #007c00;">Persona {{ $index + 1 }}</strong>
                    
                    <div style="margin: 8px 0;">
                        <strong>Nombre:</strong>
                        <p style="margin: 3px 0; font-size: 14px;">{{ $persona['nombre'] }}</p>
                    </div>

                    <div style="margin: 8px 0;">
                        <strong>DNI:</strong>
                        <p style="margin: 3px 0; font-size: 14px;">{{ $persona['dni'] }}</p>
                    </div>

                    @if(isset($persona['telefono']) && $persona['telefono'])
                    <div style="margin: 8px 0;">
                        <strong>Teléfono:</strong>
                        <p style="margin: 3px 0; font-size: 14px;">{{ $persona['telefono'] }}</p>
                    </div>
                    @endif
                </div>
                @endforeach
            </div>
            @endif

            <!-- Acciones del directivo -->
            <div class="notis" style="text-align: center;">
                @if($perfil->bloqueado)
                    <p style="margin-bottom: 15px; font-size: 14px; color: #666;">
                        Este perfil está bloqueado. El usuario no puede editarlo.
                    </p>
                    <form action="{{ route('perfiles.reset', $user) }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="boton editar" onclick="return confirm('¿Seguro que querés desbloquear este perfil?')">
                            🔓 Reestablecer Perfil (permitir edición)
                        </button>
                    </form>
                @else
                    <p style="margin: 0; font-size: 14px; color: #f39c12;">
                        ⚠️ Este perfil está desbloqueado. El usuario puede editarlo.
                    </p>
                @endif

                <a href="{{ route('perfiles.index') }}" class="boton" style="margin-left: 10px;">
                    ← Volver a la lista
                </a>
            </div>
        </div>
    </main>
</body>
</html>