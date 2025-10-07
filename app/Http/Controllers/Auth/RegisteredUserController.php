<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\RegistrationCode;

class RegisteredUserController extends Controller
{
    public function create()
    {
        return view('register');
    }

    public function store(Request $request)
    {
        // Validar el formulario de registro
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                'regex:/^[\pL\s]+$/u' // esto es para que acepte letras, acentos , espacios y ñ. no numeros o signos aparte.
            ],
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
            'code' => 'required|string|exists:registration_codes,code',
        ], [ //Esto es para que cuando haces algo mal con cualquiera de los inputs te tire un mensaje en español.
            'name.regex' => 'El campo nombre solo puede contener letras y espacios.',
            'name.required' => 'El campo nombre es obligatorio.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico no tiene un formato válido.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
            'code.exists' => 'El código de inscripción no es válido.',
        ]);

        // si el codigo lo uso alguien
        $code = RegistrationCode::where('code', $request->code)
                                 ->where('used', false)
                                 ->first();

        // Validar que no haya sido usado
        if (!$code) {
            return back()->withErrors(['code' => 'El código no es válido o ya fue utilizado.']);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $code->role,
            'curso_id' => $code->curso_id, //ndeahh
        ]);

        $code->update(['used' => true]);

        auth()->login($user);

        return redirect()->route('materias.index');
    }
}