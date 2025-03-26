<?php

namespace App\Repositories;

use App\Models\Reservation;
use App\Repositories\ReservationRepositoryInterface;

class ReservationRepository implements ReservationRepositoryInterface
{
    public function addreservation($data)
    {
        $user_id = auth()->user()->id;
        if ($user_id != $request->user_id) {
            return response()->json(['error' => 'the user_id is false please chose another one'], 403);
        }
        $data['user_id'] = $user_id;
        $reservation = Reservation::create($data);
        return $reservation;
    }
    public function getallreservations()
    {
        $reservations = Reservation::all();
        return $reservations;
    }
    public function getreservation($id)
    {
        $reservation = Reservation::find($id);
        return $reservation;
    }
    public function updatereservation($id, $data)
    {
        $reservation = Reservation::find($id);
        $reservation->update($data);
        return $reservation;
    }
    public function deletereservation($id)
    {
        $reservation = Reservation::find($id);
        $reservation->delete();
        return $reservation;
    }
}
