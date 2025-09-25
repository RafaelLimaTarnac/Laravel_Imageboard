<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Comment;
use App\Models\File;

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
        $obj = new Comment();
        $file_path = $request->hasFile('file') ?
            $request->file('file')->store('user_files', 'public')
            : null;

        $obj->id_post = $request->id_post;
        $obj->id_user = Auth::id();
        $obj->content = $request->content;
        $obj->save();

        if($file_path != null){
            $file = new File();
            $file->file_path = $file_path;
            $file->imageable_id = $obj->id;
            $file->imageable_type = Comment::class;
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
        //
    }
}
