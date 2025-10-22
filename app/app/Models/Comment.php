<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\Post;
use App\Models\Report;

class Comment extends Model
{
	public function files(){
        return $this->morphMany(File::class, "imageable");
    }
	public function user(){
		return $this->hasOne(User::class, 'id', 'id_user');
	}
	public function post(){
		return $this->hasOne(Post::class, 'id', 'id_post');
	}
	public function replies(){
		return $this->belongsTo(Comment::class, 'id', 'id_reply');
	}
    public function reportable(){
        return $this->morphMany(Report::class, 'reportable');
    }
}
