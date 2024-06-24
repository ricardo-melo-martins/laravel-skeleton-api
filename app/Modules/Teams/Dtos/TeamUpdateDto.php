<?php

namespace App\Modules\Teams\Dtos;

use Spatie\LaravelData\Data;

class TeamUpdateDto extends Data
{
    public function __construct(
        public ?string          $conference,
        public ?string          $division,
        public ?string          $city,
        public string           $name,
        public string           $full_name,
        public string           $abbreviation
    )
    {
    }

}
