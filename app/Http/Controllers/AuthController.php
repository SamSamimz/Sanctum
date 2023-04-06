<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Client\ResponseSequence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //___store 
    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:4|confirmed',
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' =>Hash::make($request->password),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Register successfully!',
            'token' => $token,
        ]);
    }

    //___login
    public function login(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:4'
        ]);

        $user = User::where('email',$request->email)->first();
        if(!$user || !Hash::check($request->password,$user->password)) {
            return response()->json([
                "inavlid" => "invalid login information",
            ]);
        }
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json([
            'message' => 'login success!',
            'token' => $token,
        ]);
    }

    //__logout 
    public function logout(Request $request) {
        $request->user()->tokens()->delete();
        return response()->json([
            'alert' => 'logout successfully!',
        ]);

    }


}
