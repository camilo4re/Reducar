<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfesorController;


Route::view("inicio", "dashboard")->middleware('auth')->name("dashboard");
Route::view("inicio", "dashboard")->middleware('auth')->name("dashboard");
Route::view("nosotros", "about")->name("about");

/* rutas de profes */

Route::get("profesor", [ProfesorController::class, 'index'])
    ->middleware('auth')
    ->name("profesor");
/* rutas de alumnos */
Route::view("alumno", "alumno.alumnoInicio")->middleware('auth')->name("alumno");

/* rutas de directivos */
Route::view("directivo", "directivo.directivoInicio")->middleware('auth')->name("directivo");

/* rutas de login */

Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::view("login", "login")->name("login");

/* rutas de register */

Route::view("register", "register")->name("welcome");
Route::view("olvidaste", "olvidaste")->name("contact");
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);

/*no esta en uso por ahora*/

Route::get('/profile', function () {
    return 'Página de edición de perfil';
})->name('profile.edit');


Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
})->name('logout');
