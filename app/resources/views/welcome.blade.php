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
	<div class='post_preview'>
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
							<div class='comment'>
									@can('isAdmin')
									<form method='POST' action='{{URL("comments/" . $comment->id)}}'>
									@csrf
									@method('DELETE')
										<input type='submit' value='Delete this Comment'>
									</form>
									@endcan
								<p>User: {{User::findOrFail($comment->id_user)->name}}</p>
								<div class='comment_content'>
								@if(count($comment->files)>0)
									<img class='comment_index_img' src='{{asset("storage/" . $comment->files->first()->file_path)}}'></img>
								@endif
								<blockquote>{{$comment->content}}</blockquote>
							</div>
							</div>
				</fieldset>
			</div>
	</div>
	@endif
@endsection
