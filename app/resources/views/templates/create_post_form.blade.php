<form method='POST' action='{{URL("/posts")}}' enctype='multipart/form-data' id='post_form'>
@csrf
	<table>
		<input type='hidden' value='{{$topic->name}}' name='topic'>
		<tr>
			<th>Title</th>
			<td><input type='text' name='title' maxlength="60" required></td>
		</tr>
		<tr>
			<th>Contents</th>
			<td><textarea name='content' maxlength="3000" rows='5' cols='35' required></textarea></td>
		</tr>
		<tr>
			<th>Attach Files</th>
			<td><input type='file' name='file' required></td>
		</tr>
		<tr>
			<th colspan="2" class='submit_header'><input type='submit' value='Create Post'>
				@can('isAdmin')
					<label style='color: green'><input type='checkbox' name='isPinned'>Pin Post</label>
				@endcan
			</th>
		</tr>
	</table>
</form>