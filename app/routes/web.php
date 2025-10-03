<?php


use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\PostsController;
use App\Http\Controllers\TopicsController;
use App\Http\Controllers\CommentsController;

use App\Models\Topic;

Route::get('/', function () {
    $topics = Topic::all();
    return view('welcome', ["topics"=>$topics]);
});

Route::get('/logout', function(){
    Auth::logout();
    return redirect('/');
});

Route::middleware('auth')->group(function(){
    Route::get('/dashboard', function(){
        return view('fortify.dashboard');
    });
    Route::Resource('/posts', PostsController::class);
    Route::Resource('/comments', CommentsController::class);

    Route::Resource('/topic', TopicsController::class);
});

/*
    to do

    serviço de e-mail
    tabelas
    resetar senha
*/

/*
    onde parei

    atalho arquivo: php artisan storage:link
*/