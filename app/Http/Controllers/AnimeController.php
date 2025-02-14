<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class AnimeController extends Controller
{
    // untuk menampilkan list anime
    public function index(Request $request)
    {
        $page = $request->query('page', 1); // Ambil page dari URL, default 1
        $sort = $request->input('sort', 'title'); // Default sorting by title
        $order = $request->input('order', 'asc'); // Default ascending order

        $response = Http::get("https://api.jikan.moe/v4/top/anime?page={$page}");

        $anime = $response->json();

        if (!$response->successful() || !isset($anime['data'])) {
            return back()->with('error', 'Failed to fetch anime data from API.');
        }

        $query = collect($anime['data']);

        // Sorting logic
        if ($sort == 'score') {
            $query = $query->sortByDesc('score');
        } elseif ($sort == 'title') {
            $query = $query->sortBy('title');
        } elseif ($sort == 'episodes') {
            $query = $query->sortByDesc('episodes');
        }

        return view('anime.index', [
            'anime' => $query,
            'sort' => $sort,
            'order' => $order,
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
            return redirect('/anime')->with('error', 'Please enter a valid keyword.');
        }

        // Ambil data anime berdasarkan pencarian di Jikan API
        $response = Http::get("https://api.jikan.moe/v4/anime", [
            'q' => $query
        ]);

        $animeList = $response->json();
        Log::info("Requesting API: https://api.jikan.moe/v4/anime?q=" . $query);
        Log::info(json_encode($animeList, JSON_PRETTY_PRINT));

        if (!$response->successful() || !isset($animeList['data']) || empty($animeList['data'])) {
            return back()->with('error', 'Anime not found or API issue.');
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
            return back()->with('error', 'Failed to fetch data from API. Please try again later.');
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
            return back()->with('error', 'Anime not found or API issue.');
        }

        return view('anime.show', ['anime' => $anime['data']]);
    }
}
