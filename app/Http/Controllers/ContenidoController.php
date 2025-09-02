<?php

namespace App\Http\Controllers;

use App\Models\Contenido;
use App\Models\Materia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContenidoController extends Controller
{
    /**
     * Lista de contenidos de una materia
     */
    public function index(Materia $materia)
    {
        // Cargar contenidos con info del creador
        $contenidos = $materia->contenidos()->with('user')->latest()->get();

        return view('contenidos.index', [
            'materia' => $materia,
            'contenidos' => $contenidos
        ]);
    }

    /**
     * Formulario para crear un contenido dentro de una materia
     */
    public function create(Materia $materia)
    {
        return view('contenidos.create', [
            'materia' => $materia
        ]);
    }

    /**
     * Guardar contenido
     */
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

        return redirect()->route('materias.show', $materia->id)
            ->with('success', 'Contenido creado exitosamente.');
    }

    /**
     * Mostrar un contenido específico
     */
    public function show(Materia $materia, Contenido $contenido)
    {
        return view('contenidos.show', [
            'materia' => $materia,
            'contenido' => $contenido
        ]);
    }

    /**
     * Formulario de edición
     */
    public function edit(Materia $materia, Contenido $contenido)
    {
        // Solo el creador o un directivo pueden editar
        if (Auth::id() !== $contenido->user_id && Auth::user()->rol !== 'directivo') {
            abort(403, 'No tienes permiso para editar este contenido.');
        }

        return view('contenidos.edit', [
            'materia' => $materia,
            'contenido' => $contenido
        ]);
    }

    /**
     * Actualizar contenido
     */
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

        return redirect()->route('contenidos.index', $materia->id)
            ->with('success', 'Contenido actualizado exitosamente.');
    }

    /**
     * Eliminar contenido
     */
    public function destroy(Materia $materia, Contenido $contenido)
    {
        if (Auth::id() !== $contenido->user_id && Auth::user()->role !== 'directivo') {
            abort(403, 'No tienes permiso para eliminar este contenido.');
        }

        $contenido->delete();

        return redirect()->route('materias.show', $materia->id)
            ->with('success', 'Contenido eliminado exitosamente.');
    }
}

