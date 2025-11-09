<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HorarioMateria;
use Illuminate\Support\Facades\Auth;

class CalendarioController extends Controller
{
    public function index()
    {
        $cursoId = Auth::user()->curso_id;
        
        $horarios = HorarioMateria::with('materia')
    ->whereRelation('materia', 'curso_id', $cursoId)
    ->get();
        
        $horariosPorDia = $horarios->groupBy('dia_semana');
        
        $dias = [
            1 => 'Lunes',
            2 => 'Martes', 
            3 => 'Miércoles',
            4 => 'Jueves',
            5 => 'Viernes'
        ];
        
        return view('calendario.index', compact('horariosPorDia', 'dias'));
    }
}