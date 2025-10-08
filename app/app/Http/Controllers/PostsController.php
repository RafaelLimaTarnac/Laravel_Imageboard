<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

use App\Models\Post;
use App\Models\File;

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

        $obj = new Post();

        $file_path = $request->hasFile('file') ? 
            $request->file('file')->store('user_files', 'public')
            : null;

        $obj->id_user = Auth::id();
        $obj->topic = $request->topic;
        $obj->content = $request->content;
        $obj->title = $request->title;
        $obj->save();

        if($file_path != null){
            $file = new File();
            $file->file_path = $file_path;
            $file->imageable_id = $obj->id;
            $file->imageable_type = Post::class;
            $file->timestamps = false;
            $file->save();
        }

        return redirect('/');
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
            $img = File::findOrFail($comment->files()->first()->id);
            Storage::disk('public')->delete($img->file_path);
            $img->delete();
        }

        $obj->delete();

        return redirect('');
    }
}
