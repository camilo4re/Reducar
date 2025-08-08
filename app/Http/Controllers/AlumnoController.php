<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class AlumnoController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->role !== 'alumno') {
            abort('403'); // Acceso prohibido
        }

        return view('alumno.index');
    }
}
