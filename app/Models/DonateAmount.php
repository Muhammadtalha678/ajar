<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;
class DonateAmount extends Model
{
    use HasFactory;
    protected $table = 'donate_amount';
    protected $fillable = ['donate_amount','post_id','user_id'];
    public function post()
       {
           return $this->belongsTo(Post::class);
       }
}
