<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\PostRecoures;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        if ($posts->isNotEmpty())
        {
            return PostRecoures::collection($posts);
        }
        return response()->json(['msg'=>'No posts found']);
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'comment_id' => 'required|integer|unique:comments,comment_id',
            'title' => 'required|string',
            'body' => 'required|string']);
        $posts = Post::create($validated);

        return response()->json($posts, Response::HTTP_CREATED);
    }
    public function update(Request $request, $id)
    {
        $posts = Post::where('id', $id)->first();
        if (!$posts)
        {
            return response()->json(['msg','No posts found'], Response::HTTP_NOT_FOUND);
        }
        $posts->update($request->all());
        return response()->json($posts, Response::HTTP_ACCEPTED);
    }
    public function destroy($id)
    {
        $posts = Post::where('id', $id)->first();
        if (!$posts) {
            return response()->json(['message'=>'No data found'], Response::HTTP_NOT_FOUND);
        }
        $posts->delete();
        return response()->json('Deleted successfully', Response::HTTP_OK);
    }

}
