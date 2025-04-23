<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\UserRecoures;

class UserController extends Controller
{
    public function index()
    {
        return User::get();
        // $users = User::all();
        // if ($users->isNotEmpty())
        // {
        //     return UserRecoures::collection($users);
        // }
        // return response()->json(['msg'=>'No user found']);
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
        
        // $validated = $request->validate([
        //     'comment_id' => 'required|integer|unique:comments,comment_id',
        //     'title' => 'required|string',
        //     'body' => 'required|string']);
        // $users = User::create($validated);
        // return response()->json($users, Response::HTTP_CREATED);
    }
    public function update(UpdateUserRequest $request, $id)
    {
        $users = User::where('id', $id)->first();
        if(!$users) {
            return response()->json(['message','No user found'], Response::HTTP_NOT_FOUND);
        }
        $users->update($request->validated());
        return response()->json(["message" => "User updated"], Response::HTTP_ACCEPTED);
        // $users = User::where('id', $id)->first();
        // if (!$users)
        // {
        //     return response()->json(['msg','No user found'], Response::HTTP_NOT_FOUND);
        // }
        // $users->update($request->all());
        // return response()->json($users, Response::HTTP_ACCEPTED);
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
