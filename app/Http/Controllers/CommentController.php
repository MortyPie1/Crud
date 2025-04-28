<?php

namespace App\Http\Controllers;

use App\Http\Requests\Comment\CreateCommentRequest;
use App\Http\Requests\Comment\UpdateCommentRequest;
use App\Models\Comment;
use Symfony\Component\HttpFoundation\Response;


class CommentController extends Controller
{
    public function index()
    {
        return Comment::with('user', 'post')->get();
    }
    public function store(CreateCommentRequest $request)
    {
        $data = $request->validated();
        Comment::create($data);
        return response()->json(["message" => "Comment Created"], Response::HTTP_CREATED);

    }
    public function update(UpdateCommentRequest $request, $id)
    {
        $comment = Comment::where('id', $id)->first();
        if(!$comment) {
            return response()->json(['message','No comments found'], Response::HTTP_NOT_FOUND);
        }
        $comment->update($request->validated());
        return response()->json(["message" => "Comment created"], Response::HTTP_ACCEPTED);
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
