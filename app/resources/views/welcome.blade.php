@extends('subviews.placeholder')

@php
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
$post = Post::where('status', 'active')->orderBy('updated_at', 'desc')->first();
$comment = Comment::with('post')->orderBy('updated_at', 'DESC')->first();
if($comment != null)
	$cPost = Post::findOrFail($comment->id_post);
@endphp

@section('head')
    <title>Cool Ass Forum</title>
@endsection

@section('body')
    @include('templates.form_error_check')
    <br><br>
	<br>
	@if($post != null)
	<fieldset>
	<legend><h2>Lastest Post (<span style='color:blue;'>Topic: </span>{{$post->topic}})</h2></legend>
		@include('templates.post', ['post'=>$post, 'limit'=>0])
	</fieldset>
	@endif
	<br>
	@if(isset($cPost))
	<fieldset>
	<legend><h2>Latest Comment (<span style='color:blue;'>Topic: </span>{{$cPost->topic}})</h2></legend>
		@include('templates.post', ['post'=>$cPost, 'limit'=>1])
	</fieldset>
	@endif
@endsection
