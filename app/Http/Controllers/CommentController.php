<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\CommentRecoures;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::all();
        if ($comments->isNotEmpty())
        {
            return CommentRecoures::collection($comments);
        }
        return response()->json(['msg'=>'No comments found at all']);
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'comment_id' => 'required|integer|unique:comments,comment_id',
            'title' => 'required|string',
            'body' => 'required|string',
        'user_id'=>'required|exists:users,id',
            'post_id'=>'required|exists:posts,id',]);
        $comments = Comment::create($validated);

        return response()->json($comments, Response::HTTP_CREATED);
    }
    public function update(Request $request, $id)
    {
        $comments = Comment::where('id', $id)->first();
        if (!$comments)
        {
            return response()->json(['msg','No comments found'], Response::HTTP_NOT_FOUND);
        }
        $comments->update($request->all());
        return response()->json($comments, Response::HTTP_ACCEPTED);
    }
    public function destroy($id)
    {
        $comments = Comment::where('id', $id)->first();
        if (!$comments) {
            return response()->json(['message'=>'No data found'], Response::HTTP_NOT_FOUND);
        }
        $comments->delete();
        return response()->json('Deleted successfully', Response::HTTP_OK);
    }

}
