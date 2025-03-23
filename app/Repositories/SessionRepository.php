<?php

namespace App\Repositories;

use App\Repositories\SessionRepositoryInterface;
use App\Models\Session;

class SessionRepository implements SessionRepositoryInterface
{
    public function CreateSession($data)
    {
        return Session::create($data);
    }
    public function getallsessions()
    {
        return Session::all();
    }
    public function getSession($id)
    {
        return Session::find($id);
    }
    public function updateSession($id, $data)
    {
        // Find the session
        $session = Session::find($id);

        // If session not found, return a 404 response
        if (!$session) {
            return response()->json(['error' => 'Session not found'], 404);
        }

        // Check if $data is null or empty before updating
        if (empty($data)) {
            return response()->json(['error' => 'No data provided to update'], 400);
        }

        // Update the session
        $session->update($data);

        // Return success response
        return response()->json([
            'message' => 'Session updated successfully',
            'session' => $session
        ]);
    }


    public function deleteSession($id)
    {
        $session = Session::find($id);
        if (!$session) {
            return response()->json(['error', 'the session is not found']);
        }

        $session->delete();

        return response()->json(['message', 'the session is deleted successfully']);
    }
}
