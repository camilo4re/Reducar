<?php

namespace App\Http\Controllers;
use App\Models\Materia;
use App\Models\Curso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MateriaController extends Controller
{
    public function index()
    {
        $materias = Materia::with(['curso', 'creador'])->get();
        return view('materias.index', compact('materias'));
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
        ]);

        Materia::create([
            'nombre' => $request->nombre,
            'curso_id' => $request->curso_id,
            'user_id' => Auth::id(), // el que la creo
        ]);

        return redirect()->route('materias.index')->with('success', 'Materia creada correctamente.');
    }

    public function edit(Materia $materia)
    {
        $cursos = Curso::all();
        return view('materias.edit', compact('materia', 'cursos'));
    }

    public function update(Request $request, Materia $materia)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'curso_id' => 'required|exists:cursos,id',
        ]);

        $materia->update([
            'nombre' => $request->nombre,
            'curso_id' => $request->curso_id,
        ]);

        return redirect()->route('materias.index')->with('success', 'Materia actualizada.');
    }

    public function destroy(Materia $materia)
    {
        $materia->delete();
        return redirect()->route('materias.index')->with('success', 'Materia eliminada.');
    }
}