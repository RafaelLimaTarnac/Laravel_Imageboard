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
	<h2>Title: {{$post->title}}</h2>
	<h4>Topic: {{$post->topic}}</h4>
	<pre>{{$post->content}}</pre>

	<fieldset>
		<legend>Add comment</legend>
		@include('templates.create_comment', ['post'=>$post])
	</fieldset>

	@if(count($post->files) > 0)
	<a href='{{asset("storage/" . $post->files->first()->file_path)}}' download>teste de download</a>
	@endif

	<h2>Comments</h2>
	@if(count($post->comments) > 0)
		@foreach($post->comments as $comment)
			<table>
				<thead>
					<th>user (trocar o id)</th>
					<th>date</th>
					<th>comment</th>
					<th>file (depois bota com o texto)</th>
				</thead>
				<tbody>
					<td>{{$comment->id_user}}</td>
					<td>{{$comment->created_at}}</td>
					<td>{{$comment->content}}</td>
					<td>...</td>
				</tbody>
			</table>
		@endforeach
	@else
		<h2>none</h2>
	@endif
@endsection