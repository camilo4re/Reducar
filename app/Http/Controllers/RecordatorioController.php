<?php

namespace App\Http\Controllers;

use App\Models\Recordatorio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecordatorioController extends Controller
{
    public function index()
    {
        $recordatorios = Recordatorio::where('user_id', Auth::id())
            ->orderBy('fecha', 'asc')
            ->get();

        return view('recordatorios.index', compact('recordatorios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'fecha' => 'required|date',
            'prioridad' => 'required|string|in:verde,naranja,rojo',
        ]);

        Recordatorio::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'fecha' => $request->fecha,
            'prioridad' => $request->prioridad,
            'user_id' => Auth::id(),
        ]);

        return redirect()->back()->with('success', 'Recordatorio agregado');
    }

    public function update(Request $request, $id)
    {
        $recordatorio = Recordatorio::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'fecha' => 'required|date',
            'prioridad' => 'required|string|in:verde,naranja,rojo',
        ]);

        $recordatorio->update([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'fecha' => $request->fecha,
            'prioridad' => $request->prioridad,
        ]);

        return redirect()->back()->with('success', 'Recordatorio actualizado');
    }

    public function destroy($id)
    {
        $recordatorio = Recordatorio::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();
        
        $recordatorio->delete();

        return redirect()->back()->with('success', 'Recordatorio eliminado');
    }
}