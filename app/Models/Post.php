<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Vote;
class Post extends Model
{
    use HasFactory;
    protected $table = 'verified_posting';
    protected $fillable = ['caption','verified','donation_amount','remaining_amount','documents','images','videos','user_id','user_name','user_image'];
     public function user()
        {
            return $this->belongsTo(User::class);
        }
        public function votechild()
        {
        	return $this->hasMany(Vote::class);
        }
}

