<?php

namespace App\Http\Controllers;

use App\Http\Requests\Comment\UpdateCommentRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Http\Requests\User\UpdateUserRequest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use Symfony\Component\HttpFoundation\Response;


class AdminController extends Controller
{
    public function Statics(){
        return response()->json([
            'users_count'=>User::count(),
            'posts_count'=>Post::count(),
            'comments_count'=>Comment::count(),]);
    }
    public function UsersInfo($id){
        $user = User::where('id', $id)->withCount(['posts','comments'])->first();

        if (!$user) {
            return response()->json(['message'=>'No data found'], Response::HTTP_NOT_FOUND);
        }
        $user -> makeHidden(['created_at', 'updated_at','phone','role']);
        return response()->json([
            'users' => $user]);
    }

    public function update(Request $request,String $type, $id)
    {
        $validation = match ($type) {
            'user'=>app(UpdateUserRequest::class)->validated(),
            'post'=>app(UpdatePostRequest::class)->validated(),
            'comment'=>app(UpdateCommentRequest::class)->validated(),
            default => null
            };
        if (!$validation===null) {
            return response()->json(['message' => 'Type wasnt found'], Response::HTTP_NOT_FOUND);
        }
            $model = match ($type) {
                'user' => User::class,
                'post' => Post::class,
                'comment' => Comment::class,
                default => null
            };
        if (!$model===null) {
            return response()->json(['message' => 'Type wasnt found'], Response::HTTP_NOT_FOUND);
        }
            $requestType = $model::where('id', $id)->first();
            if (!$requestType){
                return response()->json(['message','Type is not found'], Response::HTTP_NOT_FOUND);}

                $requestType->update($validation);
                return response()->json(["message" => "User updated"], Response::HTTP_ACCEPTED);

        }
        public function delete(Request $request,String $type, $id)
    {
            $model = match ($type) {
                'user' => User::class,
                'post' => Post::class,
                'comment' => Comment::class,
                default => null
            };
        if (!$model===null) {
            return response()->json(['message' => 'Type wasnt found'], Response::HTTP_NOT_FOUND);
        }
            $requestType = $model::where('id', $id)->first();
            if (!$requestType){
                return response()->json(['message','Type is not found'], Response::HTTP_NOT_FOUND);}

                $requestType->delete();
                return response()->json(["message" => "the info got deleted"], Response::HTTP_ACCEPTED);

        }
}

