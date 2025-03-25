<?php

namespace App\Providers;

use App\Repositories\FilmRepository;
use App\Repositories\RoomRepository;
use App\Repositories\SessionRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\FilmRepositoryInterface;
use App\Repositories\RoomRepositoryInterface;
use App\Repositories\SessionRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        $this->app->bind(FilmRepositoryInterface::class, FilmRepository::class);
        $this->app->bind(SessionRepositoryInterface::class, SessionRepository::class);
        $this->app->bind(RoomRepositoryInterface::class, RoomRepository::class);
    }
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
