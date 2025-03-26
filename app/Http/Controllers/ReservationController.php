<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ReservationRepository;
use App\Http\Requests\ReservationAddRequest;
use App\Http\Requests\ReservationUpdateRequest;
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
        return response()->json(['reservation' => $reservation]);
    }
    public function getallresrvations()
    {
        return $this->reservationRepository->getallreservations();
    }
    public function cancellreservation($id)
    {
        return $this->reservationRepository->cancellreservation($id);
    }
    public function updatereservation(ReservationUpdateRequest $request, $id){
    $data = $request->validated();
    $reservation = $this->reservationRepository->updatereservation($id, $data);
}

}
