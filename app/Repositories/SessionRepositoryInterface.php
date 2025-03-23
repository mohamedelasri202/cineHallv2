<?php

namespace App\Repositories;

interface SessionRepositoryInterface
{
    public function getallsessions();
    public function CreateSession($data);
    public function getSession($id);
    public function updateSession($id, $data);
    public function deleteSession($id);
    public function filter($type);
}
