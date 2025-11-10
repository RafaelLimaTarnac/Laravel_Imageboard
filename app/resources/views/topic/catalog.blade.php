@extends('subviews.placeholder')

@section('body')
	<div id='catalog'>
	@foreach($posts as $post)
			<div class='catalog_post'>
				@if(count($post->files) > 0)
					@include("templates.file_handler", ['path'=>$post->files->first()->file_path])
				@endif
				<span class='catalog_counters'>R: {{$post->comments_count}}</span>
				<span class='catalog_title'><a href='{{URL("posts/" . $post->id)}}'>{{$post->title}}</a></span>
				<span class='catalog_cont'>{{$post->content}}</span>
			</div>
	@endforeach
	</div>
@endsection