<?php

namespace App\Repositories;

interface FilmRepositoryInterface
{
    public function getallfilms();
    public function CreateFilm($data);
    public function getFilm($id);
    public function updateFilm($id, $data);
    public function deleteFilm($id);
}
