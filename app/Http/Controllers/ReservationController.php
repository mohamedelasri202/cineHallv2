<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ReservationRepository;
use App\Http\Requests\ReservationAddRequest;
use App\Repositories\ReservationRepositoryInterface;

class ReservationController extends Controller
{
    protected  $reservationRepository;

    public function __construct(ReservationRepositoryInterface $reservationRepository)
    {
        $this->reservationRepository = $reservationRepository;
    }

    public function store(ReservationAddRequest $request)
    {
        $data = $request->validated();
        $reservation = $this->reservationRepository->addreservation($data);
        return response()->json(['message' => 'reservation has been created successfully', 'reservation' => $reservation]);
    }
}
