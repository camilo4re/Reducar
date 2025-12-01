<?php

namespace App\Http\Controllers;

use App\Models\Asistencia;
use App\Models\User;
use App\Models\Materia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AsistenciaController extends Controller
{
    public function rutas(Materia $materia)
    {
        $user = Auth::user();

        if ($user->role == 'alumno' && $user->curso_id !== $materia->curso_id) {
            abort(403, 'No tienes acceso a las asistencias de esta materia.');
        }
        if ($user->role == 'profesor' && $materia->user_id !== $user->id) {
            abort(403, 'No tienes acceso a las asistencias de esta materia.');
        }
    }

    public function index(Materia $materia, Request $request)
    {
        $this->rutas($materia);

        $year = $request->get('year', date('Y'));
        $month = $request->get('month', date('m'));

        $alumnos = User::where('role', 'alumno')->where('curso_id', $materia->curso_id)->orderBy('name')->get();

        $fechas = Asistencia::generarFechasDelMes($year, $month, $materia->id);

        $asistencias = [];
        
        foreach ($alumnos as $alumno) {
            $asistenciasAlumno = [];

            foreach ($fechas as $fecha) {
                $asistencia = Asistencia::where('user_id', $alumno->id)->where('materia_id', $materia->id)->where('fecha', $fecha)->first();
                
                $asistenciasAlumno[$fecha] = $asistencia ? $asistencia->estado : null;
            }

            $porcentaje = Asistencia::porcentajeAsistencia($alumno->id, $materia->id);

            $asistencias[$alumno->id] = [
                'alumno' => $alumno,
                'user_id' => $alumno->id,
                'asistencias' => $asistenciasAlumno,
                'porcentaje' => $porcentaje
            ];
        }

        return view('asistencias.index', compact('materia', 'alumnos', 'fechas', 'asistencias', 'year', 'month'));
    }

    public function marcar(Request $request, Materia $materia)
    {
        $this->rutas($materia);

        $request->validate([
            'user_id' => 'required',
            'fecha' => 'required|date',
            'estado' => 'required'
        ]);

        $alumno = User::findOrFail($request->user_id);
        
        if ($alumno->curso_id !== $materia->curso_id) {
            abort(403, 'El alumno no pertenece a este curso.');
        }

        Asistencia::updateOrCreate(
            [
                'user_id' => $request->user_id,
                'materia_id' => $materia->id,
                'fecha' => $request->fecha
            ],
            [
                'estado' => $request->estado
            ]
        );

        return redirect()->route('asistencias.index', ['materia' => $materia->id,'year' => date('Y', strtotime($request->fecha)),'month' => date('m', strtotime($request->fecha))
            ]);
    }

    public function eliminar(Request $request, Materia $materia)
    {
        $this->rutas($materia);

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'fecha' => 'required|date'
        ]);

        Asistencia::where('user_id', $request->user_id)->where('materia_id', $materia->id)->where('fecha', $request->fecha)->delete();

        return redirect()
            ->route('asistencias.index', [
                'materia' => $materia->id,
                'year' => date('Y', strtotime($request->fecha)),
                'month' => date('m', strtotime($request->fecha))
            ]);
    }

    // Reporte de asistencias
    public function reporte(Materia $materia, Request $request)
    {
        $this->rutas($materia);

        $year = $request->get('year', date('Y'));
        $month = $request->get('month', date('m'));
        $user = Auth::user();

        $alumnos = User::where('role', 'alumno')
                      ->where('curso_id', $materia->curso_id)
                      ->orderBy('name')
                      ->get();

        $reportes = [];
        
        if ($user->role == 'alumno') {
            $totalDias = Asistencia::where('user_id', $user->id)->where('materia_id', $materia->id)->whereYear('fecha', $year)->count();
            $presentes = Asistencia::where('user_id', $user->id)->where('materia_id', $materia->id)->whereYear('fecha', $year)->where('estado', 'presente')->count();

            $ausentes = Asistencia::where('user_id', $user->id)->where('materia_id', $materia->id)->whereYear('fecha', $year)->where('estado', 'ausente')->count();

            $tardanzas = Asistencia::where('user_id', $user->id)->where('materia_id', $materia->id)->whereYear('fecha', $year)->where('estado', 'tardanza')->count();

            $justificadas = Asistencia::where('user_id', $user->id)->where('materia_id', $materia->id)->whereYear('fecha', $year)->where('estado', 'justificada')->count();

            if ($totalDias > 0) {
                                $porcentaje = round((($presentes + $justificadas) / $totalDias) * 100, 1);
                            } else {
                                $porcentaje = 100;
                            }
            $reportes = [[
                'alumno' => $user,
                'total_dias' => $totalDias,
                'presentes' => $presentes,
                'ausentes' => $ausentes,
                'tardanzas' => $tardanzas,
                'justificadas' => $justificadas,
                'porcentaje' => $porcentaje
            ]];

            return view('asistencias.reporte-alumno', compact('materia', 'reportes', 'year'));
            
        } else {
            foreach ($alumnos as $alumno) {
                $totalDias = Asistencia::where('user_id', $alumno->id)->where('materia_id', $materia->id)->whereYear('fecha', $year)->count();

                $presentes = Asistencia::where('user_id', $alumno->id)->where('materia_id', $materia->id)->whereYear('fecha', $year)->where('estado', 'presente')->count();

                $ausentes = Asistencia::where('user_id', $alumno->id)
                                     ->where('materia_id', $materia->id)
                                     ->whereYear('fecha', $year)
                                     ->where('estado', 'ausente')
                                     ->count();

                $tardanzas = Asistencia::where('user_id', $alumno->id)
                                      ->where('materia_id', $materia->id)
                                      ->whereYear('fecha', $year)
                                      ->where('estado', 'tardanza')
                                      ->count();

                $justificadas = Asistencia::where('user_id', $alumno->id)
                                         ->where('materia_id', $materia->id)
                                         ->whereYear('fecha', $year)
                                         ->where('estado', 'justificada')
                                         ->count();

                if ($totalDias > 0) {
                    $porcentaje = round((($presentes + $justificadas) / $totalDias) * 100, 1);
                } else {
                    $porcentaje = 100;
                }

                $reportes[] = [
                    'alumno' => $alumno,
                    'total_dias' => $totalDias,
                    'presentes' => $presentes,
                    'ausentes' => $ausentes,
                    'tardanzas' => $tardanzas,
                    'justificadas' => $justificadas,
                    'porcentaje' => $porcentaje
                ];
            }

            return view('asistencias.reporte', compact('materia', 'reportes', 'year', 'month'));
        }
    }
}