<?php

namespace App\Http\Controllers;

use App\Models\UserProfile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller
{
    public function create()
    {
        $user = Auth::user();

        if ($user->profile) {
            return redirect()->route('perfil.show');
        }

        return view('perfil.create'); 
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $existing = UserProfile::where('user_id', $user->id)->first();
        if ($existing && $existing->bloqueado) {
            return redirect()->back()->withErrors('Tus datos ya están cargados y no se pueden editar. Contactá a un directivo.');
        }

        $validated = $request->validate([
            'domicilio' => 'required|string|max:255',
            'nombre_padre' => 'nullable|string|max:255',
            'telefono_padre' => 'nullable|string|max:50',
            'dni_padre' => 'nullable|string|max:8',
            'nombre_madre' => 'nullable|string|max:255',
            'telefono_madre' => 'nullable|string|max:50',
            'dni_madre' => 'nullable|string|max:8',
            'nombre_tutor' => 'nullable|string|max:255',
            'telefono_tutor' => 'nullable|string|max:50',
            'dni_tutor' => 'nullable|string|max:8',
            'numero_emergencia' => 'required|string|max:50',
            'personas_autorizadas' => 'nullable|array',
            'personas_autorizadas.*.nombre' => 'required_with:personas_autorizadas|string|max:255',
            'personas_autorizadas.*.dni' => 'required_with:personas_autorizadas|string|max:50',
            'personas_autorizadas.*.telefono' => 'nullable|string|max:50',
        ],[
            'personas_autorizadas.*.nombre.required_with' => 'El nombre es obligatorio para cada persona autorizada.',
            'personas_autorizadas.*.dni.required_with' => 'El DNI es obligatorio para cada persona autorizada.',
            'domicilio.required' => 'El domicilio es obligatorio.',
            'numero_emergencia.required' => 'El número de emergencia es obligatorio.',
        ]);

        $profile = UserProfile::updateOrCreate(
            ['user_id' => $user->id],
            [
                'domicilio' => $validated['domicilio'],
                'nombre_padre' => $validated['nombre_padre'] ?? null,
                'telefono_padre' => $validated['telefono_padre'] ?? null,
                'dni_padre' => $validated['dni_padre'] ?? null,
                'nombre_madre' => $validated['nombre_madre'] ?? null,
                'telefono_madre' => $validated['telefono_madre'] ?? null,
                'dni_madre' => $validated['dni_madre'] ?? null,
                'nombre_tutor' => $validated['nombre_tutor'] ?? null,
                'telefono_tutor' => $validated['telefono_tutor'] ?? null,
                'dni_tutor' => $validated['dni_tutor'] ?? null,
                'numero_emergencia' => $validated['numero_emergencia'],
                'personas_autorizadas' => $validated['personas_autorizadas'] ?? null,
            ]
        );

        $profile->update(['bloqueado' => true]);

        return redirect()->route('perfil.show')->with('success', 'Datos guardados correctamente.');
    }

    public function show()
    {
        $profile = Auth::user()->profile;
        return view('perfil.show', compact('profile'));

    }

public function index()
{
    $perfiles = UserProfile::with('user')->get();
    return view('directivo.perfiles.index', compact('perfiles'));
}

public function showAlumno(User $user)
{
    $perfil = $user->profile;

    if (!$perfil) {
        return redirect()->back()->withErrors('El alumno todavía no completó su perfil.');
    }

    return view('directivo.perfiles.show', compact('perfil', 'user'));
}

public function reset(User $user)
{
    $perfil = $user->profile;
    if ($perfil) {
        $perfil->update(['bloqueado' => false]);
    }

    return redirect()->back()->with('success', 'El perfil del alumno fue reestablecido. Ahora podrá editarlo.');
}
}
