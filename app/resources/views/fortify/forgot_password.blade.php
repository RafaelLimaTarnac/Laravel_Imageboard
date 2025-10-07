@include('templates.form_status_check')
@include('templates.form_error_check')

<form method='post' action='/forgot-password'>
@csrf
	Email<input type='email' name='email'></input>
	<input type='submit'></input>
</form>