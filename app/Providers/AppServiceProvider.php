<?php

namespace App\Providers;

use App\Repositories\FilmRepository;
use App\Repositories\RoomRepository;
use App\Repositories\SeatRepository;
use App\Repositories\SessionRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\ReservationRepository;
use App\Repositories\FilmRepositoryInterface;
use App\Repositories\RoomRepositoryInterface;
use App\Repositories\SeatRepositoryInterface;
use App\Repositories\SessionRepositoryInterface;
use App\Repositories\ReservationRepositoryInterface;

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
        $this->app->bind(SeatRepositoryInterface::class, SeatRepository::class);
        $this->app->bind(ReservationRepositoryInterface::class, ReservationRepository::class);
    }
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
