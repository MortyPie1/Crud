<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\UserRecoures;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        if ($users->isNotEmpty())
        {
            return UserRecoures::collection($users);
        }
        return response()->json(['msg'=>'No user found']);
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'comment_id' => 'required|integer|unique:comments,comment_id',
            'title' => 'required|string',
            'body' => 'required|string']);
        $users = User::create($validated);

        return response()->json($users, Response::HTTP_CREATED);
    }
    public function update(Request $request, $id)
    {
        $users = User::where('id', $id)->first();
        if (!$users)
        {
            return response()->json(['msg','No user found'], Response::HTTP_NOT_FOUND);
        }
        $users->update($request->all());
        return response()->json($users, Response::HTTP_ACCEPTED);
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
