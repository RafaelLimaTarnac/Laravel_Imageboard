@extends('subviews.placeholder')

@section('head')
	<title>Report List</title>
@endsection

@section('body')
	@foreach($reports as $report)
		<p>{{$report->message}}</p>
	@endforeach
@endsection