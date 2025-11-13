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

        <div class="contnotis">
            @if($perfiles->count() === 0)
                <div class="notis notis-vacio">
                    <i class="fa-solid fa-inbox"></i>
                    <strong>No hay perfiles cargados todavía</strong>
                    <p>Los usuarios deben completar sus perfiles para que aparezcan aquí.</p>
                </div>
            @else
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
                                <td class="text-left"><strong>{{ $perfil->user->name }}</strong></td>
                                <td class="text-left">{{ $perfil->user->email }}</td>
                                <td class="capitalize">{{ $perfil->user->role }}</td>
                                <td class="text-left">{{ Str::limit($perfil->domicilio, 30) }}</td>
                                <td>{{ $perfil->numero_emergencia }}</td>
                                <td class="col-estado">
                                    @if($perfil->bloqueado)
                                        <span class="estado bloqueado">🔒 Bloqueado</span>
                                    @else
                                        <span class="estado editable">🔓 Editable</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('perfiles.show', $perfil->user) }}" class="boton entrar btn-ver">
                                        Ver Perfil
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="notis resumen">
                    <div class="resumen-grid">
                        <div><strong>{{ $perfiles->count() }}</strong><span>Total de Perfiles</span></div>
                        <div><strong>{{ $perfiles->where('bloqueado', true)->count() }}</strong><span>Bloqueados</span></div>
                        <div><strong>{{ $perfiles->where('bloqueado', false)->count() }}</strong><span>Editables</span></div>
                    </div>
                </div>
            @endif
        </div>
    </main>
</body>
</html>
