<?php

namespace App\Repositories;

use App\Models\Reservation;
use Illuminate\Support\Facades\DB;
use App\Repositories\ReservationRepositoryInterface;

class ReservationRepository implements ReservationRepositoryInterface
{
    public function addreservation($data)
    {
        $user_id = auth()->user()->id;
        $data['user_id'] = $user_id;

        // Set expiration time to 15 minutes from now
        $data['expires_at'] = now()->addMinutes(15);
        $data['status'] = 'pending';

        $seats = is_array($data['seat_id']) ? $data['seat_id'] : explode(',', $data['seat_id']);
        $finalSeats = [];
        $reservationIds = [];

        if (count($seats) == 1 && $data['seat_type'] == 'couple') {
            $seat_id = $seats[0];
            $next_seat_id = $seat_id + 1;

            if (!DB::table('seats')->where('id', $seat_id)->exists() || !DB::table('seats')->where('id', $next_seat_id)->exists()) {
                return response()->json(['message' => "One of the selected seats does not exist."], 400);
            }

            if (DB::table('reservations')->whereIn('seat_id', [$seat_id, $next_seat_id])->exists()) {
                return response()->json(['message' => "One of the selected seats is already reserved. Please choose another one."], 400);
            }

            $finalSeats = [$seat_id, $next_seat_id];
        } elseif (count($seats) == 2 && $data['seat_type'] == 'couple') {
            foreach ($seats as $seat_id) {
                if (!DB::table('seats')->where('id', $seat_id)->exists()) {
                    return response()->json(['message' => "Seat ID $seat_id does not exist."], 400);
                }

                if (DB::table('reservations')->where('seat_id', $seat_id)->exists()) {
                    return response()->json(['message' => "Seat ID $seat_id is already reserved. Please choose another one."], 400);
                }
            }

            $finalSeats = $seats;
        } else {
            foreach ($seats as $seat_id) {
                if (!DB::table('seats')->where('id', $seat_id)->exists()) {
                    return response()->json(['message' => "Seat ID $seat_id does not exist."], 400);
                }

                if (DB::table('reservations')->where('seat_id', $seat_id)->exists()) {
                    return response()->json(['message' => "Seat ID $seat_id is already reserved. Please choose another one."], 400);
                }

                $finalSeats[] = $seat_id;
            }
        }

        // Create a reservation for each seat
        foreach ($finalSeats as $seat_id) {
            $reservationData = $data;
            $reservationData['seat_id'] = $seat_id;
            $reservation = Reservation::create($reservationData);
            $reservationIds[] = $reservation->id;
        }

        return response()->json([
            'message' => 'Reservation(s) created successfully.',
            'reserved_seats' => $finalSeats,
            'reservation_ids' => $reservationIds,
            'expires_at' => $data['expires_at']->toIso8601String()
        ]);
    }



public function cancellreservation($id)
{
    $reservation = Reservation::find($id);

    if (!$reservation) {
        return response()->json(['message' => 'Reservation not found'], 404);
    }

    // Only pending or payment-failed reservations can be cancelled
    if (!in_array($reservation->status, ['pending', 'payment_failed'])) {
        return response()->json(['message' => 'Reservation cannot be cancelled. It is not in pending status.'], 400);
    }

    $reservation->status = 'cancelled';
    $reservation->save();

    return response()->json(['message' => 'Your reservation has been cancelled. Thank you for your time.'], 200);
}



    public function updatereservation($id, $data)
    {

        $reservation = Reservation::find($id);

        if (!$reservation) {
            return response()->json(['error' => 'Reservation not found'], 404);
        }


        if (!isset($data['seat_id'])) {
            return response()->json(['error' => 'seat_id is required'], 400);
        }


        $reservation->update($data);

        return response()->json([
            'message' => 'Your reservation has been updated successfully',
            'reservation' => $reservation
        ], 200);
    }

    public function getallreservations()
    {
        $reservations = Reservation::where('status', 'confirmed')->get();
        if($reservations->isEmpty()) {
            return response()->json(['message'=>'there are no reservations yet.'], 200);
        }
        return $reservations;
    }
    public function getreservation($id)
    {
        $reservation = Reservation::find($id);
        return $reservation;
    }
}
