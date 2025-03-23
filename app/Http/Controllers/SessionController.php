<?php

namespace App\Http\Controllers;

use App\Repositories\SessionRepository;

use Illuminate\Http\Request;


class SessionController extends Controller
{
    protected $SessionRepository;
    public function __construct(SessionRepository $sessionRepository)
    {
        $this->SessionRepository = $sessionRepository;
    }

    public function store(Request $request)
    {
        $request = $this->SessionRepository->CreateSession($request->all());
        return response()->json($request);
    }

    public function update(Request $request, $id)
    {

        return  $session = $this->SessionRepository->updateSession($id, $request->all());
    }
    public function destroy($id)
    {
        return $this->SessionRepository->deleteSession($id);
    }
    public function filter($type)
    {
        return $this->SessionRepository->filter($type);
    }
}
