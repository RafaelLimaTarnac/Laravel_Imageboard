@include('templates.form_status_check')
@include('templates.form_error_check')

<form method='POST' action='/reset-password'>
@csrf
	<input type='hidden' value='{{$request->route("token")}}' name='token'>
	<table>
		<tr>
			<th>email</th>
			<td><input type='email' name='email'></td>
		</tr>
		<tr>
			<th>password</th>
			<td><input type='password' name='password'></td>
		</tr>
		<tr>
			<th>password_confirmation</th>
			<td><input type='password' name='password_confirmation'></td>
		</tr>
		<tr>
			<th colspan='2'><input type='submit'></th>
		</tr>
	<table>
</form>