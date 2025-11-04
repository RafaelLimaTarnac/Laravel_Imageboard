<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

use App\Models\Post;
use App\Models\File;
use App\Models\TopicConfig;

class PostAutoDeletion implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $now = now();
        $posts = Post::with('config')->where('status', 'active')->get();
        foreach($posts as $obj)
        {
            if($obj->updated_at->diffInMinutes($now) > 
                $obj->config->duration_minutes)
            {
                $nextInQueue = Post::where('topic', $obj->topic)->where('status', 'queued')->first();

                if(!isset($nextInQueue->topic))
                     continue;
                 Log::info('tem queue ' . $nextInQueue->id);

                $archived = Post::where('topic', $obj->topic)->where('status', 'archived')->count();

                // Delete post if it is archived
                if($archived >= $obj->config->archive_limit){

                    $last_arch = Post::where('topic', $obj->topic)->where('status', 'archived')->orderBy('created_at')->first();

                    if($last_arch->files()->first() != null){
                        $img = File::findOrFail($last_arch->files()->first()->id);
                        Storage::disk('public')->delete($img->file_path);
                        $img->delete();
                    }

                    $comments = $last_arch->comments()->get();
                    foreach($comments as $comment){
                        if($comment->files()->first() != null){
                            $img = File::findOrFail($comment->files()->first()->id);
                            Storage::disk('public')->delete($img->file_path);
                            $img->delete();
                        }
                    }
                    $last_arch->delete();

                    // call next queued post
                    $nextInQueue->status = 'active';
                    $nextInQueue->update();
                }
                $obj->status = 'archived';
                $obj->update();
            }
        }
        // check if we can activate more queued posts
        $configs = TopicConfig::all();
        foreach($configs as $config){
            $posts = Post::where('status', 'active')->where('topic', $config->topic)->count();
            if($posts < $config->max_posts){
                $queued = Post::where('status', 'queued')->where('topic', $config->topic)->limit($config->max_posts - $posts)->get();

                foreach($queued as $queued_post){
                    $queued_post->status = 'active';
                    $queued_post->update();
                }
            }
        }
    }
}
