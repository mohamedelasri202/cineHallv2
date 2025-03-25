<?php

namespace App\Repositories;

interface RoomRepositoryInterface
{
    public function creatRoom($data);
    public function updateRoom($id, $data);
}
