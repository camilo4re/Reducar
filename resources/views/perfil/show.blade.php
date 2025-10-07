<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mi Perfil</title>
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
            <li><a href="{{ route('materias.index')}}">Inicio <i class="fa-solid fa-house"></i></a></li>
            <li><a href="{{ route('perfil.show') }}">Mi Perfil <i class="fa-solid fa-user"></i></a></li>
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
        <!-- HEADER REDUCAR -->
        <header>
            <div class="header-superior">
                <div class="titulo-izquierda">
                    <h1 class="titulo-principal">Mi Perfil</h1>
                    <p class="subtitulo">{{ Auth::user()->name }} - {{ Auth::user()->email }}</p>
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
            <div class="contnotis" style="max-width: 800px; margin: 20px auto;">
                <div class="notis" style="background: #e8f5e9; border-left: 5px solid #007c00;">
                    <strong style="color: #007c00;">✓ {{ session('success') }}</strong>
                </div>
            </div>
        @endif

        @if(!$profile)
            <div class="contnotis" style="max-width: 800px;">
                <div class="notis" style="text-align: center;">
                    <strong style="font-size: 18px;">Todavía no completaste tu perfil</strong>
                    <p style="margin: 15px 0;">Para poder usar el sistema completamente, necesitás cargar tus datos personales.</p>
                    <a href="{{ route('perfil.create') }}" class="boton entrar" style="display: inline-block; margin-top: 10px;">
                        Completar Perfil Ahora
                    </a>
                </div>
            </div>
        @else
            <div class="contnotis" style="max-width: 900px;">
                <div class="notis" style="background: #fff3cd; border-left: 5px solid #f39c12;">
                    <p style="margin: 0; font-size: 12px;"><strong>⚠️ Atención:</strong> Tus datos están bloqueados. Si necesitás modificarlos, contactá a un directivo.</p>
                </div>

                <!-- Datos basicos -->
                <div class="notis">
                    <strong style="font-size: 18px; color: #007c00;">Datos Básicos</strong>
                    
                    <div style="margin: 10px 0; padding: 8px; background: #f9f9f9; border-radius: 5px;">
                        <strong>Domicilio:</strong>
                        <p style="margin: 5px 0; font-size: 14px;">{{ $profile->domicilio }}</p>
                    </div>

                    <div style="margin: 10px 0; padding: 8px; background: #f9f9f9; border-radius: 5px;">
                        <strong>Número de Emergencia:</strong>
                        <p style="margin: 5px 0; font-size: 14px;">{{ $profile->numero_emergencia }}</p>
                    </div>
                </div>

                <!-- Datos del padre -->
                @if($profile->nombre_padre || $profile->telefono_padre || $profile->dni_padre)
                <div class="notis">
                    <strong style="font-size: 18px; color: #007c00;">Datos del Padre</strong>
                    
                    @if($profile->nombre_padre)
                    <div style="margin: 10px 0; padding: 8px; background: #f9f9f9; border-radius: 5px;">
                        <strong>Nombre:</strong>
                        <p style="margin: 5px 0; font-size: 14px;">{{ $profile->nombre_padre }}</p>
                    </div>
                    @endif

                    @if($profile->telefono_padre)
                    <div style="margin: 10px 0; padding: 8px; background: #f9f9f9; border-radius: 5px;">
                        <strong>Teléfono:</strong>
                        <p style="margin: 5px 0; font-size: 14px;">{{ $profile->telefono_padre }}</p>
                    </div>
                    @endif

                    @if($profile->dni_padre)
                    <div style="margin: 10px 0; padding: 8px; background: #f9f9f9; border-radius: 5px;">
                        <strong>DNI:</strong>
                        <p style="margin: 5px 0; font-size: 14px;">{{ $profile->dni_padre }}</p>
                    </div>
                    @endif
                </div>
                @endif

                <!-- Datos de la madre -->
                @if($profile->nombre_madre || $profile->telefono_madre || $profile->dni_madre)
                <div class="notis">
                    <strong style="font-size: 18px; color: #007c00;">Datos de la Madre</strong>
                    
                    @if($profile->nombre_madre)
                    <div style="margin: 10px 0; padding: 8px; background: #f9f9f9; border-radius: 5px;">
                        <strong>Nombre:</strong>
                        <p style="margin: 5px 0; font-size: 14px;">{{ $profile->nombre_madre }}</p>
                    </div>
                    @endif

                    @if($profile->telefono_madre)
                    <div style="margin: 10px 0; padding: 8px; background: #f9f9f9; border-radius: 5px;">
                        <strong>Teléfono:</strong>
                        <p style="margin: 5px 0; font-size: 14px;">{{ $profile->telefono_madre }}</p>
                    </div>
                    @endif

                    @if($profile->dni_madre)
                    <div style="margin: 10px 0; padding: 8px; background: #f9f9f9; border-radius: 5px;">
                        <strong>DNI:</strong>
                        <p style="margin: 5px 0; font-size: 14px;">{{ $profile->dni_madre }}</p>
                    </div>
                    @endif
                </div>
                @endif

                <!-- Datos del tutor -->
                @if($profile->nombre_tutor || $profile->telefono_tutor || $profile->dni_tutor)
                <div class="notis">
                    <strong style="font-size: 18px; color: #007c00;">Datos del Tutor</strong>
                    
                    @if($profile->nombre_tutor)
                    <div style="margin: 10px 0; padding: 8px; background: #f9f9f9; border-radius: 5px;">
                        <strong>Nombre:</strong>
                        <p style="margin: 5px 0; font-size: 14px;">{{ $profile->nombre_tutor }}</p>
                    </div>
                    @endif

                    @if($profile->telefono_tutor)
                    <div style="margin: 10px 0; padding: 8px; background: #f9f9f9; border-radius: 5px;">
                        <strong>Teléfono:</strong>
                        <p style="margin: 5px 0; font-size: 14px;">{{ $profile->telefono_tutor }}</p>
                    </div>
                    @endif

                    @if($profile->dni_tutor)
                    <div style="margin: 10px 0; padding: 8px; background: #f9f9f9; border-radius: 5px;">
                        <strong>DNI:</strong>
                        <p style="margin: 5px 0; font-size: 14px;">{{ $profile->dni_tutor }}</p>
                    </div>
                    @endif
                </div>
                @endif

                <!-- Personas autorizadas -->
                @if($profile->personas_autorizadas && count($profile->personas_autorizadas) > 0)
                <div class="notis">
                    <strong style="font-size: 18px; color: #007c00;">Personas Autorizadas a Retirar</strong>
                    
                    @foreach($profile->personas_autorizadas as $index => $persona)
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
            </div>
        @endif
    </main>
</body>
</html>