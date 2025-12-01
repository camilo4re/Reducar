<?php

namespace App\Http\Controllers;
use App\Models\Materia;
use App\Models\HorarioMateria;
use App\Models\Curso;
use App\Models\Recordatorio;
use App\Models\Notificacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MateriaController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $materias = [];

        $recordatorios = Recordatorio::where('user_id', Auth::id())
            ->orderBy('fecha', 'asc')
            ->get();

        $notificaciones = Notificacion::orderBy('created_at', 'desc')->get();

        if ($user->role === 'profesor') {

            $materias = Materia::with('horarios')->where('user_id', $user->id)->get();

            return view('materias.index', compact('materias', 'recordatorios', 'notificaciones'));

        } elseif ($user->role === 'alumno') {
            $materias = Materia::with('horarios')->where('curso_id', $user->curso_id)->get();
            
            return view('materias.index', compact('materias', 'recordatorios', 'notificaciones'));

        } else { 
            $curso_id = $request->input('curso_id');
            $query = Materia::with('horarios'); 

            if ($curso_id) {
                $query->where('curso_id', $curso_id);
            }

            $materias = $query->get();
            $cursos = Curso::orderBy('año')->orderBy('division')->get();

            return view('materias.index', compact('materias', 'cursos', 'curso_id', 'recordatorios', 'notificaciones'));
        }
    }
    
    public function create()
    {
        $cursos = Curso::all();
        return view('materias.create', compact('cursos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'curso_id' => 'required|exists:cursos,id',
            'horarios' => 'required|array|min:1',
            'horarios.*.dia_semana' => 'required|integer|between:1,5',
            'horarios.*.hora_inicio' => 'required|date_format:H:i',
            'horarios.*.hora_fin' => 'required|date_format:H:i|after:horarios.*.hora_inicio',
        ]);

        $materia = Materia::create([
            'nombre' => $request->nombre,
            'curso_id' => $request->curso_id,
            'user_id' => Auth::id(),
        ]);

        foreach ($request->horarios as $horario) {
            HorarioMateria::create([
                'materia_id' => $materia->id,
                'dia_semana' => $horario['dia_semana'],
                'hora_inicio' => $horario['hora_inicio'],
                'hora_fin' => $horario['hora_fin'],
            ]);
        }

        return redirect()->route('materias.index');
    }

    public function edit($id)
    {
        $materia = Materia::with('horarios')->findOrFail($id);
        return view('materias.edit', ['materia' => $materia]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
                'nombre' => 'required|string|max:255',
                'horarios' => 'required|array|min:1',
                'horarios.*.dia_semana' => 'required|integer|between:1,6',
                'horarios.*.hora_inicio' => 'required',
                'horarios.*.hora_fin' => 'required',
            ]);

        $materia = Materia::findOrFail($id);
        $materia->nombre = $request->nombre;
        $materia->save();

        $materia->horarios()->delete();
        
        foreach ($request->horarios as $horario) {
            HorarioMateria::create([
                'materia_id' => $materia->id,
                'dia_semana' => $horario['dia_semana'],
                'hora_inicio' => $horario['hora_inicio'],
                'hora_fin' => $horario['hora_fin'],
            ]);
        }

        return redirect()->route('materias.index');
    }

    public function destroy($id)
    {
        $materia = Materia::findOrFail($id);
        $materia->delete();
        return redirect()->route('materias.index');
    }
    
    public function show(Materia $materia)
    {
        return view('materias.show', ['materia' => $materia]);
    }
}