<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Storage;

use App\Models\Post;
use App\Models\File;

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
        $posts = Post::with('config')->where('isArchived', false)->get();
        foreach($posts as $obj){
            if($obj->created_at->diffInMinutes($now) > 
                $obj->config->duration_minutes)
            {
                $archived = Post::where('topic', $obj->topic)->where('isArchived', true)->count();

                if($archived >= $obj->config->archive_limit){

                    $last_arch = Post::where('topic', $obj->topic)->where('isArchived', true)->first();

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
                }
                
                $obj->isArchived = true;
                $obj->update();
            }
        }
    }
}
