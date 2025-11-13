@extends('subviews.placeholder')

@section('body')
	<h2 id='user_func_active' class='user_func'>Show Active Posts</h2>
		<div class='user_posts'>
			@foreach($active as $post)
				<h2>{{$post->topic}}</h2>
				@include('templates.post', ['post'=>$post, 'limit'=>0]);
			@endforeach
		</div>
	<h2 id='user_func_queued' class='user_func'>Show Queued Posts</h2>
		<div class='user_posts'>
			@foreach($queued as $post)
				<h2>{{$post->topic}}</h2>
				@include('templates.post', ['post'=>$post, 'limit'=>0]);
			@endforeach
		</div>
	<h2 id='user_func_comments' class='user_func'>Show Comments</h2>
		<div class='user_comments'>
			@foreach($comments as $comment)
				@include('templates.comment', ['comment'=>$comment]);
			@endforeach
		</div>
@endsection