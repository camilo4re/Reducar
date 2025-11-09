<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inicie Sesión</title>
    <link href="{{ asset('login.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
</head>

<body class="background">
    <div class="formulario-contenedor">
        <img src="{{asset('imagenes/LOGOTECNICA3.png')}}" alt="Logo" class="logo">
        
        <p>¿No tienes cuenta? <a href="{{ route('register') }}">Regístrate</a></p>

        <form method="POST" action="{{ route('login') }}">
            @csrf
            
            <label>Correo electrónico</label>
            <input type="email" name="email" id="email" placeholder="Ingrese su correo" value="{{ old('email') }}" required>
            @error('email')
                <div class="error">{{ $message }}</div>
            @enderror

            <div id="password-container" class="password-container hidden">
                <label>Contraseña</label ><br>
                <input type="password" name="password" placeholder="Ingrese su contraseña" required>
                @error('password')
                    <div class="error">{{ $message }}</div>
                @enderror
                <br>
                <a href="{{ route('olvidaste') }}" class="link-olvide">¿Olvidaste tu contraseña?</a>
                <br>
                <button type="submit">INGRESAR</button>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('email').addEventListener('blur', function() {
            if (this.value.trim() !== '') {
                const passwordContainer = document.getElementById('password-container');
                passwordContainer.classList.remove('hidden');
                passwordContainer.classList.add('show');
            }
        });
    </script>
</body>
</html>