<?php

namespace App\Http\Controllers;

use App\Models\Nota;
use App\Models\User;
use App\Models\Materia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotaController extends Controller
{
    public function index(Materia $materia)
    {
        $user = Auth::user();

        // tuve que hacer condicionales para saber si el usuario o profesor que quiere entrar a las notas de la materia pertenece a la misma
        if ($user->role === 'alumno' && $user->curso_id !== $materia->curso_id) {
            abort(403, 'No tienes acceso a las notas de esta materia.');
        }
        
        if ($user->role === 'profesor' && $materia->user_id !== $user->id) {
            abort(403, 'No tienes acceso a las notas de esta materia.');
        }

        return view('notas.index', compact('materia'));
    }


    public function mostrarPeriodo(Materia $materia, $periodo)
    {
        $user = Auth::user();
        
        // Verificar permisos
        if ($user->role === 'alumno' && $user->curso_id !== $materia->curso_id) {
            abort(403);
        }
        
        if ($user->role === 'profesor' && $materia->user_id !== $user->id) {
            abort(403);
        }

        // Obtener trabajos únicos del periodo
        $trabajos = Nota::getTrabajosUnicos($materia->id, $periodo);
        
        // Obtener alumnos del curso
        $alumnos = User::where('role', 'alumno')
                      ->where('curso_id', $materia->curso_id)
                      ->orderBy('name')
                      ->get();

        // Para cada trabajo, obtener las notas de todos los alumnos
        $trabajosConNotas = [];
        foreach ($trabajos as $trabajo) {
            $notasDelTrabajo = [];
            foreach ($alumnos as $alumno) {
                $nota = Nota::where('materia_id', $materia->id)
                           ->where('user_id', $alumno->id)
                           ->where('periodo', $periodo)
                           ->where('trabajo_titulo', $trabajo->trabajo_titulo)
                           ->first();
                
                $notasDelTrabajo[$alumno->id] = $nota ? $nota->valor : null;
            }
            
            $trabajosConNotas[] = [
                'trabajo' => $trabajo,
                'notas' => $notasDelTrabajo
            ];
        }

        return view('notas.periodo', compact('materia', 'periodo', 'alumnos', 'trabajosConNotas'));
    }

    /**
     * Crear nuevo trabajo en un periodo
     */
    public function crearTrabajo(Materia $materia, $periodo)
    {
        $user = Auth::user();
        
        // Solo profesores de la materia o directivos
        if ($user->role === 'profesor' && $materia->user_id !== $user->id) {
            abort(403);
        }

        if ($user->role === 'alumno') {
            abort(403);
        }

        $alumnos = User::where('role', 'alumno')
                      ->where('curso_id', $materia->curso_id)
                      ->orderBy('name')
                      ->get();

        return view('notas.crear-trabajo', compact('materia', 'periodo', 'alumnos'));
    }

    /**
     * Guardar nuevo trabajo con notas
     */
    public function guardarTrabajo(Request $request, Materia $materia, $periodo)
    {
        $user = Auth::user();
        
        if ($user->role === 'profesor' && $materia->user_id !== $user->id) {
            abort(403);
        }

        if ($user->role === 'alumno') {
            abort(403);
        }

        $request->validate([
            'trabajo_titulo' => 'required|string|max:100',
            'trabajo_descripcion' => 'nullable|string',
            'notas' => 'required|array',
            'notas.*' => 'nullable|numeric|min:1|max:10'
        ]);

        // Crear las notas para cada alumno
        foreach ($request->notas as $alumno_id => $valor) {
            if ($valor !== null) {
                // Verificar que el alumno pertenezca al curso
                $alumno = User::find($alumno_id);
                if ($alumno && $alumno->curso_id === $materia->curso_id) {
                    Nota::create([
                        'user_id' => $alumno_id,
                        'materia_id' => $materia->id,
                        'periodo' => $periodo,
                        'trabajo_titulo' => $request->trabajo_titulo,
                        'trabajo_descripcion' => $request->trabajo_descripcion,
                        'valor' => $valor
                    ]);
                }
            }
        }

        return redirect()->route('notas.periodo', [$materia->id, $periodo])
                        ->with('success', 'Trabajo creado exitosamente.');
    }

    /**
     * Editar notas de un trabajo específico
     */
    public function editarTrabajo(Materia $materia, $periodo, $trabajo_titulo)
    {
        $user = Auth::user();
        
        if ($user->role === 'profesor' && $materia->user_id !== $user->id) {
            abort(403);
        }

        if ($user->role === 'alumno') {
            abort(403);
        }

        // Obtener el trabajo
        $trabajo = Nota::where('materia_id', $materia->id)
                      ->where('periodo', $periodo)
                      ->where('trabajo_titulo', $trabajo_titulo)
                      ->first();

        if (!$trabajo) {
            abort(404);
        }

        // Obtener alumnos y sus notas
        $alumnos = User::where('role', 'alumno')
                      ->where('curso_id', $materia->curso_id)
                      ->orderBy('name')
                      ->get();

        $notasActuales = [];
        foreach ($alumnos as $alumno) {
            $nota = Nota::where('materia_id', $materia->id)
                       ->where('user_id', $alumno->id)
                       ->where('periodo', $periodo)
                       ->where('trabajo_titulo', $trabajo_titulo)
                       ->first();
            
            $notasActuales[$alumno->id] = $nota ? $nota->valor : null;
        }

        return view('notas.editar-trabajo', compact('materia', 'periodo', 'trabajo', 'alumnos', 'notasActuales'));
    }

    /**
     * Actualizar notas de un trabajo
     */
    public function actualizarTrabajo(Request $request, Materia $materia, $periodo, $trabajo_titulo)
    {
        $user = Auth::user();
        
        if ($user->role === 'profesor' && $materia->user_id !== $user->id) {
            abort(403);
        }

        $request->validate([
            'trabajo_descripcion' => 'nullable|string',
            'notas' => 'required|array',
            'notas.*' => 'nullable|numeric|min:1|max:10'
        ]);

        // Actualizar descripción del trabajo
        Nota::where('materia_id', $materia->id)
            ->where('periodo', $periodo)
            ->where('trabajo_titulo', $trabajo_titulo)
            ->update(['trabajo_descripcion' => $request->trabajo_descripcion]);

        // Actualizar notas
        foreach ($request->notas as $alumno_id => $valor) {
            $nota = Nota::where('materia_id', $materia->id)
                       ->where('user_id', $alumno_id)
                       ->where('periodo', $periodo)
                       ->where('trabajo_titulo', $trabajo_titulo)
                       ->first();

            if ($nota) {
                if ($valor !== null) {
                    $nota->update(['valor' => $valor]);
                } else {
                    $nota->delete();
                }
            } else if ($valor !== null) {
                // Verificar que el alumno pertenezca al curso
                $alumno = User::find($alumno_id);
                if ($alumno && $alumno->curso_id === $materia->curso_id) {
                    Nota::create([
                        'user_id' => $alumno_id,
                        'materia_id' => $materia->id,
                        'periodo' => $periodo,
                        'trabajo_titulo' => $trabajo_titulo,
                        'trabajo_descripcion' => $request->trabajo_descripcion,
                        'valor' => $valor
                    ]);
                }
            }
        }

        return redirect()->route('notas.periodo', [$materia->id, $periodo])
                        ->with('success', 'Trabajo actualizado exitosamente.');
    }

    /**
     * Eliminar un trabajo completo
     */
    public function eliminarTrabajo(Materia $materia, $periodo, $trabajo_titulo)
    {
        $user = Auth::user();
        
        if ($user->role === 'profesor' && $materia->user_id !== $user->id) {
            abort(403);
        }

        if ($user->role === 'alumno') {
            abort(403);
        }

        Nota::where('materia_id', $materia->id)
            ->where('periodo', $periodo)
            ->where('trabajo_titulo', $trabajo_titulo)
            ->delete();

        return redirect()->route('notas.periodo', [$materia->id, $periodo])
                        ->with('success', 'Trabajo eliminado exitosamente.');
    }

    /**
     * Ver promedios de todos los alumnos en la materia
     */
    public function promediosAlumnos(Materia $materia)
    {
        $user = Auth::user();
        
        if ($user->role === 'alumno' && $user->curso_id !== $materia->curso_id) {
            abort(403);
        }
        
        if ($user->role === 'profesor' && $materia->user_id !== $user->id) {
            abort(403);
        }

        $alumnos = User::where('role', 'alumno')
                      ->where('curso_id', $materia->curso_id)
                      ->orderBy('name')
                      ->get();

        $promedios = [];
        foreach ($alumnos as $alumno) {
            $promedioPrimero = Nota::promedioAlumnoPeriodo($alumno->id, $materia->id, 'primer_cuatrimestre');
            $promedioSegundo = Nota::promedioAlumnoPeriodo($alumno->id, $materia->id, 'segundo_cuatrimestre');
            $promedioRecup = Nota::promedioAlumnoPeriodo($alumno->id, $materia->id, 'recuperatorio');
            
            $promedioGeneral = collect([$promedioPrimero, $promedioSegundo, $promedioRecup])
                              ->filter()
                              ->avg();

            $promedios[] = [
                'alumno' => $alumno,
                'primer_cuatrimestre' => $promedioPrimero ? number_format($promedioPrimero, 2) : '-',
                'segundo_cuatrimestre' => $promedioSegundo ? number_format($promedioSegundo, 2) : '-',
                'recuperatorio' => $promedioRecup ? number_format($promedioRecup, 2) : '-',
                'general' => $promedioGeneral ? number_format($promedioGeneral, 2) : '-'
            ];
        }

        return view('notas.promedios', compact('materia', 'promedios'));
    }
}