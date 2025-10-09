<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Comment;
use App\Models\User;
use App\Models\TopicConfig;

class Post extends Model
{
    public function files(){
        return $this->morphMany(File::class, "imageable");
    }
    public function comments(){
        return $this->hasMany(Comment::class, 'id_post');
    }
    public function user(){
        return $this->hasOne(User::class, 'id', 'id_user');
    }
    public function config(){
        return $this->hasOne(TopicConfig::class, 'topic', 'topic');
    }
}
