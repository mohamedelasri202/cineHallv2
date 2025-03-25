<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\SeatRepositories;
use App\Repositories\SeatRepository;
use App\Http\Requests\SeatStoreRequest;

class SeatController extends Controller
{
    protected $seatRepository;
    public function __construct(SeatRepository $seatRepository)
    {
        $this->seatRepository = $seatRepository;
    }

    public function store(SeatStoreRequest $request)
    {
        $data = $request->validated();
        $seat = $this->seatRepository->createseat($data);
        return response()->json(['message' => 'seat has been created successfully', 'seat' => $seat]);
    }
}
