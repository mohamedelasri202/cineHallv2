<?php

namespace App\Repositories;


use App\Repositories\FilmRepositoryInterface;
use App\Models\Film;



class FilmRepository implements FilmRepositoryInterface
{

    public function CreateFilm($data)
    {
        return Film::create($data);
    }
    public function getallfilms()
    {
        return Film::all();
    }


    public function getFilm($id)
    {
        return Film::find($id);
    }
    public function updateFilm($id, $data)
    {
        return Film::find($id)->update($data);
    }

    public function deleteFuilm($id)
    {
        return Film::find($id)->delete();
    }
}
