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
        $film = Film::find($id); // Find the film by its ID

        // If film not found, return false or null
        if (!$film) {
            return null; // Or return false
        }

        // Update the film with the given data
        $film->update($data);

        return $film; // Return the updated film object
    }


    public function deleteFuilm($id)
    {
        return Film::find($id)->delete();
    }
}
