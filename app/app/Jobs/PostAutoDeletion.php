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
        $posts = Post::with('config')->get();
        foreach($posts as $obj){
            if($obj->created_at->diffInMinutes($now) > 
                $obj->config->duration_minutes)
            {
                if($obj->files()->first() != null){
                    $img = File::findOrFail($obj->files()->first()->id);
                    Storage::disk('public')->delete($img->file_path);
                    $img->delete();
                }

                $comments = $obj->comments()->get();
                foreach($comments as $comment){
                    $img = File::findOrFail($comment->files()->first()->id);
                    Storage::disk('public')->delete($img->file_path);
                    $img->delete();
                }

                $obj->delete();
            }
        }
    }
}
