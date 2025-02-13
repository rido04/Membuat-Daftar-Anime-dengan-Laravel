<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnimeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WishlistController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/anime', [AnimeController::class, 'index'])->name('anime.index');
Route::get('/anime/search', [AnimeController::class, 'searchAnime'])->name('anime.search');
Route::get('/anime/genre', [AnimeController::class, 'filterByGenre'])->name('anime.filterByGenre');
Route::get('/anime/{id}', [AnimeController::class, 'show'])->name('anime.show'); // Pindahkan ke bawah


Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
Route::post('/wishlist', [WishlistController::class, 'store'])->name('wishlist.store');
Route::delete('/wishlist/{id}', [WishlistController::class, 'destroy'])->name('wishlist.destroy');



require __DIR__.'/auth.php';
