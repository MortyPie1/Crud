<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function register(Request $request){
        $fields = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|digits_between:10,12|unique:users,phone',
            'password' => 'required|confirmed',
        ]);
        $user = User::create($fields);
        $token = $user->createToken($request->name);
        return [
            'user' => $user,
            'token' => $token->plainTextToken,
        ];
    }
    public function login(Request $request){
        $fields = $request->validate([
            'phone' => 'required|digits_between:10,12|exists:users',
            'password' => 'required']);
        $user = User::where('phone', $request->phone)->first();
        if (!$user || !Hash::check(request('password'), $user->password)) {
            return ['message' => 'These credentials do not.'];
        }
        $token = $user->createToken($user->name);
        return [
            'user' => $user,
            'token' => $token->plainTextToken,
        ];
    }
    public function logout(Request $request){
        $request->user()->tokens()->delete();
        return ['message' => 'Logged out'];
    }

}
