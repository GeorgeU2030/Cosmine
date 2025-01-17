<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Http;
use App\Models\Movie;
use App\Models\Series;

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

    public function saveRating(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:movie,tv',
            'rating' => 'required|string',
            'name' => 'required|string',
            'cover' => 'required|string',
            'release_date' => 'required|string',
        ]);


        if ($validated['type'] == 'movie') {
            
            $movie = Movie::where('name', $validated['name'])->first();
    
            if (!$movie) {
                $movie = Movie::create([
                    'name' => $validated['name'],
                    'cover' => $validated['cover'],
                    'release_date' => $validated['release_date'],
                ]);
                $movie->rankings()->create([
                    'user_id' => auth()->user()->id,
                    'rating' => $validated['rating'],
                    'rankable_id' => $movie->id,
                    'rankable_type' => Movie::class,  
                ]);
                return redirect()->intended('/home');
            } else {
                return redirect()->back()->with('message', 'This movie has already been ranked!');
            }
    
        }
        else if ($validated['type'] == 'tv') {
            
            $tv = Series::where('name', $validated['name'])->first();
    
            if (!$tv) {
                $tv = Series::create([
                    'name' => $validated['name'],
                    'cover' => $validated['cover'],
                    'release_date' => $validated['release_date'],
                ]);
                $tv->rankings()->create([
                    'user_id' => auth()->user()->id,
                    'rating' => $validated['rating'],
                    'rankable_id' => $tv->id,
                    'rankable_type' => Series::class,  
                ]);
            }
    
    
            return redirect()->route('home');
        }

    }
}
