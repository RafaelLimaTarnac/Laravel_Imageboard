@extends('subviews.placeholder')

@section('style')
input{ font-size:0.8em;}
@endsection

@section('body')
<br>
<fieldset>
	<legend><h2>Topics</h2></legend>
	@can('isAdmin')
		@include('templates.create_topic_form')
	@endcan
    <br><br>
	@foreach($topics as $topic)
	<form method='POST' action='{{URL("/post_configs/" . $topic->name)}}'>
	@csrf
	@method('PATCH')
		<table>
			<tr>
				<th>Tag</th>
				<td>{{$topic->name}}</td>
			</tr>
			<tr>
				<th>Category</th>
				<td>{{$topic->category}}</td>
			</tr>
			<tr>
				<th>Max Posts</th>
				<td>
					<input type='number' name='max_posts' value='{{$topic->config->max_posts}}'>
				</td>
			</tr>
			<tr>
				<th>Max Replies (per post)</th>
				<td>
					<input type='number' name='max_replies' value='{{$topic->config->max_replies}}'>
				</td>
			</tr>
			<tr>
				<th>Max Files (per post)</th>
				<td>
					<input type='number' name='max_files' value='{{$topic->config->max_files}}'>
				</td>
			</tr>
			<tr>
				<th>Post per user</th>
				<td>
					<input type='number' name='post_per_user' value='{{$topic->config->post_per_user}}'>
				</td>
			</tr>
			<tr>
				<th>Post Duration (minutes)</th>
				<td>
					<input type='number' name='duration_minutes' value='{{$topic->config->duration_minutes}}'>
				</td>
			</tr>
			<tr>
				<th>Archive Limit</th>
				<td>
					<input type='number' name='archive_limit' value='{{$topic->config->archive_limit}}'>
				</td>
			</tr>
			<tr>
				<th>Message of the day</th>
				<td>
					<input type='text' name='motd' value='{{$topic->config->motd}}'>
				</td>
			</tr>
			<tr>
				<th colspan="2" class="no_bg_header"><input type='submit' value='Update Topic'></th>
			</tr>
		</table>
	</form>
	<br><br>
	@endforeach
</fieldset>
@endsection