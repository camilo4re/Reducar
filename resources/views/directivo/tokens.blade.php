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

        @if(session('success'))
            <div class="contnotis contnotis-success">
                <div class="notis notis-success">
                    <strong>✓ {{ session('success') }}</strong>
                </div>
            </div>
        @endif

        @if($errors->any())
            <div class="contnotis contnotis-error">
                <div class="notis notis-error">
                    <strong>Errores:</strong>
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <div class="contnotis cont-generar">
            <div class="notis">
                <strong class="titulo-form">
                    Completá los datos para generar un código de registro
                </strong>

                <form action="{{ route('tokens.store') }}" method="POST">
                    @csrf
                    
                    <div class="campo-form">
                        <label>Rol <span class="req">*</span></label>
                        <select name="role" id="selectRole" class="filtro-cursos" required>
                            <option value="">Seleccionar rol...</option>
                            @foreach($roles as $rol)
                                <option value="{{ $rol }}" {{ old('role') == $rol ? 'selected' : '' }}>
                                    {{ ucfirst($rol) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div id="divCurso" class="campo-form">
                        <label>Curso <span class="req" id="requiredCurso">*</span></label>
                        <select name="curso_id" id="selectCurso" class="filtro-cursos" required>
                            <option value="">Seleccionar curso...</option>
                            @foreach($cursos as $curso)
                                <option value="{{ $curso->id }}" {{ old('curso_id') == $curso->id ? 'selected' : '' }}>
                                    {{ $curso->año }}º {{ $curso->division }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="boton-centrado">
                        <button type="submit" class="boton entrar">
                            Generar Código
                        </button>
                    </div>
                </form>
            </div>

            <div class="notis info">
                <strong><i></i> Información importante:</strong>
                <ul>
                    <li>El código generado será único y de un solo uso</li>
                    <li>El usuario deberá usar este código al registrarse</li>
                    <li>Se le asignará automáticamente el curso y rol seleccionados</li>
                    <li>Podés ver todos los códigos en "Lista de Usuarios Creados"</li>
                </ul>
            </div>
        </div>
    </main>

    <script>
        const selectRole = document.getElementById('selectRole');
        const divCurso = document.getElementById('divCurso');
        const selectCurso = document.getElementById('selectCurso');
        const requiredCurso = document.getElementById('requiredCurso');

        selectRole.addEventListener('change', function() {
            if (this.value === 'profesor' || this.value === 'directivo') {
                divCurso.style.display = 'none';
                selectCurso.removeAttribute('required');
                selectCurso.value = '';
                requiredCurso.style.display = 'none';
            } else {
                divCurso.style.display = 'block';
                selectCurso.setAttribute('required', 'required');
                requiredCurso.style.display = 'inline';
            }
        });

        if (selectRole.value === 'profesor' || selectRole.value === 'directivo') {
            divCurso.style.display = 'none';
            selectCurso.removeAttribute('required');
        }
    </script>
</body>
</html>
