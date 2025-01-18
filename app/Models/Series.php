<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Ranking;

class Series extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'cover', 'release_date'];

    public function rankings()
    {
        return $this->morphMany(Ranking::class, 'rankable');
    }
}
