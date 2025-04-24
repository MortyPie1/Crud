<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\CreatePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\PostRecoures;

class PostController extends Controller
{
    public function index()
    {
        return Post::with('user')->get()->makeHidden(['post_id', 'user_id','id', 'created_at', 'updated_at']);
        // $posts = Post::all();
        // if ($posts->isNotEmpty())
        // {
        //     return PostRecoures::collection($posts);
        // }
        // return response()->json(['msg'=>'No posts found']);
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
        Post::create($data);
        return response()->json(["message" => "Posts Created"], Response::HTTP_CREATED);

        // $validated = $request->validate([
        //     'comment_id' => 'required|integer|unique:comments,comment_id', // xxxx
        //     'title' => 'required|string',
        //     'body' => 'required|string'
        // ]);
        // $posts = Post::create($validated);
        // return response()->json($posts, Response::HTTP_CREATED);
    }
    public function update(UpdatePostRequest $request, $id)
    {
        $posts = Post::where('id', $id)->first();
        if (!$posts) {
            return response()->json(['message', 'No posts found'], Response::HTTP_NOT_FOUND);
        }
        $posts->update($request->validated());
        return response()->json(["message" => "Post updated"], Response::HTTP_ACCEPTED);

        // $posts = Post::where('id', $id)->first();
        // if (!$posts)
        // {
        //     return response()->json(['msg','No posts found'], Response::HTTP_NOT_FOUND);
        // }
        // $posts->update($request->all());
        // return response()->json($posts, Response::HTTP_ACCEPTED);
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
