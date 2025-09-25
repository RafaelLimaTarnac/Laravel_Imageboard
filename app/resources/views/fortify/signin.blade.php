@extends('subviews.placeholder')

@section('head')
	<title>Sign in</title>
@endsection

@section('body')
	@include('templates.form_error_check')

	<form method='POST' action='{{URL("register")}}'>
	@csrf
		<table>
			<tr>
				<th>Username</th>
				<td><input type='text' name='name' required></td>
			</tr>
			<tr>
				<th>E-mail</th>
				<td><input type='email' name='email' required></td>
			</tr>
			<tr>
				<th>Password</th>
				<td><input type='password' name='password' required></td>
			</tr>
			<tr>
				<th>Confirm Password</th>
				<td><input type='password' name='password_confirmation' required></td>
			</tr>
			<tr>
				<th colspan='2'><input type='submit' value='Create Account'></th>
			</tr>
		</table>
	</form>
@endsection