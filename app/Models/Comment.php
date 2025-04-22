<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Comment extends Model
{
    use HasFactory;
    protected $table = 'comments';
    protected $fillable =
        [
            'comment_id',
            'title',
            'body',
            'post_id',
            'user_id'

        ];
    public function post()
    {
        return $this->hasMany(Post::class);

    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
