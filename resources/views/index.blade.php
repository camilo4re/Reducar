<!DOCTYPE html>
<html lang="es">
<head>
  <title>REDUCAR</title>
  <link rel="stylesheet" href="{{asset('inicio.css')}}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
</head>

<body class="background-fade">
<!-- header -->
<header>
  <div class="superior">
    <div class ="texto-animado">
      <h1 class="typewriter-text" id="tituloAnimado"></h1>
    </div>
  
    <div class="logo-del-titulo">
      <img src="{{asset('imagenes/LOGOTECNICA3.png')}}" alt="Logo" class="logo">
    </div>

    <nav class="navegacion">
      <a href="{{ route ('login') }}"><i class="fas fa-sign-in-alt"></i> Inicio de sesión</a>
      <a href="{{ route ('register') }}"><i class="fas fa-user-plus"></i> Registrarme</a>
    </nav>
  </div>

  <div class="barras">
    <div class="barra-naranja"></div>
    <div class="barra-verde"></div>
  </div>
</header>

<div class="contenedor-principal">
  <section class="hero">
    <section class="info-destacada"></section>
    <div class="logo-central">
      <img src="{{asset('imagenes/LOGOTEC3NUEVO.png')}}" alt="Logo Central">
    </div>
  </section>
</div>

<!-- cuerpo -->
<div class="cuerpo">


<div class="seccion-tecnica secciones">
  <h2>ESCUELA TÉCNICA 3: TU PASAPORTE HACIA EL FUTURO PROFESIONAL</h2>
  <p>La Educación Técnico Profesional es, hoy más que nunca, la inversión más inteligente para tu futuro. En la Técnica 3, especializada en Informática y Electromecánica, formamos profesionales preparados para afrontar los desafíos del mundo laboral con conocimientos sólidos, experiencia práctica y una visión innovadora.</p>
  
  <!-- imágen -->
  <div class="imagen-destacada">
    <img src="{{asset('imagenes/PASILLO.jpg')}}" alt="Escuela pasillo">
  </div>
</div>


  
  <div class="seccion-tecnica secciones">
    <h2>📊 EL PANORAMA ACTUAL (2025)</h2>
    <p>En Argentina existen más de 1.600 instituciones de educación técnica secundaria. La demanda de técnicos altamente capacitados crece día a día, especialmente en las áreas de Informática y Electromecánica, donde la necesidad de profesionales competentes es enorme.</p>
    <p>En la Técnica 3, nos enfocamos en brindar una formación integral que combine la teoría con experiencias prácticas en laboratorio, proyectos y ferias de ciencia, asegurando que cada estudiante esté preparado para enfrentar el mundo laboral desde el primer día.</p>
  </div>

 
  <div class="seccion-tecnica secciones">
    <h2>💰 SALIDA LABORAL Y REMUNERACIÓN</h2>
    <h3>Técnico en Informática</h3>
    <ul class="lista-ventajas">
      <li>Amplia demanda laboral en áreas de programación, redes, ciberseguridad, inteligencia artificial y desarrollo de software.</li>
      <li>Posibilidad de ingresar a empresas líderes desde el secundario o continuar con carreras universitarias afines.</li>
      <li>Crecimiento profesional asegurado en un sector dinámico y en constante innovación.</li>
    </ul>

    <h3>Técnico en Electromecánica</h3>
    <ul class="lista-ventajas">
      <li>Salarios competitivos: un técnico electromecánico puede alcanzar ingresos promedio muy por encima de la media nacional.</li>
      <li>Versatilidad para trabajar en mantenimiento industrial, control de procesos, automatización, energías renovables y mecatrónica.</li>
      <li>Capacidad de desempeñarse como profesional independiente o integrarse a equipos de alta especialización.</li>
    </ul>
  </div>

  
  <div class="seccion-tecnica secciones">
    <h2>🎯 ESPECIALIDADES Y OPORTUNIDADES</h2>
    <h3>Informática</h3>
    <ul class="lista-ventajas">
      <li>Desarrollo de software y aplicaciones móviles</li>
      <li>Robótica y automatización</li>
      <li>Redes y sistemas</li>
      <li>Ciberseguridad</li>
      <li>Inteligencia Artificial</li>
    </ul>
    <h3>Electromecánica</h3>
    <ul class="lista-ventajas">
      <li>Automatización industrial y robótica</li>
      <li>Mantenimiento y control de procesos</li>
      <li>Energías renovables</li>
      <li>Mecatrónica y modelado por computadora</li>
    </ul>
  </div>

  
  <div class="seccion-tecnica secciones">
    <h2>🔬 FERIAS DE CIENCIA Y PROYECTOS</h2>
    <p>Nuestros estudiantes participan activamente en ferias de ciencia y tecnología, presentando proyectos reales que reflejan su creatividad y conocimiento técnico:</p>
    <ul class="lista-ventajas">
      <li>Robótica aplicada: desde asistentes domésticos hasta soluciones industriales</li>
      <li>Aplicaciones móviles: herramientas que resuelven problemas concretos de la comunidad</li>
      <li>Sistemas de automatización y eficiencia energética</li>
      <li>Proyectos interdisciplinarios en impresión 3D, energía solar y mecatrónica</li>
    </ul>

    <!-- imágenes -->
    <div class="galeria-ferias">
  <!-- Tarjeta 1 -->
  <div class="tarjeta-feria">
    <img src="{{asset('imagenes/Feedo.jpeg')}}" alt="Proyecto Feedo"> Proeycto Feedo
    <p class="descripcion">Alumnos de 7º 2ª que participaron en la competencia Remanso 2025.</p>
  </div>

  <!-- Tarjeta 2 -->
  <div class="tarjeta-feria">
    <img src="{{asset('imagenes/PERFIL.jpg')}}" alt="Electromecánica "> Electromecánica 2024
    <p class="descripcion">Egresados del ciclo de Electromecánica participaron en la competencia Remanso 2024.</p>
  </div>

  <!-- Tarjeta 3 -->
  <div class="tarjeta-feria">
    <img src="{{asset('imagenes/Elisyum.jpeg')}}" alt="Proyecto Elisyum">Proyecto Elisyum
    <p class="descripcion">Los alumnos de 7º 2ª participaron en la competencia Remanso 2025, obteniendo el 7º puesto.</p>
  </div>
</div>


  
  <div class="seccion-tecnica secciones">
    <h2>💼 PRÁCTICAS Y EXPERIENCIA LABORAL</h2>
    <ul class="lista-ventajas">
      <li>Prácticas profesionalizantes en empresas reales desde los últimos años del secundario</li>
      <li>Red de contactos industriales para facilitar la inserción laboral</li>
      <li>Experiencia concreta que otorga ventaja competitiva al egresar</li>
      <li>Posibilidad de empleo inmediato al finalizar la formación</li>
    </ul>
  </div>

  <div class="seccion-tecnica secciones">
    <h2>🎓 CONTINUIDAD ACADÉMICA</h2>
    <ul class="lista-ventajas">
      <li>Tecnicaturas superiores</li>
      <li>Carreras universitarias afines, con materias acreditadas</li>
      <li>Cursos de especialización en áreas tecnológicas y de innovación</li>
    </ul>
  </div>

 
  <div class="seccion-tecnica secciones">
    <h2>🔥 EXPERIENCIAS Y ACTIVIDADES EXCLUSIVAS</h2>
    <ul class="lista-ventajas">
      <li>Laboratorios con equipamiento de última generación</li>
      <li>Talleres industriales reales</li>
      <li>Participación en olimpiadas técnicas nacionales</li>
      <li>Intercambios y visitas a empresas del sector</li>
      <li>Proyectos interdisciplinarios y competiciones STEAM</li>
    </ul>
  </div>

  
  <div class="seccion-tecnica secciones">
    <h2>🚀 POR QUÉ ELEGIR TÉCNICA 3</h2>
    <ul class="lista-ventajas">
      <li>Demanda laboral inmediata: empresas necesitan técnicos calificados</li>
      <li>Salarios competitivos desde el primer día</li>
      <li>Crecimiento profesional asegurado, con posibilidad de roles de liderazgo</li>
      <li>Emprendimiento: conocimientos para crear tu propia empresa</li>
      <li>Futuro asegurado: en sectores estratégicos y en constante desarrollo</li>
    </ul>
  </div>


  <div class="seccion-tecnica secciones">
    <h2>🎯 LA DECISIÓN INTELIGENTE</h2>
    <p>No es solo una escuela, es tu plataforma de lanzamiento hacia un futuro profesional exitoso. Al egresar de Técnica 3, obtendrás:</p>
    <ul class="lista-ventajas">
      <li>Título técnico reconocido</li>
      <li>Experiencia práctica real</li>
      <li>Contactos en la industria</li>
      <li>Conocimientos actualizados</li>
      <li>Capacidad de resolver problemas complejos</li>
    </ul>
    <p class="info-extra">Si querés un futuro seguro, innovador y lleno de oportunidades, Técnica 3 es tu camino. Tu carrera profesional comienza aquí.</p>
  </div>

</div>


<!-- footer -->
<footer class="footer-con-fondo visible">
  <div class="overlay">
    <div class="footer-contenido">
      <div class="columna">
        <h4>Institución</h4>
        <a href="{{asset('pautas')}}">Pautas Institucionales</a>
        <a href="{{asset('autoridades')}}">Autoridades</a>
        
      </div>
      <div class="columna">
        <h4>Contacto</h4>
        <a href="tel:02204863633">Teléfono</a>
        <a href="mailto:eest3merlo@abc.gob.ar">Correo</a>
        <a href="https://www.facebook.com/tecnicapadua?locale=es_LA">Facebook</a>
        <a href="https://maps.app.goo.gl/W4cb5HA7te56tkjS7">Ubicación</a>
      </div>
    </div>
    <div class="footer-copy">
      © 2025 Reducar - Todos los derechos reservados
    </div>
  </div>
</footer>

<script src="{{ asset('script.js') }}"></script>
</body>
</html>
