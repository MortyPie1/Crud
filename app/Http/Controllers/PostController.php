<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\CreatePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class PostController extends Controller
{

    public function index()
    {
        return Post::with('user')->get()->makeHidden(['post_id', 'user_id','id', 'created_at', 'updated_at']);
    }
    public function currentUser(){
        $currentuser = auth::id();

        return Post::where('user_id',$currentuser)->with('user')->get();
    }

    public function show($id)
    {
        $posts = Post::with('user', 'comments.user')->where('id', $id)->first();
        if (!$posts) {
            return response()->json(['message' => 'No data found'], Response::HTTP_NOT_FOUND);
        }
        return $posts;
    }

    public function store(CreatePostRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->user()->id;
        Post::create($data);
        return response()->json(["message" => "Posts Created"], Response::HTTP_CREATED);
    }
    public function update(UpdatePostRequest $request, $id)
    {
        $post = Post::where('id', $id)->first();
        if (!$post) {
            return response()->json(['message'=> 'No posts found'], Response::HTTP_NOT_FOUND);
        }
        if ($post['user_id']==auth::id()){
            $post->update($request->validated());
            return response()->json(["message" => "Post updated"], Response::HTTP_ACCEPTED);}
            return response()->json(['message'=>'you are not authorized'], Response::HTTP_FORBIDDEN);
    }
    public function destroy($id)
    {
        $posts = Post::where('id', $id)->first();
        if (!$posts) {
            return response()->json(['message' => 'No data found'], Response::HTTP_NOT_FOUND);
        }
        $posts->delete();
        return response()->json('Deleted successfully', Response::HTTP_OK);
    }
}
