<?php

namespace App\Providers;

use App\Repositories\FilmRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\FilmRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        $this->app->bind(FilmRepositoryInterface::class, FilmRepository::class);
    }
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
