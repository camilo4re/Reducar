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

// Rutas de materias solo lectura (todos los roles logueados)
Route::middleware(['auth'])->group(function () {
    Route::get('/materias', [MateriaController::class, 'index'])->name('materias.index');
    
    Route::get('/materias/create', [MateriaController::class, 'create'])
        ->middleware('role:profesor,directivo')
        ->name('materias.create');
    
    Route::get('/materias/{id}/edit', [MateriaController::class, 'edit'])
        ->middleware('role:profesor,directivo')
        ->name('materias.edit');

    Route::get('/materias/{materia}', [MateriaController::class, 'show'])->name('materias.show');
    
    Route::post('/materias', [MateriaController::class, 'store'])
        ->middleware('role:profesor,directivo')
        ->name('materias.store');
    Route::put('/materias/{id}', [MateriaController::class, 'update'])
        ->middleware('role:profesor,directivo')
        ->name('materias.update');
    Route::delete('/materias/{id}', [MateriaController::class, 'destroy'])
        ->middleware('role:profesor,directivo')
        ->name('materias.destroy');
});

// Rutas de materias solo para profes y directivos (escritura)
    Route::middleware(['auth', 'role:profesor,directivo'])->group(function () {
    Route::get('/materias/create', [MateriaController::class, 'create'])->name('materias.create');
    Route::post('/materias', [MateriaController::class, 'store'])->name('materias.store');
    Route::get('/materias/{id}/edit', [MateriaController::class, 'edit'])->name('materias.edit');
    Route::put('/materias/{id}', [MateriaController::class, 'update'])->name('materias.update');
    Route::delete('/materias/{id}', [MateriaController::class, 'destroy'])->name('materias.destroy');
});


// Rutas de contenidos
Route::middleware(['auth'])->group(function () {

    // Index primero
    Route::get('/materias/{materia}/contenidos', [ContenidoController::class, 'index'])->name('contenidos.index');

    // Rutas para profes y directivos (crear, editar, eliminar)
    Route::middleware('role:profesor,directivo')->group(function () {
        Route::get('/materias/{materia}/contenidos/create', [ContenidoController::class, 'create'])->name('contenidos.create');
        Route::post('/materias/{materia}/contenidos', [ContenidoController::class, 'store'])->name('contenidos.store');
        Route::get('/materias/{materia}/contenidos/{contenido}/edit', [ContenidoController::class, 'edit'])->name('contenidos.edit');
        Route::put('/materias/{materia}/contenidos/{contenido}', [ContenidoController::class, 'update'])->name('contenidos.update');
        Route::delete('/materias/{materia}/contenidos/{contenido}', [ContenidoController::class, 'destroy'])->name('contenidos.destroy');
    });

    Route::get('/materias/{materia}/contenidos/{contenido}', [ContenidoController::class, 'show'])->name('contenidos.show');
});


// RUTAS DE NOTAS - Sistema de cuatrimestres
Route::middleware(['auth'])->group(function () {
    
    // Vista principal de notas por materia (muestra los 3 periodos)
    Route::get('/materias/{materia}/notas', [NotaController::class, 'index'])->name('notas.index');
    
    // Ver trabajos de un periodo específico
    Route::get('/materias/{materia}/notas/{periodo}', [NotaController::class, 'mostrarPeriodo'])
         ->name('notas.periodo')
         ->where('periodo', 'primer_cuatrimestre|segundo_cuatrimestre|recuperatorio');
    
    // Ver promedios de todos los alumnos
    Route::get('/materias/{materia}/promedios', [NotaController::class, 'promediosAlumnos'])->name('notas.promedios');
    
    // Rutas solo para profesores y directivos
    Route::middleware('role:profesor,directivo')->group(function () {
        
        // Crear nuevo trabajo
        Route::get('/materias/{materia}/notas/{periodo}/crear', [NotaController::class, 'crearTrabajo'])
             ->name('notas.crear-trabajo')
             ->where('periodo', 'primer_cuatrimestre|segundo_cuatrimestre|recuperatorio');
        
        Route::post('/materias/{materia}/notas/{periodo}', [NotaController::class, 'guardarTrabajo'])
             ->name('notas.guardar-trabajo')
             ->where('periodo', 'primer_cuatrimestre|segundo_cuatrimestre|recuperatorio');
        
        // Editar trabajo existente
        Route::get('/materias/{materia}/notas/{periodo}/{trabajo}/editar', [NotaController::class, 'editarTrabajo'])
             ->name('notas.editar-trabajo')
             ->where('periodo', 'primer_cuatrimestre|segundo_cuatrimestre|recuperatorio');
        
        Route::put('/materias/{materia}/notas/{periodo}/{trabajo}', [NotaController::class, 'actualizarTrabajo'])
             ->name('notas.actualizar-trabajo')
             ->where('periodo', 'primer_cuatrimestre|segundo_cuatrimestre|recuperatorio');
        
        // Eliminar trabajo
        Route::delete('/materias/{materia}/notas/{periodo}/{trabajo}', [NotaController::class, 'eliminarTrabajo'])
             ->name('notas.eliminar-trabajo')
             ->where('periodo', 'primer_cuatrimestre|segundo_cuatrimestre|recuperatorio');
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
