@php
use App\Models\User;
@endphp

@extends('subviews.placeholder')

@section('head')
	<title>Posts Page</title>
@endsection

@section('style')
	td,tr,th{border: black solid 1px}
@endsection

@section('body')

    @if(Auth::check())
    @include('templates.create_post_form')
    <br>
    @endif

    <a href='{{URL(url()->current() . "/catalog")}}'>Catalog</a>
	@if(count($posts) > 0)
		@foreach($posts as $post)
			<div class='post_preview'>
				<fieldset>
					<div class='post'>
						@can('isAdmin')
						<form method='POST' action='{{URL("posts/" . $post->id)}}'>
						@csrf
						@method('DELETE')
							<input type='submit' value='Delete this Post'>
						</form>
						@endcan
						<span>
						<span>{{$post->created_at}}</span>
						<span class='user_index'>{{User::findOrFail($post->id_user)->name}}</span>
						<span class='title_index'><a href='{{URL("posts/" . $post->id)}}'>{{$post->title}}</a></span>
						</span>
						<br>
						<div class='post_content'>
						@if(count($post->files)>0)
							<img class='post_index_img' src='{{asset("storage/" . $post->files->first()->file_path)}}'></img>
						@endif
						<blockquote>{{$post->content}}</blockquote>
						</div>
					</div>
					@if(count($post->comments)>0)
						@for($i = 0; $i <= 5; $i++)
							@if($post->comments[$i] ?? null)
								@include('templates.comment', ['comment'=>$post->comments[$i]])
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