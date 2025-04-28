<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function index()
    {
        return User::get();
    }

    public function show($id)
    {
        $user = User::where('id', $id)->first();
        if (!$user) {
            return response()->json(['message'=>'No data found'], Response::HTTP_NOT_FOUND);
        }
        return $user;
    }
    public function store(CreateUserRequest $request)
    {
        $data = $request->validated();
        User::create($data);
        return response()->json(["message" => "User Created"], Response::HTTP_CREATED);
    }
    public function update(UpdateUserRequest $request, $id)
    {
        $users = User::where('id', $id)->first();
        if(!$users) {
            return response()->json(['message','No user found'], Response::HTTP_NOT_FOUND);
        }
        $users->update($request->validated());
        return response()->json(["message" => "User updated"], Response::HTTP_ACCEPTED);

    }
    public function destroy($id)
    {
        $users = User::where('id', $id)->first();
        if (!$users) {
            return response()->json(['message'=>'No data found'], Response::HTTP_NOT_FOUND);
        }
        $users->delete();
        return response()->json('Deleted successfully', Response::HTTP_OK);
    }

}
