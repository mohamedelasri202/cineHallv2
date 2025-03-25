<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use App\Repositories\RoomRepository;
use App\Repositories\RoomRepositories;
use App\Http\Requests\RoomStoreRequest;



class RoomController extends Controller
{
    protected $roomRepository;
    public function __construct(RoomRepository $roomRepository)
    {
        $this->roomRepository = $roomRepository;
    }

    public function store(RoomStoreRequest $request)
    {
        $data =  $request->validated();
        $room = $this->roomRepository->creatRoom($data);
        return response()->json(['message' => 'room has been created suuccessfully', 'room' => $room]);
    }
}
