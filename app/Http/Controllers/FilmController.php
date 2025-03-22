<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\Repositories\FilmRepository;
use Illuminate\Support\Facades\Auth;


use App\Http\Requests\filmStoreRequest;
use App\Repositories\FilmRepositoryInterface;

class FilmController extends Controller
{

    protected $filmRepository;

    public function __construct(FilmRepositoryInterface $filmRepository)
    {
        $this->filmRepository = $filmRepository;
    }

    public function index()
    {
        return response()->json($this->filmRepository->getallfilms());
    }


    public function store(filmStoreRequest $request)
    {
        // Get validated request data
        $filmData = $request->validated();

        // Attach the authenticated user's ID
        $filmData['user_id'] = Auth::id();

        // Create the film using the repository
        $film = $this->filmRepository->CreateFilm($filmData);

        return response()->json([
            'message' => 'Film created successfully',
            'film' => $film
        ], 201);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'string|max:255',
            'description' => 'string',
            'image' => 'string|max:255',
            'duree' => 'integer|min:1',
            'minimum_age' => 'integer|min:1',
            'trailer' => 'string|max:255',
            'genre' => 'string|max:255',
        ]);

        // Update the film using the repository
        $film = $this->filmRepository->updateFilm($id, $request->all());

        // Check if the film exists
        if (!$film) {
            return response()->json(['error' => 'Film not found'], 404);
        }

        // Check if the current user is the one who created the film
        if ($film->user_id !== auth()->id()) {
            return response()->json([
                'error' => 'You are not authorized to update this film because you did not create it.'
            ], 403); // Forbidden status code for unauthorized actions
        }

        return response()->json([
            'message' => 'Film updated successfully',
            'film' => $film // Return the updated film object instead of request data
        ]);
    }
}
