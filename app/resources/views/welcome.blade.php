@extends('subviews.placeholder')

@section('head')
    <title>Cool Ass Forum</title>
@endsection

@section('body')
    @include('templates.form_error_check')
    <br><br>
	@can('isAdmin')
		@include('templates.create_topic_form')
	@endcan
    <br><br>
    @if(Auth::check())
    @include('templates.create_post_form', ['topics'=>$topics])
    @endif
@endsection
