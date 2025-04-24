<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\LoginUserRequest;
use App\Models\User;
use App\Http\Requests\User\CreateUserRequest;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Routing\Controller;


class JwtAuthController extends Controller
{
    public function __construct(){
        $this->middleware('auth:api',['except'=>['login','register']]);
    }
    public function register(CreateUserRequest $request){
        $data = $request->validated();
        User::create($data);
        return response()->json(["message" => "Account has been registered"], Response::HTTP_CREATED);
    }
    public function login(LoginUserRequest $request){
        $data = $request->validated();
        if(!$token=auth()->attempt($data) ){
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return $this->createNewToken($token);

    }
    public function createNewToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires'=>auth()->factory()->getTTL()*60,
            'user' => auth()->user()
        ]);
    }
    public function logout(Request $request){
        auth()->logout();
        return response()->json(['message' => 'you are logged out now'], 201);
    }
}
