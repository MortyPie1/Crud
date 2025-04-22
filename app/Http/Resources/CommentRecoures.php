<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\PostRecoures;


class CommentRecoures extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'comment_id'=>$this ->comment_id,
            'title'=>$this ->title,
            'body'=>$this ->body,
            'posts' => PostRecoures::collection($this->commnets),
            'user_id'=>$this ->user_id
        ];
    }
}
