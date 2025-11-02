@extends('subviews.placeholder')

@section('head')
	<title>Report List</title>
@endsection

@section('body')
	<h2>Posts</h2>
	@foreach($posts as $post)
		<form method='post' action='{{URL("report_list/" . $post->id)}}'>
		@csrf
		@method('DELETE')
			<input type='submit' value='dismiss report'>
		</form>
		<pre>{{$post->message}}</pre>
		@include("templates.post", ['post'=>$post->reportable()->first(), 'limit'=>0, 'no_reports'=>true])
	@endforeach
	<h2>Comments</h2>
	@foreach($comments as $comment)
		<pre>{{$comment->message}}</pre>
		@include("templates.comment", ['comment'=>$comment->reportable()->first(), 'no_reports'=>true])
	@endforeach
@endsection