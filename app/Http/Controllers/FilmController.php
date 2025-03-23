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
        return    $film = $this->filmRepository->updateFilm($id, $request->all());
    }
    public function destroy($id)
    {

        return $this->filmRepository->deleteFilm($id);
    }
}
