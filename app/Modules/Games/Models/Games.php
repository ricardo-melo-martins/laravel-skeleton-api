<?php

namespace App\Modules\Games\Models;

use App\Modules\Teams\Models\Teams;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Games extends Model
{
    use HasFactory;

    protected $table = "games";

    protected $fillable = [
        'date',
        'season',
        "status",
        "period",
        "time",
        "postseason",
        "home_team_score",
        "visitor_team_score",
        "team_id_home",
        "team_id_visitor"
    ];

    public function home_team()
    {
        return $this->belongsTo(Teams::class);
    }
    
    public function visitor_team()
    {
        return $this->belongsTo(Teams::class);
    }
}
