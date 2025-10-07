<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href='https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap' rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('profesor/estilospaginico.css') }}">
    @stack('styles')
</head>
<body>
    <!-- MENU LATERAL -->
    <button id="abrirMenu">☰</button>
    <nav id="menuLateral" class="cerrado">
        <button id="cerrarMenu">×</button>
        <ul>
            <li><a href="{{ route('materias.index') }}">Inicio <i class="fa-solid fa-house"></i></a></li>
            <li><a href="{{ route('horarios.view') }}">Horarios <i class="fa-solid fa-calendar"></i></a></li>
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

    <!-- HEADER -->
    <header>
        <div class="logo-derecha">
            <img src="{{ asset('/imagenes/LOGOTEC3.png') }}" alt="Logo" class="logo">
        </div>
        <div class="barras">
            <div class="barra-naranja"></div>
            <div class="barra-verde"></div>
        </div>
    </header>

    <main class="content">
        @yield('content')
    </main>

    <script>
        const menu = document.getElementById('menuLateral');
        const abrir = document.getElementById('abrirMenu');
        const cerrar = document.getElementById('cerrarMenu');
        abrir.addEventListener('click', () => { menu.classList.add('abierto'); abrir.classList.add('oculto'); });
        cerrar.addEventListener('click', () => { menu.classList.remove('abierto'); abrir.classList.remove('oculto'); });
    </script>

    @stack('scripts')
</body>
</html>
