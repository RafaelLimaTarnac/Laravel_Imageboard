<?php


use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\PostsController;
use App\Http\Controllers\TopicsController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\TopicConfigsController;
use App\Http\Controllers\ReportsController;

use App\Models\Topic;

Route::get('/', function () {
    return view('welcome');
});

Route::get('forgot-password', function(){
    return view('fortify.forgot_password');
});

Route::get('/logout', function(){
    Auth::logout();
    return redirect('/');
});

Route::Resource('/posts', PostsController::class);
Route::get('/posts/{id}/{reply}', [PostsController::class, 'reply']);
Route::Resource('/topic', TopicsController::class);
Route::get('/topic/{topic}/catalog', [TopicsController::class, 'catalog']);

Route::Post('report', [ReportsController::class, 'report']);
Route::get('report_list', [ReportsController::class, 'list']);
Route::Delete('report_list/{id}', [ReportsController::class, 'delete']);

Route::middleware('can:isAdmin')->group(function(){
    Route::Resource('/post_configs', TopicConfigsController::class);
});

Route::middleware('auth')->group(function(){
        Route::get('/dashboard', function(){
            return view('fortify.dashboard');
    });
    Route::Resource('/comments', CommentsController::class);
});