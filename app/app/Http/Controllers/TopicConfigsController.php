<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TopicConfig;
use App\Models\Topic;

class TopicConfigsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $obj = Topic::with('config')->get();
        return View('post_configs.index', ['topics'=>$obj]);
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
        //
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
        $obj = TopicConfig::select()->where('topic', $id)->first();

        $obj->max_posts = $request->max_posts;
        $obj->max_replies = $request->max_replies;
        $obj->max_files = $request->max_files;
        $obj->post_per_user = $request->post_per_user;
        $obj->duration_minutes = $request->duration_minutes;
        $obj->archive_limit = $request->archive_limit;
        $obj->update();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
