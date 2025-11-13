<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Usuarios Creados</title>
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
                    <h1 class="titulo-principal">Lista de Usuarios Creados</h1>
                    <p class="subtitulo">Todos los códigos de registro generados</p>
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
            <div class="contnotis" style="max-width: 1200px; margin: 20px auto;">
                <div class="notis" style="background: #e8f5e9; border-left: 5px solid #007c00;">
                    <strong style="color: #007c00;">✓ {{ session('success') }}</strong>
                </div>
            </div>
        @endif

        <div style="text-align: center; margin: 20px 0;">
            <a href="{{ route('tokens.index') }}" class="boton entrar">
                + Generar Nuevo Usuario
            </a>
        </div>

        <div class="contnotis" style="max-width: 1200px;">
            @if($tokens->count() === 0)
                <div class="notis" style="text-align: center; padding: 40px;">
                    <i class="fa-solid fa-inbox" style="font-size: 48px; color: #ccc; margin-bottom: 20px;"></i>
                    <strong style="font-size: 18px; display: block; margin-bottom: 10px;">No hay usuarios creados todavía</strong>
                    <p style="color: #666; margin-bottom: 20px;">Generá el primer código de registro para empezar.</p>
                    <a href="{{ route('tokens.index') }}" class="boton entrar">Generar Primer Usuario</a>
                </div>
            @else
                <!-- Tabla de tokens -->
                <div class="tabla-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Curso</th>
                                <th>Rol</th>
                                <th>Estado</th>
                                <th>Fecha de Creación</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tokens as $token)
                            <tr style="{{ $token->used ? 'opacity: 0.6;' : '' }}">
                                <td>
                                    <code style="background: #f0f0f0; padding: 5px 10px; border-radius: 5px; font-weight: bold; letter-spacing: 1px;">
                                        {{ $token->code }}
                                    </code>
                                </td>
                                <td style="text-align: left;">
                                        @if($token->curso)
                                            {{ $token->curso->año }}º {{ $token->curso->division }}
                                        @else
                                        
                                            <span style="color: #888;">Sin Curso Asignado</span>
                                        @endif
                                </td>
                                <td style="text-transform: capitalize;">
                                    <span style="background: {{ $token->role === 'alumno' ? '#e3f2fd' : '#fff3e0' }}; 
                                                color: {{ $token->role === 'alumno' ? '#1976d2' : '#f57c00' }}; 
                                                padding: 4px 10px; 
                                                border-radius: 12px; 
                                                font-size: 12px; 
                                                font-weight: bold;">
                                        {{ $token->role }}
                                    </span>
                                </td>
                                <td style="text-align: center;">
                                    @if($token->used)
                                        <span style="background: #ffebee; color: #c62828; padding: 4px 10px; border-radius: 12px; font-size: 12px; font-weight: bold;">
                                            ✓ Usado
                                        </span>
                                    @else
                                        <span style="background: #e8f5e9; color: #2e7d32; padding: 4px 10px; border-radius: 12px; font-size: 12px; font-weight: bold;">
                                            ◉ Disponible
                                        </span>
                                    @endif
                                </td>
                                <td>{{ $token->created_at ? $token->created_at->format('d/m/Y H:i') : 'Sin fecha' }}</td>
                                <td style="text-align: center;">
                                    @if(!$token->used)
                                        <form action="{{ route('tokens.marcar-usado', $token->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            <button type="submit" class="boton eliminar" style="font-size: 11px; padding: 5px 10px;" 
                                                    onclick="return confirm('¿Seguro que querés marcar este código como usado?')">
                                                Marcar Usado
                                            </button>
                                        </form>
                                    @else
                                        <span style="color: #999;">-</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Resumen -->
                <div class="notis" style="margin-top: 20px; background: linear-gradient(135deg, #17790b 0%, #0bc514 100%); color: white;">
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 20px; text-align: center;">
                        <div>
                            <strong style="font-size: 28px; display: block;">{{ $tokens->count() }}</strong>
                            <span style="opacity: 0.9;">Total Generados</span>
                        </div>
                        <div>
                            <strong style="font-size: 28px; display: block;">{{ $tokens->where('used', false)->count() }}</strong>
                            <span style="opacity: 0.9;">Disponibles</span>
                        </div>
                        <div>
                            <strong style="font-size: 28px; display: block;">{{ $tokens->where('used', true)->count() }}</strong>
                            <span style="opacity: 0.9;">Usados</span>
                        </div>
                        <div>
                            <strong style="font-size: 28px; display: block;">{{ $tokens->where('role', 'alumno')->count() }}</strong>
                            <span style="opacity: 0.9;">Alumnos</span>
                        </div>
                        <div>
                            <strong style="font-size: 28px; display: block;">{{ $tokens->where('role', 'profesor')->count() }}</strong>
                            <span style="opacity: 0.9;">Profesores</span>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </main>
</body>
</html>