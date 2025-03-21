<?php

namespace App\Http\Controllers;

use app\Repositories\FilmRepository;
use App\Repositories\FilmRepositoryInterface;


use Illuminate\Http\Request;

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

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|string|max:255',
            'duree' => 'required|integer|min:1',
            'minimum_age' => 'required|integer|min:1',
            'trailer' => 'required|string|max:255',
            'genre' => 'required|string|max:255',




        ]);

        $film = $this->filmRepository->CreateFilm($request->all());

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

        $film = $this->filmRepository->updateFilm($id, $request->all());

        if (!$film) {
            return response()->json(['error' => 'film not found'], 404);
        }
        return response()->json([
            'message' => 'film updated successfully',
            'film' => $request->all()
        ]);
    }
}
