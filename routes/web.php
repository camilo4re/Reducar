<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfesorController;
use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\DirectivoController;
use App\Http\Controllers\MateriaController;

Route::view("/", "index")->name("dashboard");
Route::view("nosotros", "about")->name("about");

/* rutas de profes */

    Route::middleware(['auth', 'role:profesor'])->group(function () {
    Route::get('/profesor', [ProfesorController::class, 'index'])->name('profesor');
    Route::view("horarios", "profesor.horarios")->name("horarios");
});
/* rutas de alumnos */

    Route::middleware(['auth', 'role:alumno'])->group(function () {
    Route::get('/alumno', [AlumnoController::class, 'index'])->name('alumno');
});




/* rutas de directivos */
    Route::middleware(['auth', 'role:directivo'])->group(function () {
    Route::get('/directivo', [DirectivoController::class, 'index'])->name('directivo');
});
/* rutas de login */

    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store'])->name('login.store');

/* rutas de register */

    Route::view("register", "register")->name("welcome");
    Route::view("olvidaste", "olvidaste")->name("contact");
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);

/* rutas de materias */

Route::middleware(['auth'])->group(function () {
    Route::get('/materias', [MateriaController::class, 'index'] )           ->name('materias.index');
    Route::get('/materias/create', [MateriaController::class, 'create'])    ->name('materias.create');
    Route::post('/materias', [MateriaController::class, 'store'])           ->name('materias.store');
    Route::get('/materias/{id}/edit', [MateriaController::class, 'edit'])   ->name('materias.edit');
    Route::put('/materias/{id}', [MateriaController::class, 'update'])      ->name('materias.update');
    Route::delete('/materias/{id}', [MateriaController::class, 'destroy'])  ->name('materias.destroy');
});
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
