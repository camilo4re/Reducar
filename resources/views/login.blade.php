<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
    <title>Iniciar Sesión</title>
  <link rel="stylesheet" href="{{ asset("login.css") }}">
<link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
</head>
 <header>

    <title>Iniciar Sesión</title>

  

    <img src="{{ asset("imagenes/LOGOTEC3.png") }}" alt="Logo de la escuela" class="logo">
</header>
  <body class="background">
        <div class="barras">
            <div class="barra-naranja"></div>
            <div class="barra-verde"></div>
        </div>

        <div class="formulario-contenedor">
            <h1>Iniciar Sesión</h1>
            <p>¿No tienes cuenta? <a href="{{ route('register') }}">Regístrate</a></p>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <label>Correo electrónico</label>
                <input type="email" name="email" placeholder="Ingrese su correo" value="{{ old('email') }}" required>
                @error('email')
                    <div class="error">{{ $message }}</div>
                @enderror

                <label>Contraseña</label>
                <input type="password" name="password" placeholder="Ingrese su contraseña" required>
                @error('password')
                    <div class="error">{{ $message }}</div>
                @enderror

                <a href="/olvidaste" class="link-olvide">¿Olvidaste tu contraseña?</a>

                <button type="submit">INGRESAR</button>
            </form>
        </div>
    </body> 
</html>