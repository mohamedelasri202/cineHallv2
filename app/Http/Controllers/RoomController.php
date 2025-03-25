<?php

namespace App\Http\Controllers;

use App\Repositories\RoomRepository;
use App\Models\Room;
use App\Repositories\RoomRepositories;
use Illuminate\Http\Request;


class RoomController extends Controller
{
    protected $roomRepository;
    public function __construct(RoomRepository $roomRepository)
    {
        $this->roomRepository = $roomRepository;
    }

    public function store(Request $request)
    {
        $request = $this->roomRepository->creatRoom($request->all());
    }
}
