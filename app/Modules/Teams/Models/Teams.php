<?php

namespace App\Modules\Teams\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teams extends Model
{
    use HasFactory;

    protected $table = "teams";

    protected $fillable = [
        'external_team_id',
        'conference',
        "division",
        "city",
        "name",
        "full_name",
        "abbreviation"
    ];
}
