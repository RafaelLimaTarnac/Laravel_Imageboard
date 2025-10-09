@extends('subviews.placeholder')

@section('style')
input{ font-size:0.8em;}
@endsection

@section('body')
<br>
<fieldset>
	<legend><h2>Topics</h2></legend>
	@foreach($topics as $topic)
	<form method='POST' action='{{URL("/post_configs/" . $topic->name)}}'>
	@csrf
	@method('PATCH')
		<table>
			<thead>
				<th>Name</th>
				<th>Max Posts</th>
				<th>Max Replies (per post)</th>
				<th>Max Files (per post)</th>
				<th>Post per user</th>
				<th>Post Duration (minutes)</th>
				<th>Action</th>
			</thead>
			<tbody>
				<td>{{$topic->name}}</td>
				<td>
					<input type='number' name='max_posts' value='{{$topic->config->max_posts}}'>
				</td>
				<td>
					<input type='number' name='max_replies' value='{{$topic->config->max_replies}}'>
				</td>
				<td>
					<input type='number' name='max_files' value='{{$topic->config->max_files}}'>
				</td>
				<td>
					<input type='number' name='post_per_user' value='{{$topic->config->post_per_user}}'>
				</td>
				<td>
					<input type='number' name='duration_minutes' value='{{$topic->config->duration_minutes}}'>
				</td>
				<td><input type='submit' value='Update Topic'></td>
			</tbody>
		</table>
	</form>
	@endforeach
</fieldset>
@endsection