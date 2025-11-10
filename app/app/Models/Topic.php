<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Post;
use App\Models\TopicConfig;

class Topic extends Model
{
    public function posts(){
        return $this->hasMany(Post::class, 'topic', 'name')->withCount('comments')->where('status', '=', 'active')->orderBy('last_comment_at', 'desc');
    }
    public function archived_posts(){
        return $this->hasMany(Post::class, 'topic', 'name')->withCount('comments')->where('status', '=', 'archived')->orderBy('updated_at', 'desc');
    }
    public function pinned_posts(){
        return $this->hasMany(Post::class, 'topic', 'name')->where('status', '=', 'pinned')->orderBy('updated_at', 'desc');
    }
    public function queued_posts(){
        return $this->hasMany(Post::class, 'topic', 'name')->where('status', '=', 'queued');
    }
    public function config(){
        return $this->hasOne(TopicConfig::class, 'topic', 'name');
    }
}
