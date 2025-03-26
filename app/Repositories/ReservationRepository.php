<?php

namespace App\Repositories;

use App\Models\Reservation;
use Illuminate\Support\Facades\DB;
use App\Repositories\ReservationRepositoryInterface;

class ReservationRepository implements ReservationRepositoryInterface
{
    public function addreservation($data)
    {
        // Get the logged-in user's ID
        $user_id = auth()->user()->id;
        $data['user_id'] = $user_id;

        // Ensure seat_ids is an array
        $seats = is_array($data['seat_id']) ? $data['seat_id'] : explode(',', $data['seat_id']); // Convert string to array if needed

        // Array to store final seats to reserve
        $finalSeats = [];

        foreach ($seats as $seat_id) {
            // Check if the seat exists
            $seatExists = DB::table('seats')->where('id', $seat_id)->exists();
            if (!$seatExists) {
                return response()->json(['message' => "Seat ID $seat_id does not exist. Please choose a valid seat."], 400);
            }

            // Check if the seat is already reserved
            $seatReserved = DB::table('reservations')->where('seat_id', $seat_id)->exists();
            if ($seatReserved) {
                return response()->json(['message' => "Seat ID $seat_id is already reserved. Please choose another one."], 400);
            }

            // If seat type is 'couple', reserve the next seat too
            if ($data['seat_type'] == 'couple') {
                $next_seat_id = $seat_id + 1; // Automatically reserve the next seat

                // Check if the next seat exists
                $nextSeatExists = DB::table('seats')->where('id', $next_seat_id)->exists();
                if (!$nextSeatExists) {
                    return response()->json(['message' => "The seat type is 'couple', but seat ID $next_seat_id does not exist."], 400);
                }

                // Check if the next seat is reserved
                $nextSeatReserved = DB::table('reservations')->where('seat_id', $next_seat_id)->exists();
                if ($nextSeatReserved) {
                    return response()->json(['message' => "Seat ID $next_seat_id (next seat for 'couple') is already reserved. Please choose another one."], 400);
                }

                // Add both seats to the reservation list
                $finalSeats[] = $seat_id;
                $finalSeats[] = $next_seat_id;
            } else {
                // If seat type is 'solo', reserve only the selected seat
                $finalSeats[] = $seat_id;
            }
        }

        // Insert reservations for all valid seats
        foreach ($finalSeats as $seat_id) {
            $reservationData = $data;
            $reservationData['seat_id'] = $seat_id;
            Reservation::create($reservationData);
        }

        return response()->json(['message' => 'Reservation(s) created successfully.', 'reserved_seats' => $finalSeats]);
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
