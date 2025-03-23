<?php

namespace App\Providers;

use App\Repositories\SessionRepository;
use App\Repositories\FilmRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\FilmRepositoryInterface;
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
    }
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
