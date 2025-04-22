<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\CommentRecoures;
use App\Http\Resources\UserRecoures;


class PostRecoures extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'post_id'=>$this ->post_id,
            'title'=>$this ->title,
            'body'=>$this ->body,
            'comments' => CommentRecoures::collection($this->comments),
            'user_id'=>$this ->user_id
        ];
    }
}
