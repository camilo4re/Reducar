<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Asegúrate de incluir esto
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Models\RegistrationCode; // Asegúrate de usar el modelo de RegistrationCode
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Auth\StatefulGuard;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        // Validar el formulario de registro
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
            'code' => 'required|string|exists:registration_codes,code', // Código de inscripción
        ]);

        // Validar si el código ha sido usado
        $regCode = RegistrationCode::where('code', $request->code)->first();
        
        if (!$regCode) {
            return back()->withErrors(['code' => 'El código de inscripción no es válido.']);
        }

        if ($regCode->used) {
            return back()->withErrors(['code' => 'Este código ya ha sido utilizado.']);
        }

        // Crear el nuevo usuario
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'alumno', // Asignar el rol de alumno por defecto
        ]);

        // Marcar el código como usado
        $regCode->used = true;
        $regCode->save();

        // Hacer login al usuario automáticamente
        
/** @var StatefulGuard $auth */
$auth = auth();
$auth->login($user);

        // Redirigir a la página principal 
        return redirect()->route('dashboard');
    }
}

