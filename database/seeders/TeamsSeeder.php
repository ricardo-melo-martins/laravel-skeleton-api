<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class TeamsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if(Config::get('tests.enabled')) return;

        $teamData = [
            'conference' => Str::random(35),
            'division' => Str::random(60),
            'city' => Str::random(36),
            'name' => Str::random(10),
            'full_name' => Str::random(10),
            'abbreviation' => Str::random(10),
        ];
        // Criar um usuário que eu saiba a senha
        DB::table('teams')->insert($teamData);
    }
}
