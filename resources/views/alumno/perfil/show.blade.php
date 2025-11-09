<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Perfil del Alumno</title>
</head>
<body>
    <h1>Perfil del Alumno</h1>

    <p><strong>Domicilio:</strong> {{ $profile->domicilio }}</p>
    <p><strong>Nombre Completo del padre:</strong> {{ $profile->nombre_padre }}</p>
    <p><strong>DNI del padre:</strong> {{ $profile->dni_padre }}</p>
    <p><strong>Teléfono del padre:</strong> {{ $profile->telefono_padre }}</p>
    <p><strong>Nombre Completo de la madre:</strong> {{ $profile->nombre_madre }}</p>
    <p><strong>DNI de la madre:</strong> {{ $profile->dni_madre }}</p>
    <p><strong>Teléfono de la madre:</strong> {{ $profile->telefono_madre }}</p>
    <p><strong>Nombre Completo del tutor:</strong> {{ $profile->nombre_tutor }}</p>
    <p><strong>DNI del tutor:</strong> {{ $profile->dni_tutor }}</p>
    <p><strong>Teléfono del tutor:</strong> {{ $profile->telefono_tutor }}</p>
    <p><strong>Número de emergencia:</strong> {{ $profile->numero_emergencia }}</p>
</body>
</html>
