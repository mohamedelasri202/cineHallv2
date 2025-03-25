<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\SeatRepositories;
use App\Repositories\SeatRepository;
use App\Http\Requests\SeatStoreRequest;
use App\Http\Requests\SeatupdateRequest;

class SeatController extends Controller
{
    protected $seatRepository;
    public function __construct(SeatRepository $seatRepository)
    {
        $this->seatRepository = $seatRepository;
    }
    // the add methode of the seat 
    public function store(SeatStoreRequest $request)
    {
        $data = $request->validated();
        $seat = $this->seatRepository->createseat($data);
        return response()->json(['message' => 'seat has been created successfully', 'seat' => $seat]);
    }
    // update methode of the seat 
    public function update(SeatupdateRequest $request, $id)
    {
        $data = $request->validated();

        $seat = $this->seatRepository->updateseat($id, $data);

        return response()->json(['message' => 'seat has been updated successfully', 'seat' => $seat]);
    }
    public function destroy($id)
    {
        $seat = $this->seatRepository->deleteseat($id);
        return response()->json(['message' => 'seat has been deleted successfully', 'seat' => $seat]);
    }
}
