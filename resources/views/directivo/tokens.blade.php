<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Generar Usuarios</title>
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
<<<<<<< HEAD
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
=======
            <li><a href="{{ route('materias.index')}}">Inicio <i class="fa-solid fa-house"></i></a></li>
            <li><a href="{{ route('tokens.index') }}">Crear Usuarios <i class="fa-solid fa-ticket"></i></a></li>
            <li><a href="{{ route('tokens.listar') }}">Lista de Usuarios Creados <i class="fa-solid fa-list"></i></a></li>
            <li><a href="{{ route('perfiles.index') }}">Ver Perfiles <i class="fa-solid fa-address-book"></i></a></li>
            <li>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Cerrar Sesión <i class="fa-solid fa-right-from-bracket"></i>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
>>>>>>> FRONTEND
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
                    <h1 class="titulo-principal">Generar Nuevo Usuario</h1>
                    <p class="subtitulo">Creá códigos de registro para alumnos y profesores</p>
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

        <!-- Alertas -->
        @if(session('success'))
            <div class="contnotis" style="max-width: 800px; margin: 20px auto;">
                <div class="notis" style="background: #e8f5e9; border-left: 5px solid #007c00;">
                    <strong style="color: #007c00;">✓ {{ session('success') }}</strong>
                </div>
            </div>
        @endif

        @if($errors->any())
            <div class="contnotis" style="max-width: 800px; margin: 20px auto;">
                <div class="notis" style="background: #fee; border-left: 5px solid #e74c3c;">
                    <strong>Errores:</strong>
                    <ul style="margin: 10px 0; padding-left: 20px;">
                        @foreach($errors->all() as $error)
                            <li style="color: #e74c3c;">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <div class="contnotis" style="max-width: 700px;">
            <div class="notis">
                <strong style="font-size: 18px; color: #007c00; margin-bottom: 20px; display: block;">
                    Completá los datos para generar un código de registro
                </strong>

                <form action="{{ route('tokens.store') }}" method="POST">
                    @csrf
                    
                    <div style="margin: 20px 0;">
                        <label style="display: block; font-weight: 600; margin-bottom: 8px;">
<<<<<<< HEAD
                            Curso <span style="color: red;">*</span>
                        </label>
                        <select name="curso_id" class="filtro-cursos" style="width: 100%;" required>
                            <option value="">Seleccionar curso...</option>
                            @foreach($cursos as $curso)
                                <option value="{{ $curso->id }}" {{ old('curso_id') == $curso->id ? 'selected' : '' }}>
                                    {{ $curso->año }}º {{ $curso->division }}
=======
                            Rol <span style="color: red;">*</span>
                        </label>
                        <select name="role" id="selectRole" class="filtro-cursos" style="width: 100%;" required>
                            <option value="">Seleccionar rol...</option>
                            @foreach($roles as $rol)
                                <option value="{{ $rol }}" {{ old('role') == $rol ? 'selected' : '' }}>
                                    {{ ucfirst($rol) }}
>>>>>>> FRONTEND
                                </option>
                            @endforeach
                        </select>
                    </div>

<<<<<<< HEAD
                    <div style="margin: 20px 0;">
                        <label style="display: block; font-weight: 600; margin-bottom: 8px;">
                            Rol <span style="color: red;">*</span>
                        </label>
                        <select name="role" class="filtro-cursos" style="width: 100%;" required>
                            <option value="">Seleccionar rol...</option>
                            @foreach($roles as $rol)
                                <option value="{{ $rol }}" {{ old('role') == $rol ? 'selected' : '' }}>
                                    {{ ucfirst($rol) }}
=======
                    <div id="divCurso" style="margin: 20px 0;">
                        <label style="display: block; font-weight: 600; margin-bottom: 8px;">
                            Curso <span style="color: red;" id="requiredCurso">*</span>
                        </label>
                        <select name="curso_id" id="selectCurso" class="filtro-cursos" style="width: 100%;" required>
                            <option value="">Seleccionar curso...</option>
                            @foreach($cursos as $curso)
                                <option value="{{ $curso->id }}" {{ old('curso_id') == $curso->id ? 'selected' : '' }}>
                                    {{ $curso->año }}º {{ $curso->division }}
>>>>>>> FRONTEND
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div style="text-align: center; margin-top: 30px;">
                        <button type="submit" class="boton entrar" style="font-size: 16px; padding: 12px 40px;">
                            🎯 Generar Código
                        </button>
                    </div>
                </form>
            </div>

            <!-- Info adicional -->
            <div class="notis" style="background: #e3f2fd; border-left: 5px solid #2196f3;">
                <strong style="color: #1976d2;">ℹ️ Información importante:</strong>
                <ul style="margin: 10px 0; padding-left: 20px; font-size: 13px; color: #555;">
                    <li>El código generado será único y de un solo uso</li>
                    <li>El usuario deberá usar este código al registrarse</li>
                    <li>Se le asignará automáticamente el curso y rol seleccionados</li>
                    <li>Podés ver todos los códigos en "Lista de Usuarios Creados"</li>
                </ul>
            </div>
        </div>
    </main>
<<<<<<< HEAD
=======

    <script>
        // Script para mostrar/ocultar curso segun el rol
        const selectRole = document.getElementById('selectRole');
        const divCurso = document.getElementById('divCurso');
        const selectCurso = document.getElementById('selectCurso');
        const requiredCurso = document.getElementById('requiredCurso');

        selectRole.addEventListener('change', function() {
            if (this.value === 'profesor' || this.value === 'directivo') {
                // Ocultar y deshabilitar el select de curso
                divCurso.style.display = 'none';
                selectCurso.removeAttribute('required');
                selectCurso.value = ''; // Limpiar seleccion
                requiredCurso.style.display = 'none';
            } else {
                // Mostrar y habilitar el select de curso
                divCurso.style.display = 'block';
                selectCurso.setAttribute('required', 'required');
                requiredCurso.style.display = 'inline';
            }
        });

        // Ejecutar al cargar por si hay un rol pre-seleccionado
        if (selectRole.value === 'profesor' || selectRole.value === 'directivo') {
            divCurso.style.display = 'none';
            selectCurso.removeAttribute('required');
        }
    </script>
>>>>>>> FRONTEND
</body>
</html>