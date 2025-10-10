<div id='topics'>
	@if(count($topics) > 0)
		<span>[</span>
		@for($i = 0; $i <= sizeof($topics) - 1; $i++)
			<a href='{{URL("topic/" . $topics[$i]->name)}}'>{{$topics[$i]->name}}</a>
			@if($i < sizeof($topics) - 1)
				<span>/</span>
			@endif
		@endfor
		<span>]</span>
	@else
		<h2>no topics available</h2>
	@endif
</div>