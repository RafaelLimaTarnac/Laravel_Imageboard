@extends('subviews.placeholder')

@section('head')
	<title>{{$post->title}}</title>
@endsection

@section('style')
	pre{border: black solid 1px}
	th,td,tr{border: black solid 1px;}
	table{margin: 10px}
@endsection

@section('body')
@include('templates.form_error_check')

@if(!isset($noComments))
	@if(Auth::check())
		@if(!isset($reply))
			@include('templates.create_comment', ['post'=>$post])
		@else
			@include('templates.create_comment', ['post'=>$post, 'reply'=>$reply])
		@endif
	@else
		<a href='/login'>Log in in order to comment</a>
	@endif
@endif

@include('templates.post', ['post'=>$post])

@endsection

@section('scripts')
<script src="{{asset('js/CommentFocus.js')}}"></script>
@endsection