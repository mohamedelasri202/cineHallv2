<?php

namespace App\Repositories;

interface ReservationRepositoryInterface
{

    public function addreservation($data);
    public function getallreservations();
    public function getreservation($id);
    public function updatereservation($id, $data);
    public function deletereservation($id);
}
