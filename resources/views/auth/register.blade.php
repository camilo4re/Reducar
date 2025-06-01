<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reducar</title>
    <link rel="stylesheet" href="{{ asset("app.css") }}">


</head>
<body>
    <header>
        <img src="LOGOTEC3.png" alt="Logo de la escuela" class="logo">
    </header>

    <div class="barras">
        <div class="barra-naranja"></div>
        <div class="barra-verde"></div>
    </div>

    <div class="formulario-contenedor">
        <h1>Crea una cuenta</h1>
        <p>¿ya estas registrado? Inicia sesion <a href="/login">click aqui</a></p>

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <label>Nombre y Apellido</label>
            <input type="text" name="name" required>
        
            <label>Email</label>
            <input type="email" name="email" required>
        
            <label>Contraseña</label>
            <input type="password" name="password" required>
        
            <label>Confirmar Contraseña</label>
            <input type="password" name="password_confirmation" required>
        
            <label>Código de inscripción</label>
            <input type="text" name="code" required>
        
            <button type="submit">Registrarse</button>
        </form>
 
    </body>
    </html>