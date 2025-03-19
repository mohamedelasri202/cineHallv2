<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    public function insertroles()
    {

        DB::table('roles')->insert([
            ['role' => 'admin'],
            ['role' => 'user'],
        ]);
        return response()->json(['message' => 'Roles inserted successfully']);
    }
}
