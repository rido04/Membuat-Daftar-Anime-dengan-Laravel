<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class AnimeController extends Controller
{
    // untuk menampilkan list anime
    public function index()
    {
        $page = request()->query('page', 1); // Ambil page dari URL, default 1
        $response = Http::get("https://api.jikan.moe/v4/top/anime?page={$page}");

        $anime = $response->json();

        if (!$response->successful() || !isset($anime['data'])) {
            return back()->with('error', 'Gagal mengambil data anime dari API.');
        }

        return view('anime.index', [
            'anime' => $anime['data'],
            'currentPage' => $page // Kirim ke view
        ]);
    }

    // untuk mencari anime
    public function searchAnime(Request $request)
    {
        // Ambil keyword dari inputan user
        $query = $request->query('query');

        // Cek apakah user memasukkan sesuatu
        if (!$query) {
            return redirect('/anime')->with('error', 'Silakan masukkan keyword pencarian!');
        }

        // Ambil data anime berdasarkan pencarian di Jikan API
        $response = Http::get("https://api.jikan.moe/v4/anime", [
            'q' => $query
        ]);

        $animeList = $response->json();
        Log::info("Requesting API: https://api.jikan.moe/v4/anime?q=" . $query);
        Log::info(json_encode($animeList, JSON_PRETTY_PRINT));

        if (!$response->successful() || !isset($animeList['data']) || empty($animeList['data'])) {
            return back()->with('error', 'Anime tidak ditemukan atau API bermasalah.');
        }

        return view('anime.index', [
            'anime' => $animeList['data'],
            'currentPage' => 1 // Tambahkan currentPage dengan nilai default 1
        ]);
    }

    // untuk filter genre anime
    public function filterByGenre(Request $request)
    {
        $genreId = $request->query('genre');

        $response = Http::get("https://api.jikan.moe/v4/anime", [
            'genres' => $genreId
        ]);

        $animeList = $response->json();

        // Log respons untuk debugging
        Log::info(json_encode($animeList, JSON_PRETTY_PRINT));

        if (!$response->successful() || !isset($animeList['data'])) {
            return back()->with('error', 'Gagal mengambil data dari API. Coba lagi nanti.');
        }

        return view('anime.index', [
            'anime' => $animeList['data'],
            'selectedGenre' => $genreId,
            'currentPage' => 1 // Tambahkan currentPage dengan nilai default 1
        ]);
    }

    public function show($id)
    {
        $response = Http::get("https://api.jikan.moe/v4/anime/{$id}/full");

        // Konversi response menjadi array
        $anime = $response->json();

        // Log respons untuk debugging
        Log::info(json_encode($anime, JSON_PRETTY_PRINT));

        // Jika respons tidak valid atau tidak ada key 'data'
        if (!$response->successful() || !isset($anime['data'])) {
            return back()->with('error', 'Anime tidak ditemukan atau API sedang bermasalah.');
        }

        return view('anime.show', ['anime' => $anime['data']]);
    }
}
