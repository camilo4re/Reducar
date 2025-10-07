<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\Curso;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        $user = Auth::user();

if ($user->role === 'alumno') {
    // Solo notificaciones de su curso
    $notificaciones = Notification::where('curso_id', $user->curso_id)
        ->orWhereNull('curso_id')
        ->latest()
        ->get();
} else {
    $notificaciones = Notification::where('user_id', $user->id)
        ->latest()
        ->get();
}

return view('alumno.index', compact('notificaciones'));
    }

    public function create()
    {
        $cursos = Curso::all();
        return view('notifications.create', compact('cursos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'mensaje' => 'required|string',
            'curso_id' => 'nullable|exists:cursos,id',
        ]);

        Notification::create([
            'user_id' => Auth::id(),
            'titulo' => $request->titulo,
            'mensaje' => $request->mensaje,
            'curso_id' => $request->curso_id,
        ]);

        return redirect()->route('notifications.index')->with('success', 'Comunicado enviado.');
    }
}