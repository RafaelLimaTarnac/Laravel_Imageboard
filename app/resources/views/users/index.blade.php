@extends('subviews.placeholder')

@section('body')
<form method='POST' action='users'>
@csrf
@method('DELETE')
<input type='submit' value='delete select' onclick='return confirm("Delete Users?\nAre you sure?")'>
	<table id='archive_table'>
		<thead>
			<tr>
				<th></th>
				<th>Name</th>
				<th>Email</th>
				<th>Created</th>
				<th>Role</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			@foreach($users as $user)
				<tr>
					<td>
					@if($user->role == 'visitor')
						<input type='checkbox' name='delete_users[]' value='{{$user->id}}'>
					@elseif($user->role == 'manager' && Auth::user()->role == 'admin')
						<input type='checkbox' name='delete_users[]' value='{{$user->id}}'>
					@endif
					</td>
					<td>{{$user->name}}</td>
					<td>{{$user->email}}</td>
					<td>{{$user->created_at}}</td>
					<td>{{$user->role}}</td>
					<td> <a href='{{URL("users/" . $user->id)}}'>User Info</a> </td>
				</tr>
			@endforeach
		</tbody>
	</table>
</form>
@endsection