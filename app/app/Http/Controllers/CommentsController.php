<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

use App\Models\Comment;
use App\Models\File;
use App\Models\Post;
use App\Models\TopicConfig;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
		$curr_post = Post::with('comments', 'config', 'files')->findOrFail($request->id_post);
        if($curr_post->status != 'active')
            return redirect()->back();
		$comms_count = count($curr_post->comments);
		$max_comms = $curr_post->config->max_replies;
		
		$files = 0;
		$comms = Comment::with('files')->get();
		$max_files = $curr_post->config->max_files;
		foreach($comms as $comm){
			if(count($comm->files) > 0)
				$files++;
		}
		
        if(!Auth::check() || $comms_count >= $max_comms || 
		$files >= $max_files && $request->hasFile('file'))
            return redirect()->back();

        $obj = new Comment();
        $file_path = $request->hasFile('file') ?
            $request->file('file')->store('user_files', 'public')
            : null;

        $obj->id_post = $request->id_post;
        $obj->id_user = Auth::id();
        $obj->content = $request->content;
        if(isset($request->id_reply))
                $obj->id_reply = $request->id_reply;
        $obj->save();
        $curr_post->last_comment_at = now();
        $curr_post->timestamps = false;
        $curr_post->update();

        if($file_path != null){
            $file = new File();
            $file->file_path = $file_path;
            $file->imageable_id = $obj->id;
            $file->imageable_type = Comment::class;
            $file->timestamps = false;
            $file->save();
        }

        return redirect('posts/' . $curr_post->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Gate::authorize('isAdmin');

        $obj = Comment::findOrFail($id);
        if($obj->files()->first() != null){
            $img = File::findOrFail($obj->files()->first()->id);
            Storage::disk('public')->delete($img->file_path);
            $img->delete();
        }

        $reports = $obj->reportable()->get();
        foreach($reports as $report)
            $report->delete();

        $obj->delete();

        return redirect()->back();
    }
}
