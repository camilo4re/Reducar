<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; //incluir esto
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Models\RegistrationCode; // modelo de RegistrationCode
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
        $code = RegistrationCode::where('code', $request->codigo)->first();

if (!$code || $code->role !== 'alumno') {
    return back()->withErrors(['codigo' => 'Código inválido']);
}

$user = User::create([
    'name' => $request->name,
    'email' => $request->email,
    'password' => bcrypt($request->password),
    'role' => 'alumno',
 ]);

// asignar a curso
$user->cursos()->attach($code->curso_id);

        // Hacer login al usuario automticamente
        

/** @var StatefulGuard $auth */

$auth = auth();
$auth->login($user);

        // Redirigir a la página principal 
        return redirect()->route('materias.index');
    }
}

