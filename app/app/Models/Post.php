<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Comment;

class Post extends Model
{
    public function files(){
        return $this->morphMany(File::class, "imageable");
    }
    public function comments(){
        return $this->hasMany(Comment::class, 'id_post');
    }
}
