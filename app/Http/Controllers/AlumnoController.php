<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AlumnoController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->role !== 'alumno') {
            abort(403); // Acceso prohibido
        }

        return view('alumno.alumnoInicio');
    }
}
