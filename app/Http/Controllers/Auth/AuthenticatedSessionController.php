<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /* Redireccionamiento segun rol. -c*/
    
    public function store(LoginRequest $request) 
    {
        $request->authenticate();
        // $request->session()->regenerate(); //para produccion lo saco por que es re tosco c-
        $user = auth()->user();       
        if ($user->role=== "alumno") {
            return 
            redirect()->route("alumno");
        } elseif ($user->role === "profesor") {
        return redirect()->route("profesor");
    } elseif ($user->role === "directivo") {
        return redirect()->route("directivo");
    }


    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
