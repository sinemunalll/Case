<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fixture extends Model
{
    use HasFactory;

    protected $fillable = [
        'week',
        'team1',
        'team2',
        'team1Score',
        'team2Score'

    ];
    public function firstTeam ()
    {
        return $this->belongsTo(Team::class,'team1','id');
    }

    public function secondTeam ()
    {
        return $this->belongsTo(Team::class,'team2','id');
    }
}
