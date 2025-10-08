@extends('subviews.placeholder')

@section('head')
	<title>{{$post->title}}</title>
@endsection

@section('style')
	pre{border: black solid 1px}
	th,td,tr{border: black solid 1px;}
	table{margin: 10px}
@endsection

@section('body')
	@can('isAdmin')
		<form method='POST' action='{{URL("posts/" . $post->id)}}'>
		@csrf
		@method('DELETE')
			<input type='submit' value='Delete this Post'>
		</form>
	@endcan
	<h2>Title: {{$post->title}}</h2>
	<h4>Topic: {{$post->topic}}</h4>
	<pre>{{$post->content}}</pre>
	
	@if(count($post->files) > 0)
	<a href='{{asset("storage/" . $post->files->first()->file_path)}}' download>teste de download</a>
	@endif

	<fieldset>
		<legend>Add comment</legend>
		@if(Auth::check())
			@include('templates.create_comment', ['post'=>$post])
		@else
			<a href='/login'>Log in in order to comment</a>
		@endcan
	</fieldset>


	<h2>Comments</h2>
	@if(count($post->comments) > 0)
		@foreach($post->comments as $comment)
			<table>
				<thead>
					<th></th>
					<th>user</th>
					<th>date</th>
					<th>comment</th>
					<th>file</th>
				</thead>
				<tbody>
					<td>
					@can('isAdmin')
						<form method='POST' action='{{URL("comments/" . $comment->id)}}'>
						@csrf
						@method('DELETE')
						<input type='submit' value='Delete this Comment'>
					</form>
					@endcan</td>
					<td>{{$comment->user->name}}</td>
					<td>{{$comment->created_at}}</td>
					<td>{{$comment->content}}</td>
					@if(!count($comment->files) > 0)
						<td>...</td>
					@else
						<td><img src="{{asset("storage/" . $comment->files->first()->file_path)}}" class='post_index_img'></img><br><a href='{{asset("storage/" . $comment->files->first()->file_path)}}'>Download File</a></td>
					@endif
				</tbody>
			</table>
		@endforeach
	@else
		<h2>none</h2>
	@endif
@endsection