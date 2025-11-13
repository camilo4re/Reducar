<?php

namespace App\Http\Controllers;

use App\Models\Horario;
use App\Models\Curso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class HorarioController extends Controller
{
    // renderiza la vista con el calendario + filtro (si es directivo)
    public function view()
    {
        $user = Auth::user();

        // cursos para el filtro del directivo (y opcional para alumno)
        $cursos = Curso::orderBy('año')->orderBy('division')->get();

        return view('horarios.index', compact('cursos', 'user'));
    }

    // devuelve eventos en JSON para TUI Calendar, según el rol y filtros
    public function apiIndex(Request $request)
    {
        $user = Auth::user();
        $cursoId = $request->query('curso_id'); // usado por directivo (y alumno si querés)

        $query = Horario::with(['materia', 'materia.curso', 'materia.user']);

        if ($user->role === 'profesor') {
            // Solo sus materias
            $query->whereHas('materia', fn($q) => $q->where('user_id', $user->id));

        } elseif ($user->role === 'alumno') {
            // Asumimos users.curso_id
            $cursoId = $cursoId ?? $user->curso_id ?? null;
            if ($cursoId) {
                $query->whereHas('materia', fn($q) => $q->where('curso_id', $cursoId));
            } else {
                // Si no hay curso asociado, no devolver nada
                $query->whereRaw('1=0');
            }

        } else { // directivo
            // Puede filtrar por curso; si no, ve todo
            if ($cursoId) {
                $query->whereHas('materia', fn($q) => $q->where('curso_id', $cursoId));
            }
        }

        $horarios = $query->get();

        // Generamos eventos para la semana actual (Lunes a Domingo)
        $startOfWeek = Carbon::now()->startOfWeek(Carbon::MONDAY);

        $events = $horarios->map(function ($h) use ($startOfWeek) {
            $date = $startOfWeek->copy()->addDays(($h->dia ?? 1) - 1);
            $start = $date->copy()->setTimeFromTimeString($h->hora_inicio);
            $end   = $date->copy()->setTimeFromTimeString($h->hora_fin);

            $titulo = $h->materia->nombre;
            if ($h->materia->curso) {
                $titulo .= ' • ' . $h->materia->curso->año . 'º' . $h->materia->curso->division;
            }
            if ($h->aula) {
                $titulo .= ' • Aula ' . $h->aula;
            }

            return [
                'id'            => (string)$h->id,
                'calendarId'    => (string)($h->materia->curso_id ?? '0'),
                'title'         => $titulo,
                'start'         => $start->toIso8601String(),
                'end'           => $end->toIso8601String(),
                'backgroundColor' => $h->color ?? '#27ae60',
                'borderColor'     => $h->color ?? '#27ae60',
            ];
        })->values();

        return response()->json($events);
    }
}
