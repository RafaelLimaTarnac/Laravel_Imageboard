@extends('subviews.placeholder')

@section('head')
	<title>Posts Page</title>
@endsection

@section('style')
	td,tr,th{border: black solid 1px}
@endsection

@section('body')
	@if(count($posts) > 0)
		<table>
			<thead>
				<tr>
					<th>Title</th>
					<th>Topic</th>
					<th>Created</th>
				</tr>
			</thead>
			<tbody>
				@foreach($posts as $post)
					<tr>
						<td><a href='{{URL("/posts/" . $post->id)}}'>{{$post->title}}</a></td>
						<td>{{$post->topic}}</td>
						<td>{{$post->created_at}}</td>
					</tr>
				@endforeach
			</tbody>
		<table>
	@else
		<h2>No posts</h2>
	@endif
@endsection