<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;
use App\Models\User;
class Vote extends Model
{
    use HasFactory;
    protected $table = 'votes';
    protected $fillable = ['post_id','user_id','vote','upvote','downvote'];
    public function post()
        {
            return $this->belongsTo(Post::class);
        }

    public function user()
        {
            return $this->belongsTo(User::class);
        }
}
