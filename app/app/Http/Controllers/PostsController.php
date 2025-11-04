<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

use App\Models\Post;
use App\Models\File;
use App\Models\TopicConfig;
use App\Models\Topic;
use App\Models\User;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // adicionar barra de pesquisa
        // selecionar dados
        // pegar user com pesquisa
        
        // atualizar para ter numero de respostas, view, tempo da ultima resposta		
		$obj = Post::all();
        return View('posts.index', ['posts'=>$obj]);
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
		if(!Auth::check())
			return redirect('/');
		
		$conf = TopicConfig::where('topic', $request->topic)->first();
		
		$max_posts = $conf->max_posts;
		$curr_posts = count(Topic::with('posts')->first()->posts);
		
		$max_posts_user = $conf->post_per_user;
		$user = User::with('posts')->where('id', Auth::id())->first();
		$user_posts = 0;
		for($i = 0; $i <= count($user->Posts) - 1; $i++){
			if($user->Posts[$i]->topic == $request->topic)
				$user_posts++;
		}

        if($user_posts >= $max_posts_user)
            return redirect('/');
		
        $obj = new Post();


        $file_path = $request->hasFile('file') ? 
            $request->file('file')->store('user_files', 'public')
            : null;

        $obj->id_user = Auth::id();
        $obj->topic = $request->topic;
        $obj->content = $request->content;
        $obj->title = $request->title;
        if(isset($request->isPinned)){
            Gate::authorize('isAdmin', Auth::user());
            $obj->status = 'pinned';
        }
        else if($curr_posts < $max_posts)
            $obj->status = 'active';

        $obj->save();

        if($file_path != null){
            $file = new File();
            $file->file_path = $file_path;
            $file->imageable_id = $obj->id;
            $file->imageable_type = Post::class;
            $file->timestamps = false;
            $file->save();
        }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $obj = Post::with('comments')->findOrFail($id);
        return View('posts.show', ['post'=>$obj]);
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

        $obj = Post::findOrFail($id);
        if($obj->files()->first() != null){
            $img = File::findOrFail($obj->files()->first()->id);
            Storage::disk('public')->delete($img->file_path);
            $img->delete();
        }

        $comments = $obj->comments()->get();
        foreach($comments as $comment){
			if($comment->files()->first() != null){
				$img = File::findOrFail($comment->files()->first()->id);
				Storage::disk('public')->delete($img->file_path);
				$img->delete();
			}
        }

        $reports = $obj->reportable()->get();
        foreach($reports as $report)
            $report->delete();

        $obj->delete();

        return redirect()->back();
    }
    public function reply(string $id, string $id_reply){
        $obj = Post::with('comments')->findOrFail($id);
        return View('posts.show', ['post'=>$obj, 'reply'=>$id_reply]);
    }
}