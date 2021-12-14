<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $user = Auth::user();
            $success['token'] =  $user->createToken('nApp')->accessToken;
            $success['user_id'] =  $user["id"];
            return response()->json([
                "status" => "success",
                "code" => 200,
                "data" => $success
            ]);
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }
}
