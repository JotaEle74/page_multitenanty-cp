<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Página pública principal
Route::get('/', function () {return Inertia::render('Public/Inicio', ['appName' => config('app.name'),]);})->name('public.home');

// Página Nosotros (pública)
Route::get('/nosotros', function () {
    return Inertia::render('Public/NosotrosPage', ['appName' => config('app.name')]);
})->name('public.nosotros');

// Página Escuela dinámica (pública)
Route::get('/{slug}', [\App\Http\Controllers\PublicController::class, 'school'])->name('public.escuela');

Route::get('/escuela/{slug}/nosotros', [\App\Http\Controllers\PublicController::class, 'schoolAbout'])->name('public.escuela.nosotros');

Route::get('/escuela/{slug}', [\App\Http\Controllers\PublicController::class, 'schoolProgram'])->name('public.escuela.programa');

Route::get('/escuelas/{slug}/documentos', [\App\Http\Controllers\PublicController::class, 'schoolDocuments'])->name('public.escuela.documentos');

Route::get('/escuelas/{slug}/publicaciones', [\App\Http\Controllers\PublicController::class, 'schoolPublications'])->name('public.escuela.publicaciones');
// Dashboard privado por defecto de Breeze
Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Rutas protegidas
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/private-page', function () {
        return Inertia::render('PrivatePage');
    })->name('private.page');
});
