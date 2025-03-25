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
            return response()->json(['error' => 'Film not found'], 404);
        }


        if ($film->user_id !== auth()->id()) {
            return response()->json([
                'error' => 'You are not authorized to update this film because you did not create it.'
            ], 403);
        }


        $film->update($data);

        // Return success response
        return response()->json([
            'message' => 'Film updated successfully',
            'film' => $film
        ]);
    }



    public function deleteFilm($id)
    {
        // Find the film
        $film = Film::find($id);

        // If film not found, return a 404 response
        if (!$film) {
            return response()->json(['error' => 'Film not found'], 404);
        }

        // Check if the authenticated user is the owner of the film
        if ($film->user_id !== auth()->id()) {
            return response()->json([
                'error' => 'You are not authorized to delete this film because you did not create it.'
            ], 403);
        }

        // Delete the film
        $film->delete();

        // Return success response
        return response()->json(['message' => 'Film deleted successfully'], 200);
    }
}
