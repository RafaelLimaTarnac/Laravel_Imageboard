<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Post;
use App\Models\TopicConfig;

class Topic extends Model
{
    public function posts(){
        return $this->hasMany(Post::class, 'topic', 'name')->where('isPinned', '=', false);
    }
    public function pinned_posts(){
        return $this->hasMany(Post::class, 'topic', 'name')->where('isPinned', '=', true);
    }
    public function config(){
        return $this->hasOne(TopicConfig::class, 'topic', 'name');
    }
}
