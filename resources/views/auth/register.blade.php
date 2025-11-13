<!DOCTYPE html>
<html lang="es">
<head>
  <title>REGISTRO</title>
  <link rel="stylesheet" href="{{ asset("login.css") }}">
<link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
<link rel ="stylesheet" href="{{ asset('profesor/responsive.css') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body class="background">
    <div class="formulario-contenedor">
        <img src="{{asset('imagenes/LOGOTECNICA3.png')}}" alt="Logo" class="logo">
        <h1>Crea una cuenta</h1>
        <p>¿Ya estás registrado? Inicia sesión <a href="{{ route('login') }}">aquí</a></p>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Nombre -->
            <label for="name">Nombre y Apellido</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" required>
            @error('name')
                <div class="error">{{ $message }}</div>
            @enderror

            <!-- Email -->
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required>
            @error('email')
                <div class="error">{{ $message }}</div>
            @enderror

            <!-- Contraseña -->
            <label for="password">Contraseña</label>
            <input type="password" name="password" id="password" required>
            @error('password')
                <div class="error">{{ $message }}</div>
            @enderror

            <!-- Confirmar Contraseña -->
            <label for="password_confirmation">Confirmar Contraseña</label>
            <input type="password" name="password_confirmation" id="password_confirmation" required>
            @error('password_confirmation')
                <div class="error">{{ $message }}</div>
            @enderror

            <!-- Código de inscripción -->
            <label for="code">Código de inscripción</label>
            <input type="text" name="code" id="code" value="{{ old('code') }}" required>
            @error('code')
                <div class="error">{{ $message }}</div>
            @enderror

            <button type="submit">Registrarse</button>
        </form>
    </div>
</body>
</html>
