<?php

namespace App\Http\Controllers;

use App\Models\Film;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\FilmStoreRequest;
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
        return response()->json($this->filmRepository->getAllFilms());
    }

    public function store(FilmStoreRequest $request)
    {
        $filmData = $request->validated();
        $filmData['user_id'] = Auth::id();
        $film = $this->filmRepository->createFilm($filmData);

        return response()->json([
            'message' => 'Film created successfully',
            'film' => $film
        ], 201);
    }

    public function update(Request $request, $id)
    {


        return  $film = $this->filmRepository->updateFilm($id, $request->all());
    }

    public function destroy($id)
    {

        return   $this->filmRepository->deleteFilm($id);
    }
}
