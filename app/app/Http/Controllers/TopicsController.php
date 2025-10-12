<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

use App\Models\Topic;
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
        $obj->save();

        $conf = new TopicConfig();
        $conf->topic = $obj->name; 
        $conf->max_posts = 15;
        $conf->max_replies = 300;
        $conf->max_files = 150;
        $conf->post_per_user = 2;
        $conf->duration_minutes = 1;
        $conf->save();

        return redirect('/');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $topic)
    {
        $pin = Topic::with('pinned_posts.comments')->select()->where('name', $topic)->get();
        $obj = Topic::with('posts.comments')->select()->where('name', $topic)->get();
        if(count($obj)>0)
            return View('posts.index', ['posts'=>$obj[0]->posts, 'topic'=>$obj->first(), 'pinned'=>$pin[0]->pinned_posts]);
        else
            return redirect('');
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
}
