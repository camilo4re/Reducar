<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Materia 1 (Profesor)</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href='https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap' rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('profesor/estilospaginico.css') }}">
</head>
<body>

  <!-- MENU REDUCAR -->
<section class="notificaciones">
  <h2>Editar Trabajo</h2>
      <div class="contnotis">
        
        <form action="{{ route('notas.update', [$materia->id, $periodo, $trabajo->trabajo_titulo]) }}" method="POST" class="formulario-trabajo">
            @csrf
            @method('PUT')
            <div class="trabajos-arriba">

            <div class="demo-izquierda" id="espaciado">
                <label for="trabajo_descripcion">
                     Descripción
                </label>
                <textarea class="inputt" id="trabajo_descripcion" 
                          name="trabajo_descripcion" 
                          rows="3" 
                          placeholder="Descripción adicional del trabajo...">{{ old('trabajo_descripcion', $trabajo->trabajo_descripcion) }}</textarea>
            </div>
            <div class="acciones">
                <button class="boton editar" type="submit" >
                     Actualizar Trabajo
                </button>
                <a class="boton eliminar" href="{{ route('notas.periodo', [$materia->id, $periodo]) }}">
                     Cancelar
                </a>
            </div>
            </div>

            <h3> Notas de los Alumnos</h3>
            <p>Modifica las notas según sea necesario. Deja vacío para eliminar una nota.</p>
<div class="cajafooter">
    <a class="cabecera-trabajo" onclick="toggleNotas(this)">
      <i class="fa-solid fa-chevron-down flecha"></i>
    </a>
          <div class="tabla-notas">
            <table>
                <thead>
                    <tr>
                        <th> Alumno</th>
                        <th>
                             Nota (1-10)
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($alumnos as $alumno)
                        <tr>
                            <td>
                                {{ $alumno->name }}
                            </td>
                            <td style="text-align: center;">
                                <input type="number" 
                                       name="notas[{{ $alumno->id }}]" 
                                       min="1" 
                                       max="10" 
                                       step="0.01"
                                       value="{{ old("notas.{$alumno->id}", $notasActuales[$alumno->id]) }}"
                                       placeholder="-">
                                @error("notas.{$alumno->id}")
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
          </div>
        </div>

            @error('notas')
                <div class="error-message" style="margin-top: 10px; text-align: center;">
                    {{ $message }}
                </div>
            @enderror
        </form>
      </div>  
</section>
<script>
function toggleNotas(element) {
  const tabla = element.nextElementSibling;
  const flecha = element.querySelector('.flecha');
  
  tabla.classList.toggle('mostrar');
  flecha.classList.toggle('girada');
}

</script>

</main>
</body>
</html>