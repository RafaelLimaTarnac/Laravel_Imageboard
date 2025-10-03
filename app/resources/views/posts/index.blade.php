@php
use App\Models\User;
@endphp

@extends('subviews.placeholder')

@section('head')
	<title>Posts Page</title>
@endsection

@section('style')
	td,tr,th{border: black solid 1px}

	.comment{border: black dashed 1px}
@endsection

@section('body')
	@if(count($posts) > 0)
		@foreach($posts as $post)
			<div class='post_preview'>
				<fieldset>
					<legend><a href='{{URL("posts/" . $post->id)}}'>{{$post->title}}</a></legend>
					<p>User: {{User::findOrFail($post->id_user)->name}}</p>
					@if(count($post->files)>0)
						<img style='height:100px' src='{{asset("storage/" . $post->files->first()->file_path)}}'></img>
					@endif
					<pre>{{$post->content}}</pre>

					@if(count($post->comments)>0)
						@for($i = 0; $i <= 5; $i++)
							@if($post->comments[$i] ?? null)
							<div class='comment'>
								<p>User: {{User::findOrFail($post->comments[$i]->id_user)->name}}</p>
								<pre>{{$post->comments[$i]->content}}</pre>
								@if(count($post->comments[$i]->files)>0)
									<img style='height:100px' src='{{asset("storage/" . $post->comments[$i]->files->first()->file_path)}}'></img>
								@endif
							</div>
							@endif
						@endfor
					@endif
				</fieldset>
			</div>
		@endforeach
	@else
		<h2>No posts</h2>
	@endif
@endsection