<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Post;
use App\Models\TopicConfig;

class Topic extends Model
{
    public function posts(){
        return $this->hasMany(Post::class, 'topic', 'name')->where('isPinned', '=', false)->where('isArchived', '=', false);
    }
    public function archived_posts(){
        return $this->hasMany(Post::class, 'topic', 'name')->where('isPinned', '=', false)->where('isArchived', '=', true)->orderBy('created_at', 'desc');
    }
    public function pinned_posts(){
        return $this->hasMany(Post::class, 'topic', 'name')->where('isPinned', '=', true);
    }
    public function config(){
        return $this->hasOne(TopicConfig::class, 'topic', 'name');
    }
}
