<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
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
}
