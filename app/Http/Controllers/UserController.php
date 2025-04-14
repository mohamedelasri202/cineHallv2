<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'string|required',
            'email' => 'string|required|unique:users,email',
            'password' => 'string|required|min:6'
        ]);


        $role = DB::table('roles')->where('role', 'user')->first();

        if (!$role) {

            return response()->json(['error' => 'Admin role not found'], 404);
        }


        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $role->id,
        ]);

        return response()->json(['message' => 'User registered successfully', 'user' => $user], 201);
    }


    public function login(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string|min:6'
        ]);

        // Attempt to find the user by email
        $user = User::where('email', $request->email)->first();

        // Check if user exists and the password is correct
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }

        // Generate JWT token for the user
        $token = JWTAuth::attempt(['email' => $request->email, 'password' => $request->password]);

        // Check if token was created successfully
        if (!$token) {
            return response()->json(['error' => 'Could not create token'], 500);
        }

        // Return the token and user information
        return response()->json([
            'message' => 'Login successful',
            'token' => $token,
            'user' => $user
        ]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'string|max:255',
            'email' => 'string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'string|min:6|confirmed',
        ]);


        if ($request->filled('email')) {
            $user->email = $request->email;
        }
        if ($request->filled('name')) {
            $user->name = $request->name;
        }


        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save(); // Save changes

        return response()->json([
            'message' => 'Profile updated successfully!',
            'user' => $user
        ], 200);
    }
    public function destroy(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'password' => 'required|string|min:6'
        ]);

        if (!Hash::check($request->password, $user->password)) {
            return response()->json(['error' => 'invalid password'], 401);
        }
        $user->delete();

        return response()->json(['message' => 'you have successfully deleted your account'], 200);
    }
    public function showloginform()
    {
        return view('auth.login');
    }
    public function showregisterform()
    {
        return view('auth.register');
    }
}
