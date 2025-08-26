<!DOCTYPE html>
<html lang="es">
<head>
  <title>RECUPERAR</title>
  <link href="{{ asset('login.css') }}" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
</head>
  <header>
          <img src="{{ asset("imagenes/LOGOTEC3.png") }}" alt="Logo de la escuela" class="logo">
      </header>
  <div class="barras">
          <div class="barra-naranja"></div>
          <div class="barra-verde"></div>
      </div>
  
  <body class="background">>
    
      
      <div class="formulario-contenedor">
          <h1>Recuperar Contraseña</h1>
          <p>Ingrese su correo y le enviaremos instrucciones</p>
  
          <form>
              <label>Correo electrónico</label>
              <input type="email" placeholder="Ingrese su correo" required>
  
              <button type="submit">ENVIAR CORREO</button>
          </form>
  
          <p><a href="{{ route('login') }}">Volver a Iniciar Sesión</a></p>
      </div>

    </body>
</html>