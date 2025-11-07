<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

use App\Models\Topic;
use App\Models\Post;
use App\Models\TopicConfig;

class TopicsController extends Controller
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
        Gate::authorize('isAdmin', Auth::user());

        $obj = new Topic();
        $obj->timestamps = false;
        $obj->name = $request->name;
        $obj->category = $request->category;
        $obj->save();

        $conf = new TopicConfig();
        $conf->topic = $obj->name; 
        $conf->max_posts = 15;
        $conf->max_replies = 300;
        $conf->max_files = 150;
        $conf->post_per_user = 2;
        $conf->duration_minutes = 1;
        $conf->archive_limit = 25;
        $conf->save();

        return redirect('/');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $topic)
    {
        $current_topic = Topic::with('config')->where('name', $topic)->first();
        
        $posts = Post::with('comments')->where('status', '<>', 'queued')->where('status', '<>', 'archived')->where('topic', $topic)->orderByRaw("FIELD(status, \"pinned\", \"active\")")->orderBy('last_comment_at', 'desc')->paginate(10);
        if(count($posts)>0)
            return View('posts.index', ['posts'=>$posts, 'topic'=>$current_topic, 'motd'=>$current_topic->config->motd]);
        else
            return View('posts.index', ['topic'=>$current_topic, 'motd'=>$current_topic->config->motd]);
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
        //
    }
    public function catalog(string $id)
    {
        $obj = Topic::with('posts')->select()->where('name', $id)->get()->first();
        
        return View('topic.catalog', ['posts'=>$obj->posts]);
    }
    public function archive(string $id){
        $obj = Topic::with('archived_posts')->select()->where('name', $id)->get()->first();

        return View('topic.archive', ['posts'=>$obj->archived_posts]);
    }
    public function queue(string $id){
        $current_topic = Topic::with('config')->where('name', $id)->first();
        $posts = Post::where('status', 'queued')->where('topic', $id)->paginate(10);

        return View('posts.index', ['posts'=>$posts, 'topic'=>$current_topic, 'motd'=>"Post Queue"]);
    }
}
