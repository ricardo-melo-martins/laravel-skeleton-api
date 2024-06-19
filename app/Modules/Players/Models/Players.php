<?php

namespace App\Modules\Players\Models;

use App\Modules\Teams\Models\Teams;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Players extends Model
{
    use HasFactory;

    protected $table = "players";

    protected $fillable = [
        'first_name',
        'last_name',
        "position",
        "height",
        "weight",
        "jersey_number",
        "college",
        "country",
        "draft_year",
        "draft_round",
        "draft_number"
    ];

    public function team()
    {
        return $this->belongsTo(Teams::class);
    }
}
