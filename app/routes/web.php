<?php


use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/logout', function(){
    Auth::logout();
    return redirect('/');
});

Route::middleware('auth')->group(function(){
    Route::get('/dashboard', function(){
        return view('fortify.dashboard');
    });
});

/*
    to do

    serviço de e-mail
    tabelas
    resetar senha
*/

/*
    onde parei

    
*/