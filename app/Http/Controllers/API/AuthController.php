<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:5',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        $token = $user->createToken('Task-5-fullstack')->accessToken;

        return response()->json(['message' => 'success', 'token' => $token], 200);
    }

    public function login(Request $request)
    {
        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (auth()->attempt($data)) {
            $token = auth()->user()->createToken('Task-5-fullstack')->accessToken;
            return response()->json(['message' => 'success', 'token' => $token], 200);
        } else {
            return response()->json(['message' => 'error', 'error' => 'Unauthorised'], 401);

        }
    }

    public function details()
    {
        $user = auth()->user();

        return response()->json(['user' => $user], 200);
    }
}
