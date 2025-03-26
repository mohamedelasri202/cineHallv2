<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\models\Reservation;
use Carbon\Carbon;

class ExpireReservations implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle()
    {
        // Find all pending reservations that have expired
        $expiredReservations = Reservation::where('status', 'pending')
            ->where('expires_at', '<', Carbon::now())
            ->get();

        foreach ($expiredReservations as $reservation) {
            $reservation->status = 'expired';
            $reservation->save();
        }
    }
}
