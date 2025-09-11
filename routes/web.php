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
use App\Http\Controllers\ContenidoController;
use App\Http\Controllers\NotaController;
use App\Http\Controllers\AsistenciaController;

Route::view("/", "index")->name("inicio");
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

    Route::view("olvidaste", "olvidaste")->name("olvidaste");
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);


// Rutas de materias solo para profes y directivos (escritura)
    Route::middleware(['auth', 'role:profesor,directivo'])->group(function () {
    Route::get('/materias/create', [MateriaController::class, 'create'])->name('materias.create');
    Route::post('/materias', [MateriaController::class, 'store'])->name('materias.store');
    Route::get('/materias/{id}/edit', [MateriaController::class, 'edit'])->name('materias.edit');
    Route::put('/materias/{id}', [MateriaController::class, 'update'])->name('materias.update');
    Route::delete('/materias/{id}', [MateriaController::class, 'destroy'])->name('materias.destroy');
});

// Rutas de materias solo lectura (todos los roles logueados)
Route::middleware(['auth'])->group(function () {
    Route::get('/materias', [MateriaController::class, 'index'])->name('materias.index');
    Route::get('/materias/{materia}', [MateriaController::class, 'show'])->name('materias.show');
});




// Rutas de contenidos
Route::middleware(['auth'])->group(function () {

    // Index primero

    // Rutas para profes y directivos (crud)
    Route::middleware('role:profesor,directivo')->group(function () {
        Route::get('/materias/{materia}/contenidos/create', [ContenidoController::class, 'create'])->name('contenidos.create');
        Route::post('/materias/{materia}/contenidos', [ContenidoController::class, 'store'])->name('contenidos.store');
        Route::get('/materias/{materia}/contenidos/{contenido}/edit', [ContenidoController::class, 'edit'])->name('contenidos.edit');
        Route::put('/materias/{materia}/contenidos/{contenido}', [ContenidoController::class, 'update'])->name('contenidos.update');
        Route::delete('/materias/{materia}/contenidos/{contenido}', [ContenidoController::class, 'destroy'])->name('contenidos.destroy');
    });

    Route::get('/materias/{materia}/contenidos/{contenido}', [ContenidoController::class, 'show'])->name('contenidos.show');
});


// rutas de notas
Route::middleware(['auth'])->group(function () {
    Route::middleware('role:profesor,directivo')->group(function () {
        Route::get('/materias/{materia}/notas/{periodo}/{trabajo}/editar', [NotaController::class, 'edit'])
    ->where(['periodo' => 'primer_cuatrimestre|segundo_cuatrimestre|intensificacion'])->name('notas.edit');

Route::get('/materias/{materia}/notas/{periodo}/crear', [NotaController::class, 'create'])
    ->where('periodo', 'primer_cuatrimestre|segundo_cuatrimestre|intensificacion')
    ->name('notas.create');

Route::post('/materias/{materia}/notas/{periodo}', [NotaController::class, 'store'])
    ->where(['periodo' => 'primer_cuatrimestre|segundo_cuatrimestre|intensificacion'])->name('notas.store');

Route::put('/materias/{materia}/notas/{periodo}/{trabajo}', [NotaController::class, 'update'])
    ->where(['periodo' => 'primer_cuatrimestre|segundo_cuatrimestre|intensificacion'])->name('notas.update');

Route::delete('/materias/{materia}/notas/{periodo}/{trabajo}', [NotaController::class, 'destroy'])
    ->where(['periodo' => 'primer_cuatrimestre|segundo_cuatrimestre|intensificacion'])->name('notas.destroy');


    });
Route::get('/materias/{materia}/notas/{periodo}', [NotaController::class, 'mostrarPeriodo'])
    ->where(['periodo' => 'primer_cuatrimestre|segundo_cuatrimestre|intensificacion'])
    ->name('notas.periodo');
    Route::get('/materias/{materia}/notas', [NotaController::class, 'index'])->name('notas.index');

    Route::get('/materias/{materia}/promedios', [NotaController::class, 'promediosNotas'])->name('notas.promedios');
});


// Rutas de asistencias
Route::middleware(['auth'])->group(function () {
    Route::get('/materias/{materia}/asistencias', [AsistenciaController::class, 'index'])->name('asistencias.index');
    Route::get('/materias/{materia}/asistencias/reporte', [AsistenciaController::class, 'reporte'])->name('asistencias.reporte');
    
    
    Route::middleware('role:profesor,directivo')->group(function () {
        Route::post('/materias/{materia}/asistencias/marcar', [AsistenciaController::class, 'marcar'])->name('asistencias.marcar');
        Route::post('/materias/{materia}/asistencias/eliminar', [AsistenciaController::class, 'eliminar'])->name('asistencias.eliminar');
    });
});

// Rutas de perfil y logout (todos los roles logueados)

    Route::get('/profile', function () {
    return 'Página de edición de perfil';
})->name('profile.edit');


Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
})->name('logout');
