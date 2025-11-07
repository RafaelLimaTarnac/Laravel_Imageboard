<form method='POST' action='{{URL("/topic")}}' enctype='multipart/form-data'>
@csrf
	<table>
		<tr>
			<th>Tag</th>
			<td><input type='text' name='name'></td>
		</tr>
		<tr>
			<th>Category</th>
			<td><input type='text' name='category'></td>
		</tr>
		<tr>
			<th colspan="2" class='no_bg_header'><input type='submit' value='Create Topic'></th>
		</tr>
	</table>
</form>