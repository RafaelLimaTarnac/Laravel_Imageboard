<form method='POST' action='{{URL("/comments")}}' enctype='multipart/form-data'>
@csrf
	<table>
		<input type='hidden' name='id_post' value='{{$post->id}}'>
		<tr>
			<th>Contents</th>
			<td><textarea name='content'></textarea></td>
		</tr>
		<tr>
			<th>Attach Files</th>
			<td><input type='file' name='file'></td>
		</tr>
		<tr>
			<th colspan="2"><input type='submit' value='Comment'></th>
		</tr>
	</table>
</form>