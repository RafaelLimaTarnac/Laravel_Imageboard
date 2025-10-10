@extends('subviews.placeholder')

@section('body')
	<div id='catalog'>
	@foreach($posts as $post)
			<div class='catalog_post'>
				<img src='{{asset("storage/" . $post->files->first()->file_path)}}'></img>
				<a href='{{URL("posts/" . $post->id)}}'>{{$post->title}}</a>
				<span>{{$post->content}}</span>
			</div>
	@endforeach
	</div>
@endsection