<?php

namespace App\Repositories;

use App\Models\Room;
use App\Repositories\RoomRepositoryInterface;


class RoomRepository implements RoomRepositoryInterface
{
    public function creatRoom($data)
    {
        $room = Room::create($data);
        return $room;
    }
}
