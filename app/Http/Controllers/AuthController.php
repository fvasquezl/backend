<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use App\Http\Resources\User as UserResource;
use App\User;
use App\Http\Requests\UserRegisterRequest;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(UserRegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        if(!$token = auth()->attempt($request->only(['email','password']))){
            return abort(401);
        }

        return (new UserResource($request->user()))->additional([
            'meta' => [
                'token'=> $token
            ]
        ]);
    }

    public function login(UserLoginRequest $request)
    {

        if(!$token = auth()->attempt($request->only(['email','password']))){
            return response()->json([
                'errors'=>[
                    'email'=>['Sorry we cant find you with those details']
                ]
            ],422);
        }

        return (new UserResource($request->user()))->additional([
            'meta' => [
                'token'=> $token
            ]
        ]);
    }

    public function user(Request $request)
    {
        return new UserResource($request->user());
    }

    public function logout()
    {
        auth()->logout();
    }
}
