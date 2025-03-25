<?php

namespace App\Repositories;

use App\Models\Seat;

class SeatRepository implements SeatRepositoryInterface
{
    public function createseat($data)
    {
        $seat = Seat::create($data);
        return $seat;
    }







    public function getallseats()
    {
        $seats = Seat::all();
        return $seats;
    }
    public function getseat($id)
    {
        $seat = Seat::find($id);
    }
    public function updateseat($id, $data)
    {
        $seat = Seat::find($id);
        $seat->update($data);
        return $seat;
    }
    public function deleteseat($id)
    {
        $seat = Seat::find($id);
        $seat->delete();
        return $seat;
    }
}
