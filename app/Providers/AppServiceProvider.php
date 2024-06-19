<?php

namespace App\Providers;

use App\Modules\Games\Repositories\GameRepository;
use App\Modules\Games\Services\GameService;
use App\Modules\Players\Repositories\PlayerRepository;
use App\Modules\Players\Services\PlayerService;
use App\Modules\Teams\Repositories\TeamRepository;
use App\Modules\Teams\Services\TeamService;
use Illuminate\Support\ServiceProvider;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(TeamRepository::class, TeamRepository::class);
        $this->app->bind(TeamService::class, function ($app) {
            return new TeamService($app->make(TeamRepository::class));
        });

        $this->app->bind(PlayerRepository::class, PlayerRepository::class);
        $this->app->bind(PlayerService::class, function ($app) {
            return new PlayerService($app->make(PlayerRepository::class));
        });

        $this->app->bind(GameRepository::class, GameRepository::class);
        $this->app->bind(GameService::class, function ($app) {
            return new GameService($app->make(GameRepository::class));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
