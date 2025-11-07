@extends("subviews.placeholder")


@section('body')
@if(isset($posts))
	<table id='archive_table'>
		<thead>
			<tr>
				<th>No.</th>
				<th class='excerpt'>Excerpt</th>
				<th>Replies</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			@foreach($posts as $post)
				<tr>
					<td>{{$post->id}}</td>
					<td>{{$post->title}}</td>
					<td>{{$post->comments_count}}</td>
					<td>[<a href='{{URL("posts/" . $post->id)}}'>view</a>]</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@else
	<h2>No Archived Posts!</h2>
@endif
@endsection