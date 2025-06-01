<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Pagina Inicial (Profesores)</title>
    <link rel="stylesheet" href="{{ asset("profesor/estilospaginico.css") }}">
</head>
<body>
  
  <!--HEADER REDUCAR -->
  <header>
    <img src="/IMAGENES/LOGOTEC3.png" alt="Logo de la escuela" class="logo">

    <div class="barras">
        <div class="barra-naranja"></div>
        <div class="barra-verde"></div>
    </div>
</header>

    <!-- /HEADER REDUCAR -->

    <!-- MENU REDUCAR-->
    <button id="abrirMenu">☰</button>

    <nav id="menuLateral" class="cerrado">
    <button id="cerrarMenu">×</button>
    
    <ul>
    <li><a href="/paginicio.html">Inicio</a></li>
    <li><a href="horarios.html">Horarios</a></li>
    <li><a href="inicioprofesor.html">Materias/Cursos</a></li>
    <li><a href="#">Notificaciones</a></li>
    <li><a href="#">Cerrar sesión</a></li>
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
    
    <!-- /MENU REDUCAR-->

    <!-- BOXS DE MATERIAS-->
    <ul class="clases">
      <li class="cajas">
        <div class="titulo-caja">Materia 1</div>
        <div class="subtitulo-caja">Curso 1</div>
        <div class="cajafooter">
          <a href="materia1p.html" class="boton">Entrar</a>
        </div>            
      </li>
  
      <li class="cajas">
        <div class="titulo-caja">Materia 2</div>
        <div class="subtitulo-caja">Curso 2</div>
        <div class="cajafooter">
          <a href="materia1p.html" class="boton">Entrar</a>
        </div>
      </li>
  
      <li class="cajas">
        <div class="titulo-caja">Materia 3</div>
        <div class="subtitulo-caja">Curso 3</div>
        <div class="cajafooter">
          <a href="materia1p.html" class="boton">Entrar</a>
        </div>
      </li>

      <li class="cajas">
          <div class="titulo-caja">Materia 4</div>
          <div class="subtitulo-caja">Curso 4</div>
          <div class="cajafooter">
            <a href="materia1p.html" class="boton">Entrar</a>
          </div>
        </li>
        <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
        <!-- BOXS DE MATERIAS -->