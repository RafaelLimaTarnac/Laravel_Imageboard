<div class='report'>
	<button class='report-form-button'>Report</button>
	<div class='report-form'>
		<form method='post' action='/report'>
		@csrf
		<textarea name='content' placeholder='Report Message'></textarea>
		<input type='hidden' value="{{$id}}" name='id'>
		<input type='hidden' value="{{$type}}" name='type'>
		<br>
		<input type='submit' value='Send Report'>
		</form>
	</div>
</div>