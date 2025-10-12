@extends('subviews.placeholder')

@php
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
$post = Post::orderBy('updated_at', 'DESC')->first();
$comment = Comment::with('post')->orderBy('updated_at', 'DESC')->first();
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
	@if($comment != null)
	<fieldset>
	<legend><h2>Latest Comment (<span style='color:blue;'>Topic: </span>{{$comment->post->topic}})</h2></legend>
		<div class='post_preview'>
					<div class='post'>
						@can('isAdmin')
						<form method='POST' action='{{URL("posts/" . $comment->post->id)}}'>
						@csrf
						@method('DELETE')
							<input type='submit' value='Delete this Post'>
						</form>
						@endcan
						<span>
						<span>{{$comment->post->created_at}}</span>
						<span class='user_index'>{{User::findOrFail($comment->post->id_user)->name}}</span>
						<span class='title_index'><a href='{{URL("posts/" . $comment->post->id)}}'>{{$comment->post->title}}</a></span>
						</span>
						<br>
						<div class='post_content'>
						@if(count($comment->post->files)>0)
							<img class='post_index_img' src='{{asset("storage/" . $comment->post->files->first()->file_path)}}'></img>
						@endif
						<blockquote>{{$comment->post->content}}</blockquote>
						</div>
					</div>
					@include('templates.comment', ['comment'=>$comment])
				</fieldset>
			</div>
	</div>
	@endif
@endsection
