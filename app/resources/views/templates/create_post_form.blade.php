<form method='POST' action='{{URL("/posts")}}' enctype='multipart/form-data' id='post_form'>
@csrf
	<table>
		<input type='hidden' value='{{$topic->name}}' name='topic'>
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