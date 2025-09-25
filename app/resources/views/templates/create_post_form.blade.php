<form method='POST' action='{{URL("/posts")}}' enctype='multipart/form-data'>
@csrf
	<table>
		<tr>
			<th>Topic</th>
			<td>
				@if(count($topics) > 0)
				<select name='topic'>
					@foreach($topics as $topic)
						<option value='{{$topic->name}}'>{{$topic->name}}</option>
					@endforeach
				@else
					<p style='color: red; font-weight: bold'>No topics available</p>
				@endif
			</td>
		</tr>
		<tr>
			<th>Title</th>
			<td><input type='text' name='title'></td>
		</tr>
		<tr>
			<th>Contents</th>
			<td><textarea name='content'></textarea></td>
		</tr>
		<tr>
			<th>Attach Files</th>
			<td><input type='file' name='file'></td>
		</tr>
		<tr>
			<th colspan="2"><input type='submit' value='Create Post'></th>
		</tr>
	</table>
</form>