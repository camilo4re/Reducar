<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>REDUCAR</title>
  <link rel="stylesheet" href="{{ asset('profesor/estilospaginico.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
</head>

<body class="background">
  
  <header>
    <div class="header-superior">
    <div class="titulo-izquierda">
        <h1>PAUTAS INSTITUCIONALES</h1>
      </div>
    <div class="logo-derecha">
        <img src="{{ asset('imagenes/LOGOTEC3.png') }}" alt="Logo de la escuela" class="logo"> 
    </div>
    </div>
    <div class="barras">
      <div class="barra-naranja"></div>
      <div class="barra-verde"></div>
    </div>
  </header>

  <main class="content">
  <div class="flex-container">
    
    <!-- IZQUIERDA: Pautas institucionales -->
    <div class="pautas">
     

      <div class="acordeon">
        <!-- I. GENERALIDADES -->
        <button class="acordeon-btn">I. GENERALIDADES <i class="fas fa-chevron-down"></i></button>
        <div class="acordeon-content">
          <ul>
            <li>La libreta es un medio de comunicación entre la escuela y los padres para informar cualquier dato relacionado con el alumno.</li>
            <li>El alumno deberá concurrir a todas las actividades escolares con la libreta.</li>
            <li>En caso de no concurrir con la libreta se registrará "Ausente con Presencia".</li>
            <li>La libreta debe conservarse en perfectas condiciones por tratarse de un documento oficial.</li>
            <li>Es obligación del padre o responsable notificarse de todas las comunicaciones dentro de las 24 horas de recibidas.</li>
          </ul>
        </div>

        <!-- II. HORARIOS -->
        <button class="acordeon-btn">II. HORARIOS <i class="fas fa-chevron-down"></i></button>
        <div class="acordeon-content">
          <ul>
            <li><strong>Turno Mañana:</strong> 7:10 hs a 11:40 hs.</li>
            <li><strong>Turno Tarde:</strong> 12:50 hs a 17:20 hs.</li>
            <li><strong>Turno Vespertino:</strong> 17:30 hs a 22:00 hs.</li>
            <li>El alumno podrá ser retirado únicamente por personas autorizadas.</li>
            <li>Si no cumple al menos con 2 módulos de clase durante el día, se le computará ausente.</li>
          </ul>
        </div>

        <!-- III. ASISTENCIA E INASISTENCIAS -->
        <button class="acordeon-btn">III. ASISTENCIA E INASISTENCIAS <i class="fas fa-chevron-down"></i></button>
        <div class="acordeon-content">
          <ul>
            <li>La asistencia se computa por jornada.</li>
            <li>En caso de doble turno o contraturno se computará asistencia por actividad.</li>
            <li>Se permite hasta 28 inasistencias anuales bajo estas condiciones:
              <ul>
                <li>A las 10 primeras inasistencias, los padres deben solicitar reincorporación.</li>
                <li>Con 20 inasistencias acumuladas, deberán solicitar segunda reincorporación.</li>
                <li>En casos excepcionales se podrá solicitar extensión de hasta 8 inasistencias más.</li>
                <li>Superadas las 28 inasistencias el alumno deberá rendir las materias afectadas ante comisión evaluadora.</li>
              </ul>
            </li>
          </ul>
        </div>

        <!-- IV. EVALUACIÓN, CALIFICACIÓN Y PROMOCIÓN -->
        <button class="acordeon-btn">IV. EVALUACIÓN, CALIFICACIÓN Y PROMOCIÓN <i class="fas fa-chevron-down"></i></button>
        <div class="acordeon-content">
          <ul>
            <li>El ciclo lectivo se divide en 3 trimestres con calificaciones de 1 a 10.</li>
            <li>La calificación final de cada materia será el promedio de los tres trimestres.</li>
            <li>Requisitos para aprobar:
              <ul>
                <li>Suma mínima de 21 puntos en los tres trimestres.</li>
                <li>Al menos 4 puntos en el tercer informe.</li>
                <li>Al menos 7 puntos en el informe final, cumpliendo régimen de asistencia.</li>
              </ul>
            </li>
            <li>Los alumnos que no aprueben deberán asistir a períodos de orientación y rendir ante comisión evaluadora.</li>
            <li>Turnos de examen:
              <ul>
                <li>Primer turno: desde fin de clases hasta el 30 de diciembre.</li>
                <li>Segundo turno: febrero/marzo.</li>
              </ul>
            </li>
            <li>Para promover al año siguiente se puede adeudar hasta 2 materias y 1 taller.</li>
          </ul>
        </div>

        <!-- V. ACUERDO INSTITUCIONAL DE CONVIVENCIA -->
        <button class="acordeon-btn">V. ACUERDO INSTITUCIONAL DE CONVIVENCIA <i class="fas fa-chevron-down"></i></button>
        <div class="acordeon-content">
          <ul>
            <li>Los alumnos deberán asistir a las actividades aseados y correctamente vestidos.</li>
            <li>No está permitido el uso de piercing, gorras, bermudas, shorts, calzas, musculosas, camisetas de clubes de fútbol, leyendas violentas ni ojotas.</li>
            <li>El establecimiento promueve el uso de la remera o chomba institucional.</li>
            <li>Los objetos de valor no requeridos por la escuela quedan bajo la responsabilidad de los alumnos y sus padres.</li>
            <li>Está prohibido el uso de celulares, netbooks, cámaras o reproductores de música en horas de clase sin autorización expresa.</li>
            <li>No está permitido fumar, consumir bebidas alcohólicas ni sustancias nocivas para la salud dentro del establecimiento.</li>
            <li>Se prohíbe comer y beber dentro del aula durante el horario de clases.</li>
            <li>El alumnado deberá hacer un uso responsable de la infraestructura, mobiliario, materiales de educación física y biblioteca.</li>
            <li>Se deben respetar estrictamente los horarios de ingreso y egreso, evitando deambular durante las clases.</li>
            <li>En caso de conformarse el Consejo Institucional de Convivencia, este determinará las medidas a aplicar en caso de transgresiones.</li>
          </ul>
        </div>

        <!-- VI. MEDIDAS ANTE TRANSGRESIONES -->
        <button class="acordeon-btn">VI. MEDIDAS ANTE TRANSGRESIONES <i class="fas fa-chevron-down"></i></button>
        <div class="acordeon-content">
          <ul>
            <li>Las medidas dependerán de la gravedad del hecho, considerando negligencia, imprudencia, impericia, intencionalidad, perjuicio a terceros o reiteración.</li>
            <li>Las sanciones se clasifican en: <strong>Leves, Moderadas y Graves</strong>.</li>
            <li>Acciones posibles:
              <ul>
                <li>Llamado a la reflexión oral.</li>
                <li>Llamado de atención por escrito.</li>
                <li>Citación a los padres.</li>
                <li>Reparación o reposición del bien afectado.</li>
                <li>Cambio de curso.</li>
                <li>Pase a otro establecimiento.</li>
                <li>Jornadas de reflexión.</li>
              </ul>
            </li>
          </ul>
        </div>

        <!-- VII. OTROS -->
        <button class="acordeon-btn">VII. OTROS <i class="fas fa-chevron-down"></i></button>
        <div class="acordeon-content">
          <ul>
            <li>Para trabajos prácticos de taller se solicitará un bono para solventar los gastos. La preceptora informará el valor a través de la libreta.</li>
            <li>Los alumnos que asistan en bicicleta deberán guardarla en el bicicletero con candado propio.</li>
            <li>Los padres deben concurrir al establecimiento al finalizar cada trimestre para firmar las calificaciones y al final del ciclo para retirar el boletín.</li>
            <li>La inscripción de los alumnos debe realizarse todos los años, independientemente de si promueven o recursan.</li>
          </ul>
        </div>
      </div>
    </div>

    <!-- DERECHA: Cuadro de conductas -->
    <div class="conductas">
      <h2>CUADRO DE CONDUCTAS</h2>
      <table>
        <thead>
          <tr>
            <th>CONDUCTAS ESPERADAS</th>
            <th>CONDUCTAS NO ADMITIDAS</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Cuidado de la vida, la integridad física y moral de las personas.</td>
            <td>
              - Indiferencia frente a situaciones donde corra riesgo la integridad física o moral.<br>
              - Agresiones de cualquier índole.<br>
              - Juegos o acciones peligrosas.<br>
              - Ingreso de alumnos con elementos que pongan en riesgo la integridad y salud.
            </td>
          </tr>
          <tr>
            <td>Relacionarse respetuosamente con los demás integrantes de la institución.</td>
            <td>
              - Maltrato físico o psíquico.<br>
              - Agresión verbal, escrita o física.<br>
              - Discriminación de cualquier tipo.
            </td>
          </tr>
          <tr>
            <td>Uso del diálogo como forma de resolución de conflictos.</td>
            <td>
              - Otras formas de abordar conflictos como agresiones físicas, intimidación, amenazas o abuso de poder.
            </td>
          </tr>
          <tr>
            <td>Sinceridad y honestidad en el accionar cotidiano.</td>
            <td>
              - Mentiras, ocultamientos, falsificaciones y/o adulteración.<br>
              - Plagio de trabajos.
            </td>
          </tr>
          <tr>
            <td>Cuidado de los bienes propios y ajenos, así como de las instalaciones, mobiliario y útiles.</td>
            <td>
              - Dañar o destruir bienes propios y/o ajenos.<br>
              - Dañar instalaciones o mobiliario.<br>
              - Apropiarse, ocultar o extraer elementos que no le pertenecen.
            </td>
          </tr>
          <tr>
            <td>Mantener un clima ordenado de trabajo, privilegiando buenas normas, cortesía y vocabulario apropiado.</td>
            <td>
              - Interrumpir o boicotear el normal desempeño de la clase.<br>
              - Uso del lenguaje inapropiado, grosero, verbal, escrito o gestual.
            </td>
          </tr>
          <tr>
            <td>Asistencia y puntualidad.</td>
            <td>
              - Demorar el ingreso al aula o establecimiento.<br>
              - Eludir la clase.
            </td>
          </tr>
          <tr>
            <td>Solidaridad y cooperación.</td>
            <td>- Negar ayuda.</td>
          </tr>
          <tr>
            <td>Cumplimiento de las normas (vestimenta adecuada, no uso de celulares ni aparatos electrónicos, uso responsable de espacios, seguridad, medio ambiente, etc.).</td>
            <td>- No aceptar o respetar normas institucionales y obligaciones internas.</td>
          </tr>
        </tbody>
      </table>
    </div>
    
  </div>
</main>
<script>
document.addEventListener('DOMContentLoaded', function() {
  const acordeonBtns = document.querySelectorAll('.acordeon-btn');

  acordeonBtns.forEach(btn => {
    btn.addEventListener('click', function() {
      const content = this.nextElementSibling;

      // Animación de abrir/cerrar
      if (content.classList.contains('show')) {
        content.style.maxHeight = null;
        content.classList.remove('show');
      } else {
        content.style.maxHeight = content.scrollHeight + "px";
        content.classList.add('show');
      }

      // Cambiar icono de flecha
      const icon = this.querySelector('i');
      if (icon) {
        icon.classList.toggle('fa-chevron-down');
        icon.classList.toggle('fa-chevron-up');
      }
    });
  });
});

</script>
</body>
</html>
