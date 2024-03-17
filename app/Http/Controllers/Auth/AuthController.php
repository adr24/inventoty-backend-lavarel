<?php

namespace App\Http\Controllers\Auth;


use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\Auth\UserResource;
use App\Http\Requests\Auth\AuthLoginRequest;
use App\Http\Requests\Auth\AuthRegisterRequest;
use Illuminate\Http\Client\Request as ClientRequest;

class AuthController extends Controller
{
    public function login(AuthLoginRequest $request)
    {
        $credentials = $request->validated();

        if( !Auth::attempt($credentials))
        {
            return response()->json([
                "message" => "Correo o contrasena invalidos"
            ], 422);
        }

        $user = User::find ( Auth::user()['id']);
        $token = $user -> createToken('token')->plainTextToken;
        
        return response()->json([
            "user" => new UserResource($user),
            "token" => $token
        ]);
    }

    public function register(AuthRegisterRequest $request)
    {
        $credentials = $request->validated();


        $user = User::create($credentials);
        //$credentials['password'] = Hash::make($credentials['password']);

        return response()->json([
            "message"=> "usuario registrado con exito",
            "user" => new UserResource($user),
        ], 201);

        
    }

    public function logout(Request $request )
    {
        $user = $request->user();
        $user->currentAccessToken()->delete();

        
    }
}
