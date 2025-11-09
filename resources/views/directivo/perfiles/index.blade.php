<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Perfiles</title>
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
                    <h1 class="titulo-principal">Perfiles Cargados</h1>
                    <p class="subtitulo">Lista de todos los alumnos y profesores con perfiles completados</p>
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

        <div class="contnotis" style="max-width: 1200px;">
            @if($perfiles->count() === 0)
                <div class="notis" style="text-align: center; padding: 40px;">
                    <i class="fa-solid fa-inbox" style="font-size: 48px; color: #ccc; margin-bottom: 20px;"></i>
                    <strong style="font-size: 18px; display: block; margin-bottom: 10px;">No hay perfiles cargados todavía</strong>
                    <p style="color: #666;">Los usuarios deben completar sus perfiles para que aparezcan aquí.</p>
                </div>
            @else
                <!-- Tabla de perfiles -->
                <div class="tabla-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Rol</th>
                                <th>Domicilio</th>
                                <th>Emergencia</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($perfiles as $perfil)
                            <tr>
                                <td style="text-align: left;">
                                    <strong>{{ $perfil->user->name }}</strong>
                                </td>
                                <td style="text-align: left;">{{ $perfil->user->email }}</td>
                                <td style="text-transform: capitalize;">{{ $perfil->user->role }}</td>
                                <td style="text-align: left;">{{ Str::limit($perfil->domicilio, 30) }}</td>
                                <td>{{ $perfil->numero_emergencia }}</td>
                                <td style="text-align: center;">
                                    @if($perfil->bloqueado)
                                        <span style="background: #e8f5e9; color: #007c00; padding: 4px 8px; border-radius: 5px; font-size: 12px; font-weight: bold;">
                                            🔒 Bloqueado
                                        </span>
                                    @else
                                        <span style="background: #fff3cd; color: #f39c12; padding: 4px 8px; border-radius: 5px; font-size: 12px; font-weight: bold;">
                                            🔓 Editable
                                        </span>
                                    @endif
                                </td>
                                <td style="text-align: center;">
                                    <a href="{{ route('perfiles.show', $perfil->user) }}" class="boton entrar" style="font-size: 12px; padding: 6px 12px;">
                                        Ver Perfil
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Resumen -->
                <div class="notis" style="margin-top: 20px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; text-align: center;">
                        <div>
                            <strong style="font-size: 28px; display: block;">{{ $perfiles->count() }}</strong>
                            <span style="opacity: 0.9;">Total de Perfiles</span>
                        </div>
                        <div>
                            <strong style="font-size: 28px; display: block;">{{ $perfiles->where('bloqueado', true)->count() }}</strong>
                            <span style="opacity: 0.9;">Bloqueados</span>
                        </div>
                        <div>
                            <strong style="font-size: 28px; display: block;">{{ $perfiles->where('bloqueado', false)->count() }}</strong>
                            <span style="opacity: 0.9;">Editables</span>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </main>
</body>
</html>