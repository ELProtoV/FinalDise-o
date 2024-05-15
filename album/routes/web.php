<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AlbumController;

// Rutas para la autenticación
Auth::routes();

// Ruta de inicio
Route::get('/', function () {
    return redirect()->route('albums.index');
});

// Rutas para los álbumes
Route::get('/albums', [AlbumController::class, 'index'])->name('albums.index');
Route::get('/albums/create', [AlbumController::class, 'create'])->name('albums.create');
Route::post('/albums', [AlbumController::class, 'store'])->name('albums.store');
Route::get('/albums/{album}', [AlbumController::class, 'show'])->name('albums.show');
Route::get('/albums/{album}/edit', [AlbumController::class, 'edit'])->name('albums.edit');
Route::put('/albums/{album}', [AlbumController::class, 'update'])->name('albums.update');
Route::delete('/albums/{album}', [AlbumController::class, 'destroy'])->name('albums.destroy');
Route::post('/albums/{id}/rate', [AlbumController::class, 'rate'])->name('albums.rate');

// Ruta de inicio para usuarios autenticados
Route::get('/home', [HomeController::class, 'index'])->name('home');
