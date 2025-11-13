<?php

namespace App\Http\Controllers;

use App\Models\Notificacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificacionController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'contenido' => 'required|string',
        ]);

        Notificacion::create([
            'titulo' => $request->titulo,
            'contenido' => $request->contenido,
            'user_id' => Auth::id(),
        ]);

        return redirect()->back()->with('success', 'Notificación creada exitosamente');
    }

    public function destroy($id)
    {
        $notificacion = Notificacion::findOrFail($id);
        $notificacion->delete();

        return redirect()->back()->with('success', 'Notificación eliminada');
    }
}