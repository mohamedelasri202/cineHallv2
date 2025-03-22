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

        $film = Film::find($id);

        if (!$film) {
            return null;
        }
        if (!$film) {
            return response()->json(['error' => 'Film not found'], 404);
        }

        if ($film->user_id !== auth()->id()) {
            return response()->json([
                'error' => 'You are not authorized to update this film because you did not create it.'
            ], 403);
        }


        $film->update($data);

        return response()->json([
            'message' => 'Film updated successfully',
            'film' => $film // Return the updated film object instead of request data
        ]);
    }


    public function deleteFilm($id)
    {
        return Film::findOrFail($id)->delete();
    }
}
