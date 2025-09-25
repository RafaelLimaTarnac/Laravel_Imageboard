@extends('subviews.placeholder')

@section('head')
	<title>Log in</title>
@endsection

@section('body')
	@include('templates.form_error_check')

	<form method='POST' action='{{URL("login")}}'>
	@csrf
		<table>
			<tr>
				<th>E-mail</th>
				<td><input type='email' name='email' required></td>
			</tr>
			<tr>
				<th>Password</th>
				<td><input type='password' name='password' required></td>
			</tr>
			<tr>
				<th colspan='2'><input type='checkbox' name='remember'> Remember me?</th>
			</tr>
			<tr>
				<th colspan='2'><input type='submit' value='Create Account'></th>
			</tr>
		</table>
	</form>
@endsection