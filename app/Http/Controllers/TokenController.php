<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RegistrationCode;
use App\Models\Curso;
use Illuminate\Support\Str;

class TokenController extends Controller
{
    public function index()
    {
        // Obtener cursos de la BD
        $cursos = Curso::all();
        $roles = ['profesor', 'alumno'];

        return view('directivo.tokens', compact('cursos', 'roles'));
    }

    public function store(Request $request)
    {
        $rules = [
        'role' => 'required|in:profesor,alumno',
    ];
        if ($request->role == 'alumno') {
                $rules['curso_id'] = 'required|exists:cursos,id';
    }   else {
                $rules['curso_id'] = 'nullable';
    }

        do {
            $tokenCode = strtoupper(Str::random(8));
        } while (RegistrationCode::where('code', $tokenCode)->exists());

        $token = RegistrationCode::create([
            'code' => $tokenCode,
            'curso_id' => $request->curso_id,
            'role' => $request->role,
            'used' => false,
        ]);

        return redirect()->back()->with('success', "Usuario generado exitosamente: {$tokenCode}");
    }

    public function listarTokens()
    {
        $tokens = RegistrationCode::with('curso')
                      ->orderBy('created_at', 'desc')
                      ->get();

        return view('directivo.lista-tokens', compact('tokens'));
    }

    public function marcarUsado($id)
    {
        $token = RegistrationCode::findOrFail($id);
        $token->update(['used' => true]);

        return redirect()->back()->with('success', 'Usuario marcado como usado');
    }
}