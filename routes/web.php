<?php

use App\Http\Controllers\{AccesosController, ContactoController, ProfileController, SobreMiController, ProyectosController};
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('main.sobre-mi');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/proyectos/agregar', [ProyectosController::class, 'create'])->name('proyectos.agregar');
    Route::post('/proyectos', [ProyectosController::class, 'store'])->name('proyectos.store');

    Route::get('/accesos-directos', [AccesosController::class, 'index'])->name('accesos');
});

Route::get('/sobre-mi', [SobreMiController::class, 'index'])->name('sobre-mi');
Route::get('/proyectos', [ProyectosController::class, 'index'])->name('proyectos');
Route::get('/contacto', [ContactoController::class, 'index'])->name('contacto');

require __DIR__ . '/auth.php';
