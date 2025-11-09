<?php

namespace App\Http\Controllers;

use App\Models\Contenido;
use App\Models\Materia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContenidoController extends Controller
{
    public function index(Materia $materia)
    {
        $contenidos = $materia->contenidos()->with('user')->latest()->get();

        return view('materias.show', [
            'materia' => $materia,
            'contenidos' => $contenidos
        ]);
    }

    public function create(Materia $materia)
    {
        return view('contenidos.create', [
            'materia' => $materia
        ]);
    }

    public function store(Request $request, Materia $materia)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string'
        ]);

        $materia->contenidos()->create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('materias.show', $materia->id);
    }

   

    public function edit(Materia $materia, Contenido $contenido)
    {
        if (Auth::id() !== $contenido->user_id && Auth::user()->rol !== 'directivo') {
            abort(403, 'No tienes permiso para editar este contenido.');
        }

        return view('contenidos.edit', [
            'materia' => $materia,
            'contenido' => $contenido
        ]);
    }

    public function update(Request $request, Materia $materia, Contenido $contenido)
    {
        if (Auth::id() !== $contenido->user_id && Auth::user()->rol !== 'directivo') {
            abort(403, 'No tienes permiso para actualizar este contenido.');
        }

        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string'
        ]);

        $contenido->update($request->only('titulo', 'descripcion'));

        return redirect()->route('materias.show', $materia->id);
    }

    public function destroy(Materia $materia, Contenido $contenido)
    {
        if (Auth::id() !== $contenido->user_id && Auth::user()->role !== 'directivo') {
            abort(403, 'No tienes permiso para eliminar este contenido.');
        }

        $contenido->delete();

        return redirect()->route('materias.show', $materia->id);
    }
}

