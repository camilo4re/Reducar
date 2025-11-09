<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Completar Perfil</title>
</head>
<body>
    <h1>Completar Perfil del Alumno</h1>

    <form method="POST" action="{{ route('perfil.store') }}">
        @csrf

        <label>Domicilio:</label>
        <input type="text" name="domicilio" required><br>

        <label>Nombre Completo del padre:</label>
        <input type="text" name="nombre_padre"><br>

        <label>DNI del padre:</label>
        <input type="text" name="dni_padre"><br>

        <label>Teléfono del padre:</label>
        <input type="text" name="telefono_padre"><br>

        <label>Nombre Completo de la madre:</label>
        <input type="text" name="nombre_madre"><br>

        <label>DNI de la madre:</label>
        <input type="text" name="dni_madre"><br>

        <label>Teléfono de la madre:</label>
        <input type="text" name="telefono_madre"><br>

        <label>Nombre Completo del tutor:</label>
        <input type="text" name="nombre_tutor"><br>

        <label>DNI del tutor:</label>
        <input type="text" name="dni_tutor"><br>

        <label>Teléfono del tutor:</label>
        <input type="text" name="telefono_tutor"><br>

        <label>Número de emergencia:</label>
        <input type="text" name="numero_emergencia" required><br>

        <button type="submit">Guardar</button>
    </form>
</body>
</html>
