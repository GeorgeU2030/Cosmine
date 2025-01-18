<?php

namespace App\Http\Controllers;

use App\Models\Ranking;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;

class RankingController extends Controller
{
    private function getRatingOrder($rating)
    {
        $ratingOrder = [
            'Eternity' => 10,
            'Masterpiece' => 9,
            'Excellent' => 8,
            'Great' => 7,
            'Good' => 6,
            'Decent' => 5,
            'Mediocre' => 4,
            'Boring' => 3,
            'Trash' => 2,
            'Razzie' => 1
        ];
        
        return $ratingOrder[$rating] ?? 0;
    }

    public function getMovieRankings()
    {
        $user = auth()->user();
        $rankings = Ranking::where('user_id', $user->id)
                         ->where('rankable_type', 'App\Models\Movie')
                         ->with(['rankable' => function($query) {
                             $query->select('*', DB::raw('YEAR(release_date) as year'));
                         }])
                         ->get()
                         ->map(function($ranking) {
                             $ranking->year = date('Y', strtotime($ranking->rankable->release_date));
                             $ranking->rating_order = $this->getRatingOrder($ranking->rating);
                             return $ranking;
                         })
                         ->sortBy([
                             ['year', 'desc'],
                             ['rating_order', 'desc']
                         ])
                         ->values();
        
        return response()->json($rankings);
    }

    public function getSeriesRankings()
    {
        $user = auth()->user();
        $rankings = Ranking::where('user_id', $user->id)
                         ->where('rankable_type', 'App\Models\Series')
                         ->with(['rankable' => function($query) {
                             $query->select('*', DB::raw('YEAR(release_date) as year'));
                         }])
                         ->get()
                         ->map(function($ranking) {
                             $ranking->year = date('Y', strtotime($ranking->rankable->release_date));
                             $ranking->rating_order = $this->getRatingOrder($ranking->rating);
                             return $ranking;
                         })
                         ->sortBy([
                             ['year', 'desc'],
                             ['rating_order', 'desc']
                         ])
                         ->values();
        
        return response()->json($rankings);
    }
}
