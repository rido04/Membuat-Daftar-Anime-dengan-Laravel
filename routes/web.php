<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnimeController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/anime', [AnimeController::class, 'index']);
Route::get('/anime/search', [AnimeController::class, 'searchAnime'])->name('anime.search');
Route::get('/anime/genre', [AnimeController::class, 'filterByGenre'])->name('anime.filterByGenre');
Route::get('/anime/{id}', [AnimeController::class, 'show'])->name('anime.show'); // Pindahkan ke bawah




