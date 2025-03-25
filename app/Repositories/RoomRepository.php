<?php

namespace App\Repositories;

use App\Models\Room;
use App\Repositories\RoomRepositoryInterface;


class RoomRepository implements RoomRepositoryInterface
{
    public function creatRoom($data)
    {
        return Room::create($data);
    }
}
