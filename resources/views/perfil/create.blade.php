<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Completar Perfil</title>
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
                <h1 class="titulo-principal">Completar Perfil</h1>
                <p class="subtitulo">Por favor completá tus datos personales. Solo podrás hacerlo una vez.</p>
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

    <!-- Mostrar errores de validacion -->
    @if($errors->any())
        <div class="contnotis">
            <div class="notis error">
                <strong>Errores en el formulario:</strong>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <div class="contnotis">
        <form method="POST" action="{{ route('perfil.store') }}">
            @csrf

            <!-- Datos basicos -->
            <div class="notis">
                <strong>Datos Básicos</strong>
                <div class="form-group">
                    <label>Domicilio <span class="required">*</span></label>
                    <input class="inputt" type="text" name="domicilio" value="{{ old('domicilio') }}" required>
                </div>

                <div class="form-group">
                    <label>Número de Emergencia <span class="required">*</span></label>
                    <input class="inputt" type="text" name="numero_emergencia" value="{{ old('numero_emergencia') }}" required>
                </div>
            </div>
@if (Auth::user()->role === 'alumno')
           
    
            <!-- Datos del padre -->
            <div class="notis">
                <strong>Datos del Padre (opcional)</strong>
                <div class="form-group">
                    <label>Nombre Completo</label>
                    <input class="inputt" type="text" name="nombre_padre" value="{{ old('nombre_padre') }}">
                </div>
                <div class="form-group">
                    <label>Teléfono</label>
                    <input class="inputt" type="text" name="telefono_padre" value="{{ old('telefono_padre') }}">
                </div>
                <div class="form-group">
                    <label>DNI</label>
                    <input class="inputt" type="text" name="dni_padre" value="{{ old('dni_padre') }}">
                </div>
            </div>

            <!-- Datos de la madre -->
            <div class="notis">
                <strong>Datos de la Madre (opcional)</strong>
                <div class="form-group">
                    <label>Nombre Completo</label>
                    <input class="inputt" type="text" name="nombre_madre" value="{{ old('nombre_madre') }}">
                </div>
                <div class="form-group">
                    <label>Teléfono</label>
                    <input class="inputt" type="text" name="telefono_madre" value="{{ old('telefono_madre') }}">
                </div>
                <div class="form-group">
                    <label>DNI</label>
                    <input class="inputt" type="text" name="dni_madre" value="{{ old('dni_madre') }}">
                </div>
            </div>

            <!-- Datos del tutor -->
            <div class="notis">
                <strong>Datos del Tutor (opcional)</strong>
                <div class="form-group">
                    <label>Nombre Completo</label>
                    <input class="inputt" type="text" name="nombre_tutor" value="{{ old('nombre_tutor') }}">
                </div>
                <div class="form-group">
                    <label>Teléfono</label>
                    <input class="inputt" type="text" name="telefono_tutor" value="{{ old('telefono_tutor') }}">
                </div>
                <div class="form-group">
                    <label>DNI</label>
                    <input class="inputt" type="text" name="dni_tutor" value="{{ old('dni_tutor') }}">
                </div>
            </div>

            <!-- Personas autorizadas -->
            
            <div class="notis">
                <strong>Personas Autorizadas a Retirar</strong>
                <p class="small-text">Agregá las personas que pueden retirarte de la escuela (opcional)</p>
                
                <div id="personas-container">
                    <!-- Aca se agregan las personas con javascript -->
                </div>

                <button type="button" class="boton" onclick="agregarPersona()">+ Agregar Persona</button>
            </div>
@endif

            <div class="form-submit">
                <button type="submit" class="boton entrar">Guardar Datos</button>
            </div>
        </form>
    </div>
</main>

<script>
    let personaIndex = 0;

    function agregarPersona() {
        const container = document.getElementById('personas-container');
        const personaDiv = document.createElement('div');
        personaDiv.className = 'notis persona';
        personaDiv.innerHTML = `
            <strong>Persona ${personaIndex + 1}</strong>
            <div class="form-group">
                <label>Nombre Completo <span class="required">*</span></label>
                <input class="inputt" type="text" name="personas_autorizadas[${personaIndex}][nombre]" required>
            </div>
            <div class="form-group">
                <label>DNI <span class="required">*</span></label>
                <input class="inputt" type="text" name="personas_autorizadas[${personaIndex}][dni]" required>
            </div>
            <div class="form-group">
                <label>Teléfono</label>
                <input class="inputt" type="text" name="personas_autorizadas[${personaIndex}][telefono]">
            </div>
            <button type="button" class="boton eliminar" onclick="eliminarPersona(this)">Eliminar</button>
        `;
        container.appendChild(personaDiv);
        personaIndex++;
    }

    function eliminarPersona(boton) {
        boton.parentElement.remove();
    }
</script>

</body>
</html>