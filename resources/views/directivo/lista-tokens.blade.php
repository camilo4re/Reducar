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
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Cerrar Sesión <i class="fa-solid fa-right-from-bracket"></i>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    </nav>

    <main class="content">
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
            <div class="contnotis contnotis-success">
                <div class="notis notis-success">
                    <strong>✓ {{ session('success') }}</strong>
                </div>
            </div>
        @endif

        <div class="boton-generar">
            <a href="{{ route('tokens.index') }}" class="boton entrar">+ Generar Nuevo Usuario</a>
        </div>

        <div class="contnotis">
            @if($tokens->count() === 0)
                <div class="notis notis-vacio">
                    <i class="fa-solid fa-inbox"></i>
                    <strong>No hay usuarios creados todavía</strong>
                    <p>Generá el primer código de registro para empezar.</p>
                    <a href="{{ route('tokens.index') }}" class="boton entrar">Generar Primer Usuario</a>
                </div>
            @else
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
                            <tr class="{{ $token->used ? 'fila-usada' : '' }}">
                                <td><code class="token-code">{{ $token->code }}</code></td>
                                <td class="col-curso">{{ $token->curso->año }}º {{ $token->curso->division }}</td>
                                <td>
                                    <span class="rol-tag {{ $token->role }}">{{ $token->role }}</span>
                                </td>
                                <td class="col-estado">
                                    @if($token->used)
                                        <span class="estado usado">✓ Usado</span>
                                    @else
                                        <span class="estado disponible">◉ Disponible</span>
                                    @endif
                                </td>
                                <td>{{ $token->created_at->format('d/m/Y H:i') }}</td>
                                <td class="acciones">
                                    @if(!$token->used)
                                        <form action="{{ route('tokens.marcar-usado', $token->id) }}" method="POST" class="form-usar">
                                            @csrf
                                            <button type="submit" class="boton eliminar" onclick="return confirm('¿Seguro que querés marcar este código como usado?')">
                                                Marcar Usado
                                            </button>
                                        </form>
                                    @else
                                        <span class="sin-accion">-</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="notis resumen">
                    <div class="resumen-grid">
                        <div><strong>{{ $tokens->count() }}</strong><span>Total Generados</span></div>
                        <div><strong>{{ $tokens->where('used', false)->count() }}</strong><span>Disponibles</span></div>
                        <div><strong>{{ $tokens->where('used', true)->count() }}</strong><span>Usados</span></div>
                        <div><strong>{{ $tokens->where('role', 'alumno')->count() }}</strong><span>Alumnos</span></div>
                        <div><strong>{{ $tokens->where('role', 'profesor')->count() }}</strong><span>Profesores</span></div>
                    </div>
                </div>
            @endif
        </div>
    </main>

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

</body>
</html>
