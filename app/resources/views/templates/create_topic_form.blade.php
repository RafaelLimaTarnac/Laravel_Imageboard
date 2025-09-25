<form method='POST' action='{{URL("/topics")}}' enctype='multipart/form-data'>
@csrf
	<table>
		<tr>
			<th>Topic</th>
			<td><input type='text' name='name'></td>
		</tr>
		<tr>
			<th colspan="2"><input type='submit' value='Create Topic'></th>
		</tr>
	</table>
</form>