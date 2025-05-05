<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;


class Comment extends Model
{
    use HasFactory;
    protected $table = 'comments';
    protected $fillable =
        [
            'post_id',
            'user_id',
            'body'

        ];
    public function post()
    {
        return $this->belongsTo(Post::class);

    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function getBelongAttribute(){
        return auth()->id() === $this->user_id;


        $mypost = $this ->user_id;
        if($mypost == auth::id()){
            return true;
        }
        return false;

    }
    protected $appends = ['Belong'];

}
