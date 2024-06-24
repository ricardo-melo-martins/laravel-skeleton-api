<?php

namespace App\Modules\Teams\Dtos;

use Carbon\Carbon;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class TeamReadDto extends Data
{
    public function __construct(
        public int|null|Optional $id,
        public ?int             $external_team_id,
        public ?string          $conference,
        public ?string          $division,
        public ?string          $city,
        public string           $name,
        public string           $full_name,
        public string           $abbreviation,
        public ?Carbon          $created_at,
        public ?Carbon          $updated_at,
    ) {
    }
}
