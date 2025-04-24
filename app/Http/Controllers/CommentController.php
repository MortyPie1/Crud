<?php

namespace App\Http\Controllers;

use App\Http\Requests\Comment\CreateCommentRequest;
use App\Http\Requests\Comment\UpdateCommentRequest;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\CommentRecoures;


class CommentController extends Controller
{
    public function index()
    {

        return Comment::with('user', 'post')->get();
        // $comments = Comment::all();
        // if ($comments->isNotEmpty())
        // {
        //     return CommentRecoures::collection($comments);
        // }
        // return response()->json(['msg'=>'No comments found']);
    }
    public function store(CreateCommentRequest $request)
    {
        $data = $request->validated();
        Comment::create($data);
        return response()->json(["message" => "Comment Created"], Response::HTTP_CREATED);
        // $validated = $request->validate([
        //     'comment_id' => 'required|integer|unique:comments,comment_id',
        //     'title' => 'required|string',
        //     'body' => 'required|string']);
        // $comments = Comment::create($validated);

        // return response()->json($comments, Response::HTTP_CREATED);
    }
    public function update(UpdateCommentRequest $request, $id)
    {
        $comment = Comment::where('id', $id)->first();
        if(!$comment) {
            return response()->json(['message','No comments found'], Response::HTTP_NOT_FOUND);
        }
        $comment->update($request->validated());
        return response()->json(["message" => "Comment created"], Response::HTTP_ACCEPTED);
        // $comments = Comment::where('id', $id)->first();
        // if (!$comments)
        // {
        //     return response()->json(['msg','No comments found'], Response::HTTP_NOT_FOUND);
        // }
        // $comments->update($request->all());
        // return response()->json($comments, Response::HTTP_ACCEPTED);
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
