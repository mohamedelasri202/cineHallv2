<?php

namespace App\Repositories;

interface SeatRepositoryInterface
{
    public function createseat($data);
    public function getallseats();
    public function getseat($id);
    public function updateseat($id, $data);
    public function deleteseat($id);
}
