<!DOCTYPE html>
<html lang="es">
<head>
  <title>RECUPERAR</title>
  <link href="{{ asset('login.css') }}" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
</head>
  
  <body class="background">>
    
      
      <div class="formulario-contenedor">
         <img src="{{asset('imagenes/LOGOTECNICA3.png')}}" alt="Logo" class="logo">
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