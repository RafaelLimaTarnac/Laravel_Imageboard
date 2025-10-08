<div id='topics'>
	@if(count($topics) > 0)
		@foreach($topics as $topic)
			<a href='{{URL("topic/" . $topic->name)}}'>{{$topic->name}}</a>
		@endforeach
	@else
		<h2>no topics available</h2>
	@endif
</div>