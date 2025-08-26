<!DOCTYPE html>
<html lang="es">
<head>
  <title>REDUCAR</title>
  <link rel="stylesheet" href="{{asset('inicio.css')}}">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
  
</head>

  <body class="background-fade">

    <header>
      <div class="logo-del-titulo">
      <img src="{{asset('imagenes/LOGOTEC3.png')}}" alt="Logo" class="logo">
      </div>
  
    <nav>
    <a href="{{ route ('login') }}">Inicio de sesión</a>
    <a href="{{ route ('register') }}">Registrarme</a>
    </nav>

    <div class="barras">
    <div class="barra-naranja"></div>
    <div class="barra-verde"></div>
    </div>
    </header>

      <div class="contenedor-principal">
      <section class="hero">
          <section class="info-destacada">
              <div class="mensaje fade-in-section">
              <h1 class="typewriter-text" id="tituloAnimado"></h1>
              </div>
          </section>

          <div class="logo-central">
           <img src="{{asset('imagenes/LOGOTEC3NUEVO.png')}}" alt="Logo Central">
          </div>
      </section>
      </div>
   
        <main class="contenido">

        
          <section class="fade-in-section info-destacada">
            <div class="texto">
            <h2>¿Quienes somos?</h2>
            <p> La Escuela de Educación Secundaria N.º 3 de San Antonio de Padua es una institución comprometida con la formación integral de jóvenes, brindando una educación pública, gratuita y de calidad, con enfoque en los valores, el pensamiento crítico y la preparación para el mundo profesional y ciudadano. </p>
            </div>
              <div class="imagen">
              <img src="{{asset('imagenes/DIV1.jpg')}}" alt="ejemplo1" class="section-image">
              </div>
          </section>

        <section class="fade-in-section info-destacada">
        <div class="texto">
        <h2>¿Que ofrece?</h2>
        <p> Nuestra propuesta educativa:
        <li>Formación académica de calidad</li>
        <li>Prácticas profesionalizantes</li>
        <li>Participación en ferias, proyectos escolares y actividades interinstitucionales</li>
        <li>Promoción de valores como el respeto, la responsabilidad, el trabajo en equipo y la solidaridad</li>
        </p>
          <p> Orientacion en las areas de:
          <li>Electromecánica</li>
          <li>Informática</li>
          </p>
        </div>
          <div class="imagen">
          <img src="{{asset('imagenes/PASILLO.jpg')}}" alt="Oferta Educativa" class="section-image">
          </div>
        </section>

        <section class="fade-in-section info-destacada">
        <div class="texto">
        <h2>Perfil de Estudiantes</h2>
        <p>La Educación Técnico Profesional brinda títulos técnicos en diferentes especialidades, siguiendo las normas nacionales y adaptándose a las necesidades de cada región.
          Nuestra escuela, con muchos años de historia en San Antonio de Padua (Merlo), siempre se ha destacado por formar técnicos bien preparados, tanto en lo profesional como en lo humano, sabiendo que el conocimiento abre muchas puertas en la vida.
        </p>
        </div>
        <div class="imagen">
        <img src="{{asset('imagenes/PERFIL.jpg')}}" alt="Egresados" class="section-image">
        </div>
        </section>          

        <section class="fade-in-section info-destacada">
          <div class="texto">
            <h2>TÉCNICO DE LA ESPECIALIDAD ELECTROMECÁNICA</h2>
            <p>
              <details>
               <summary style="cursor: pointer; font-weight: bold;">CAPACIDADES</summary>
                <li>PROYECTAR EQUIPOS E INSTALACIONES MECANICAS, ELECTROMECANICAS, DE SISTEMAS NEUMATICOS, OLEOHIDRAULICOS, CIRCUITOS ELÉCTRICOS Y DE CONTROL DE AUTOMATISMOS; HERRAMIENTAS Y DISPOSITIVOS.</li>
                <li>REALIZAR LOS MANTENIMIENTOS, PREDICTIVO, PREVENTIVO, FUNCIONAL OPERATIVO Y CORRECTIVO DE COMPONENTES, EQUIPOS E INSTALACIONES ELECTROMECANICAS.</li>
                <li>REALIZAR ENSAYOS DE MATERIALES Y ENSAYOS ELECTRICOS, MECÂNICOS Y ELECTROMECANICOS.</li>
                <li>INSTALAR LINEAS DE CONSUMO Y DISTRIBUCIÓN DE ENERGIA ELECTRICA DE BAJA Y MEDIA TENSION.</li>
                <li>MONTAR DISPOSITIVOS Y COMPONENTES DE EQUIPOS E INSTALACIONES MECANICAS ELÉCTRICAS, DE SISTEMAS NEUMATICOS, OLEOHIDRAULICOS Y ELECTROMECANICAS.
                <li>GENERAR EMPRENDIMIENTOS.</li>
            </p>
              </details>
          </div>
            <div class="imagen">
            <img src="{{asset('imagenes/ELECTROMECANICA.jpg')}}" alt="Imagen ELECTROMECANICA" class="section-image">
            </div>
        </section>
        
        <section class="fade-in-section info-destacada">
        <div class="texto">
        <h2>TÉCNICO EN INFORMÁTICA PERSONAL Y PROFESIONAL</h2>
        <p>
          <details>
            <summary style="cursor: pointer; font-weight: bold;">CAPACIDADES</summary>
          <li>INTERPRETAR CRITICAMENTE ESPECIFICACIONES FUNCIONALES QUE DEDE REALIZAR UN SOFTWARE, LAS INTERACCIONES CON USUARIOS Y OTROS SISTEMAS.</li>
          <li>PLANIFICAR EL TRABAJO IDENTIFICANDO POSIBLES DIFICULTADES Y EN FUNCION DE LOS TIEMPOS PREVISTOS.</li>
          <li>PRODUCIR PROGRAMAS, MODULOS O COMPONENTES DE SISTEMAS DE COMPUTACIÓN DE ACUERDO A LA TECNOLOGIA A UTILIZAR.</li>
          <li>VERIFICAR EL PRODUCTO DESARROLLADO.</li>
          <li>DEPURAR ESTRUCTURAS LOGICAS O CÓDIGOS DE PROGRAMA.</li>
          <li>REALIZAR LA DOCUMENTACIÓN TÉCNICA Y DE USUARIO DE ACUERDO A LOS REQUERIMIENTOS FUNCIONALES Y TÉCNICOS DE LA APLICACIÓN.</li>
          <li>REALIZAR EL TESTEO DEL SOFTWARE DE APLICACIÓN.</li>
        </p>
          </details>
        </div>
        <div class="imagen">
        <img src="{{asset('imagenes/INFORMATICA.jpg')}}" alt="Imagen informática" class="section-image">
        </div>
        </section>

  </main>
  <footer class="footer-con-fondo">
  <div class="overlay">
    <div class="footer-contenido">
      <div class="columna">
        <h4>Institución</h4>
        <a href="#">Pautas Institucionales</a>
        <a href="#">Autoridades</a>
        <a href="#">Cooperadora</a>
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