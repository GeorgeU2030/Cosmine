<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Http;

class TMDBController extends Controller
{
    public function index()
    {
        $apiKey = env('TMDB_API_KEY'); 
        $apiBaseUrl = 'https://api.themoviedb.org/3';

        $popularMovies = array_slice(Http::get("{$apiBaseUrl}/movie/popular", [
            'api_key' => $apiKey,
            'language' => 'en-US', 
            'page' => 1,
        ])->json()['results'], 0, 18);

        $popularTVShows = array_slice(Http::get("{$apiBaseUrl}/tv/popular", [
            'api_key' => $apiKey,
            'language' => 'en-US',
            'page' => 1,
        ])->json()['results'], 0, 18);

        return Inertia::render('Home', [
            'popularMovies' => $popularMovies,
            'popularTVShows' => $popularTVShows,
        ]);
    }

    public function detail($type, $id)
    {
        $apiKey = env('TMDB_API_KEY'); 
        $apiBaseUrl = 'https://api.themoviedb.org/3';

        if (!in_array($type, ['movie', 'tv'])) {
            return Inertia::render('Detail', [
                'error' => 'Type must be "movie" or "tv".',
            ]);
        }
        
        $response = Http::get("{$apiBaseUrl}/{$type}/{$id}", [
            'api_key' => $apiKey,
            'language' => 'es-ES',
        ]);

            
        if ($response->successful()) {
            return Inertia::render('Detail', [
                    'item' => $response->json(),
                    'type' => $type
            ]);
        } else {
            return Inertia::render('Detail', [
                    'error' => 'Error fetching details.',
            ]);
        }
        
    }
}
