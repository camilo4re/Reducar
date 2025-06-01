<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfesorController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->role !== 'profesor') {
            abort(403); // Acceso prohibido
        }

        return view('profesor.inicioprofesor');
    }
}
