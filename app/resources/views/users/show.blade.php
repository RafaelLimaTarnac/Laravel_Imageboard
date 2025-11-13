@extends('subviews.placeholder')

@section('body')
	<div  class='user_func'>
		<h2 id='user_func_active' class='user_button'>Show Active Posts</h2>
			<div class='user_content'>
				@foreach($active as $post)
					<h2>posted on /{{$post->topic}}/</h2>
					@include('templates.post', ['post'=>$post, 'limit'=>0]);
				@endforeach
			</div>
	</div>
	
	<div  class='user_func'>
		<h2 id='user_func_queued' class='user_button'>Show Queued Posts</h2>
			<div class='user_content'>
				@foreach($queued as $post)
					<h2>posted on /{{$post->topic}}/</h2>
					@include('templates.post', ['post'=>$post, 'limit'=>0]);
				@endforeach
			</div>
	</div>
	
	<div  class='user_func'>
		<h2 id='user_func_comments' class='user_button'>Show Comments</h2>
			<div class='user_content'>
				@foreach($comments as $comment)
					<h2>commented on /{{$comment->post->topic}}/</h2>
					@include('templates.comment', ['comment'=>$comment]);
				@endforeach
			</div>	
	</div>
@endsection

@section('scripts')
	<script src="{{asset('js/UserShowButton.js')}}"></script>
@endsection