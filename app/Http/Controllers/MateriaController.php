<?php

namespace App\Http\Controllers;
use App\Models\Materia;
use App\Models\Curso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MateriaController extends Controller
{
    public function index(Request $request)
{
    $user = Auth::user();
    $materias = [];

    if ($user->role === 'profesor') {
        // Filtrar por user_id (el profesor)
        $materias = Materia::where('user_id', $user->id)->get();

    } elseif ($user->role === 'alumno') {
        $materias = Materia::where('curso_id', auth()->user()->curso_id)->get();

    } else { 
       
        $curso_id = $request->input('curso_id');

        $query = Materia::query();

        if ($curso_id) {
            $query->where('curso_id', $curso_id);
        }

        $materias = $query->get();

        // Traer todos los cursos para el select
        $cursos = Curso::orderBy('año')->orderBy('division')->get();

        return view('materias.index', compact('materias', 'cursos', 'curso_id'));
    
    }

    return view('materias.index', ['materias' => $materias]);
}
    public function create()
    {
          
        $cursos = Curso::all();
        return view('materias.create', ['cursos' => $cursos]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'curso_id' => 'required|exists:cursos,id',
        ]);

        Materia::create([
            'nombre' => $request->nombre,
            'curso_id' => $request->curso_id,
            'user_id' => Auth::id(), // el que la creo
        ]);

        return redirect()->route('materias.index');
    }

    public function edit($id)
{
    $materia = Materia::findOrFail($id);
    return view('materias.edit', ['materia' => $materia]);
}


    public function update(Request $request, $id)
{
    // Validar datos
    $request->validate([
        'nombre' => 'required|string|max:255',
        'descripcion' => 'nullable|string',
    ]);

    // Buscar la materia
    $materia = Materia::findOrFail($id);

    // Actualizar datos
    $materia->nombre = $request->nombre;
    $materia->save();

    // Redirigir con mensaje
    return redirect()->route('materias.index')
                     ->with('success', 'Materia actualizada correctamente.');
}
public function destroy($id)
{
    $materia = Materia::findOrFail($id);
    $materia->delete();
    return redirect()->route('materias.index')->with('success','Materia eliminada.');
}
public function show(Materia $materia)
{
    return view('materias.show', ['materia' => $materia]);
}

}