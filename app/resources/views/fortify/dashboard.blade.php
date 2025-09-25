@extends('subviews.placeholder')

@section('body')
	<a href='{{URL("logout")}}' onclick='return confirm("Log Out\nAre you sure?")'><button>Log Out</button></a>
@endsection